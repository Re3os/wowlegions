// Carousel
function Carousel (elem){
	this.elem = elem;
	this.id = elem.data("identifier");
	this.carouselItems = Array.prototype.slice.call(elem.querySelectorAll(".Carousel-item"));
	this.next = this.elem.querySelector(".Carousel-next");
	this.previous = this.elem.querySelector(".Carousel-prev");
	this.isSnap = this.elem.classList.contains("Carousel--snap");
	this.isSticky = this.elem.classList.contains("Carousel--sticky");
	this.hasTimedInterval = this.elem.classList.contains("Carousel--timedInterval");
	this.hasLayout = this.elem.classList.contains("Carousel--hasLayout");
	// WARNING: Animation should only be enabled on Carousels with 3 or more frames. Stuff will break otherwise.
	this.isAnimating = false;
	this.isChanging = false; // When true, disallow any other attempts to animate
	this.isSwiping = false;
	this.isTouchMoved = false;
	this.isScrollChecked = false; // When true, skip check as to whether the swipe motion is vertical or horizontal

	this.swipeThreshold = 10;                // Static: Movement distance in pixels before a swipe animation is cancelled in favor of scrolling
	this.swipeMomentumMultiplier = 300.0;    // Static: Time value in ms used to calculate swipe momentum
	this.swipeMoveTimestamp = 0;             // Debounce variable for move tracking
	this.swipeMoveThreshold = 1000.0 / 60.0; // Static: Debounce threshold in milliseconds
	this.timedIntervalLength = 5000;         // Static: Length of timed interval in milliseconds

	this.isAnimatedShortDistance = this.elem.classList.contains("Carousel--animatedShortDistance");
	this.fixedShortDistance = 100;

	this.init();
}

Object.assign(Carousel, {
	init: function () {
		document.querySelectorAlways(".Carousel", Carousel.create);
		document.querySelectorAlways(".CarouselLink", Carousel.listen); //Not contained in a carousel
	},
	create: function (elem) {
		return new Carousel(elem);
	},
	listen: function (elem) {
		elem.addEventListener("click",Carousel.click.bind(this, elem));
	},
	allCarouselsById: {},
	click: function(elem) {
		var identifier = elem.data("carousel");
		var carousel = Carousel.allCarouselsById[identifier];
		if (carousel && !carousel.isChanging) {
			//Find the next carousel item by matching data-carousel indices
			var query = ".Carousel-item" + elem.attributeSelector("data-carousel", "data-carousel-index");
			var newItem = document.querySelector(query);
			if (newItem) {
				//Find the currently displayed carousel item
				var currentItem = carousel.elem.querySelector(".Carousel-item.is-selected");

				Carousel.select(carousel, currentItem, newItem);
			}
		}
	},
	calculateMomentumDistance: function(startX, currentX, timestamp, distance, multiplier) {
		var deltaX = currentX - startX;
		if (distance != 0) {
			var timeElapsed = Date.now() - timestamp;
			deltaX += Math.round(multiplier * (deltaX / timeElapsed));
		}
		return deltaX;
	},
	// Remove selection from current item and add selection to new item
	switch: function(carousel, currentItem, newItem, skipAnimation) {
		if (currentItem) {
			// Deselect current item
			currentItem.classList.remove("is-selected");
			// Deselect any links pointing to current item
			var linkQuery = ".CarouselLink" + currentItem.attributeSelector("data-carousel", "data-carousel-index");
			document.querySelectorAll(linkQuery).map(function (link) {
				link.classList.remove("is-selected");
			});
		}

		// Select new item
		newItem.classList.add("is-selected");
		// Select any links pointing to new item
		linkQuery = ".CarouselLink" + newItem.attributeSelector("data-carousel", "data-carousel-index");
		document.querySelectorAll(linkQuery).map(function (link) {
			link.classList.add("is-selected");
		});

		if (!skipAnimation && carousel.isSnap) {
			carousel.snapToTop(carousel.elem);
		}

		carousel.elem.trigger("carouselchange");
	},
	select: function(carousel, currentItem, newItem, skipAnimation, direction) {
		if (currentItem == newItem) return;

		Carousel.switch(carousel, currentItem, newItem, skipAnimation);

		if (currentItem == null || skipAnimation || !carousel.isAnimated || !supports.transitionEnd) {
			// Trigger a resize to update elements that need to redraw themselves
			trigger("resize");
			carousel.isChanging = false;
		} else {
			// The animation setup method already triggers resize
			var transitionDistance = Carousel.getTransitionDistance(carousel);

			var currentIndex = carousel.carouselItems.indexOf(currentItem);
			var newIndex = carousel.carouselItems.indexOf(newItem);
			var isForceLeft = (direction == "left");
			var isForceRight = (direction == "right");
			if ((newIndex > currentIndex && !isForceLeft) || isForceRight) {
				Carousel.setupAnimation(carousel, null, currentItem, newItem);
				Carousel.startSnapAnimation(carousel);
				Carousel.snapRight(carousel, transitionDistance);
				return;
			}
			if (newIndex < currentIndex || isForceLeft) {
				Carousel.setupAnimation(carousel, newItem, currentItem, null);
				Carousel.startSnapAnimation(carousel);
				Carousel.snapLeft(carousel, transitionDistance);
			}
		}
	},
	setupAnimation: function(carousel, left, center, right) {
		carousel.isAnimating = true;
		var transitionDistance = Carousel.getTransitionDistance(carousel);

		if (left) {
			carousel.swipeLeftElem = left;
			left.classList.add("Carousel-prevFrame");
			left.style.transform = "translate(" + -transitionDistance + "px, 0)";

			// Force a flushing of styles to ensure things are properly initially
			window.getComputedStyle(left).transform;
		}

		carousel.swipeCenterElem = center;
		center.classList.add("Carousel-currentFrame");
		center.style.transform = "translate(0, 0)";

		// Force a flushing of styles to ensure things are properly initially
		window.getComputedStyle(center).transform;

		if (right) {
			carousel.swipeRightElem = right;
			right.classList.add("Carousel-nextFrame");
			right.style.transform = "translate(" + transitionDistance + "px, 0)";

			// Force a flushing of styles to ensure things are properly initially
			window.getComputedStyle(right).transform;
		}

		if (!carousel.hasLayout) {
			trigger("resize");
		}
	},
	endAnimation: function(carousel) {
		if (carousel.swipeLeftElem) {
			carousel.swipeLeftElem.classList.remove("Carousel-prevFrame");
			carousel.swipeLeftElem.style.transform = "";
			carousel.swipeLeftElem.classList.remove("is-active");
			carousel.swipeLeftElem = null;
		}
		if (carousel.swipeRightElem) {
			carousel.swipeRightElem.classList.remove("Carousel-nextFrame");
			carousel.swipeRightElem.style.transform = "";
			carousel.swipeRightElem.classList.remove("is-active");
			carousel.swipeRightElem = null;
		}
		if (carousel.swipeCenterElem) {
			carousel.swipeCenterElem.classList.remove("Carousel-currentFrame");
			carousel.swipeCenterElem.style.transform = "";
			carousel.swipeCenterElem = null;
		}
		if (!carousel.hasLayout) {
			trigger("resize");
		}
		carousel.isAnimating = false;
	},
	startSnapAnimation: function(carousel) {
		carousel.isChanging = true;
		if(carousel.swipeLeftElem) carousel.swipeLeftElem.classList.add("Carousel-transitioning");
		if(carousel.swipeRightElem) carousel.swipeRightElem.classList.add("Carousel-transitioning");

		if(carousel.swipeCenterElem) {
			carousel.swipeCenterElem.classList.add("Carousel-transitioning");
			// All the triggers are bound to the center element because it's the only one that matters visually
			carousel.swipeCenterElem.addEventListener(supports.transitionEnd, carousel.transitionEventHandler);
		}
	},
	translateViewportLeft: function(elem, transitionDistance) {
		elem.style.transform = "translate(" + -transitionDistance + "px, 0)";
	},
	translateViewportCenter: function(elem) {
		elem.style.transform = "translate(0, 0)";
	},
	translateViewportRight: function(elem, transitionDistance) {
		elem.style.transform = "translate(" + transitionDistance + "px, 0)";
	},
	snapBack: function(carousel, transitionDistance) {
		if(carousel.swipeLeftElem) {
			Carousel.translateViewportLeft(carousel.swipeLeftElem, transitionDistance);
		}
		Carousel.translateViewportCenter(carousel.swipeCenterElem);
		if(carousel.swipeRightElem) {
			Carousel.translateViewportRight(carousel.swipeRightElem, transitionDistance);
		}
	},
	snapLeft: function(carousel, transitionDistance) {
		if(carousel.swipeLeftElem) {
			Carousel.translateViewportCenter(carousel.swipeLeftElem);
			carousel.swipeLeftElem.classList.add("is-active");
		}
		if(carousel.swipeCenterElem) {
			Carousel.translateViewportRight(carousel.swipeCenterElem, transitionDistance);
		}
		if(carousel.swipeRightElem) {
			Carousel.translateViewportRight(carousel.swipeRightElem, transitionDistance);
		}
	},
	snapRight: function(carousel, transitionDistance) {
		if(carousel.swipeLeftElem) {
			Carousel.translateViewportLeft(carousel.swipeLeftElem, transitionDistance);
		}
		if(carousel.swipeCenterElem) {
			Carousel.translateViewportLeft(carousel.swipeCenterElem, transitionDistance);
		}
		if(carousel.swipeRightElem) {
			Carousel.translateViewportCenter(carousel.swipeRightElem);
			carousel.swipeRightElem.classList.add("is-active");
		}
	},
	stopSnapAnimation: function(carousel) {
		if(carousel.swipeLeftElem) {
			carousel.swipeLeftElem.classList.remove("Carousel-transitioning");
			carousel.swipeLeftElem.classList.remove("is-active");
		}
		if(carousel.swipeRightElem) {
			carousel.swipeRightElem.classList.remove("Carousel-transitioning");
			carousel.swipeRightElem.classList.remove("is-active");
		}

		if(carousel.swipeCenterElem) {
			carousel.swipeCenterElem.classList.remove("Carousel-transitioning");
			// FIX ME: This code should work, but it's currently breaking the carousel at resolutions lower than 720px
			// carousel.swipeCenterElem.removeEventListener(supports.transitionEnd, carousel.transitionEventHandler);
		}
		carousel.isChanging = false;
	},
	getTransitionDistance: function(carousel) {
		if (carousel.isAnimatedShortDistance && !carousel.isSwiping) {
			return carousel.fixedShortDistance;
		} else {
			return window.innerWidth || document.documentElement.clientWidth;
		}
	}
});

Carousel.prototype = {
	init: function () {
		this.findDefault();
		this.selectDefault();
		this.toggle();
		this.listenTouch();
		this.listenSticky();
		this.setupTimedInterval();
		Carousel.allCarouselsById[this.id] = this;
	},
	get isAnimated () {
		return this.elem.classList.contains("Carousel--animated")
	},
	findDefault: function() {
		this.defaultCarouselItem = this.carouselItems[0];
	},
	selectDefault: function() {
		if (this.defaultCarouselItem){
			Carousel.select(this, null, this.defaultCarouselItem, true);
		}
	},
	hasSelection: function (carouselItem) {
		return carouselItem.classList.contains("is-selected");
	},
	toggle: function() {
		this.next.addEventListener("click", this.showNext.bind(this));
		this.previous.addEventListener("click", this.showPrevious.bind(this));
	},
	showNext: function() {
		if (this.isChanging) return;
		this.isChanging = true;

		//Create carousel variable for readability
		var carousel = this.elem;
		//Find the active carousel item in the set of carousel items for this carousel
		var currentItem = carousel.querySelector(".Carousel-item.is-selected");
		//Find the index of the active carousel item
		var currentItemIndex = this.carouselItems.indexOf(currentItem);
		//If the "next" arrow is clicked, display the following item in the list of carousel-items
		var nextItem;
		if (currentItemIndex >= this.carouselItems.length - 1) {
			nextItem = this.carouselItems[0];
		} else {
			nextItem = this.carouselItems[currentItemIndex + 1];
		}
		Carousel.select(this, currentItem, nextItem, null, "right");
	},
	showPrevious: function() {
		if (this.isChanging) return;
		this.isChanging = true;

		var carousel = this.elem;
		var currentItem = carousel.querySelector(".Carousel-item.is-selected");
		var currentItemIndex = this.carouselItems.indexOf(currentItem);
		var prevItem;
		if (currentItemIndex <= 0) {
			prevItem = this.carouselItems[this.carouselItems.length - 1];
		}
		else{
			prevItem = this.carouselItems[currentItemIndex - 1];
		}
		Carousel.select(this, currentItem, prevItem, null, "left");
	},
	getCurrentItem: function() {
		return this.elem.querySelector(".Carousel-item.is-selected");
	},
	getCurrentItemIndex: function() {
		return this.carouselItems.indexOf(this.elem.querySelector(".Carousel-item.is-selected"));
	},
	listenTouch: function () {
		var elem = this.elem;

		//	TODO: The following is temporarily commented out so that touch handling is disabled.
		//	In order to reenable this we will have to fix a bug on iPhone where scrolling no longer
		//	works. The user cannot scroll past the Carousel. See bug WM-16145 for more info.
		// elem.addEventListener("touchstart", this.touchStart.bind(this));
		// elem.addEventListener("touchmove", this.touchMove.bind(this));
		// elem.addEventListener("touchend", this.touchEnd.bind(this));

		if (this.isAnimated) {
			this.startSwipeAnimationBound = this.startSwipeAnimation.bind(this);
			this.updateSwipeAnimationBound = this.updateSwipeAnimation.bind(this);
			this.endSwipeAnimationBound = this.endSwipeAnimation.bind(this);

			//	TODO: Note that the following is needed even for devices that don't support touch.
			//	This should be moved to somewhere more appropriate.
			this.transitionEventHandler = function () {
				Carousel.stopSnapAnimation(this);
				requestAnimationFrame(this.endSwipeAnimationBound);
			}.bind(this);
		}
	},
	touchStart: function(event) {
		// Ensure that this is a single-touch event and that no other change animation is in-flight
		if (event.touches.length == 1 && !this.isChanging) {
			this.isSwiping = true; // Assume true until movement proves otherwise
			this.elem.classList.add("is-swiping");
			var touch = event.touches[0];
			this.startX = touch.pageX;
			this.startY = touch.pageY;
			this.currentX = touch.pageX;
			this.currentY = touch.pageY;
			this.swipeDistance = 0;
			this.startTimestamp = Date.now();
			this.isTouchMoved = false;
			this.isScrollChecked = false;
		} else {
			this.isSwiping = false;
		}
	},
	touchEnd: function(event) {
		if (this.isSwiping) {
			if (this.isTouchMoved) {
				event.stopPropagation();
				event.preventDefault();

				// Check for page change
				var transitionDistance = Carousel.getTransitionDistance(this);
				var distance = Carousel.calculateMomentumDistance(
					this.startX,
					this.currentX,
					this.startTimestamp,
					this.swipeDistance,
					this.swipeMomentumMultiplier
				);

				if (distance > (transitionDistance / 2)) {
					// Swiped to previous frame
					Carousel.switch(this, this.swipeCenterElem, this.swipeLeftElem);
					if (this.isAnimated) {
						if (supports.transitionEnd) {
							Carousel.startSnapAnimation(this);
							Carousel.snapLeft(this, transitionDistance);
						} else {
							requestAnimationFrame(this.endSwipeAnimationBound);
						}
					}
				} else if (distance < -(transitionDistance / 2)) {
					// Swiped to next frame
					Carousel.switch(this, this.swipeCenterElem, this.swipeRightElem);
					if (this.isAnimated) {
						if (supports.transitionEnd) {
							Carousel.startSnapAnimation(this);
							Carousel.snapRight(this, transitionDistance);
						} else {
							requestAnimationFrame(this.endSwipeAnimationBound);
						}
					}
				} else {
					// Snap back to current frame
					if (this.isAnimated) {
						if (supports.transitionEnd) {
							Carousel.startSnapAnimation(this);
							Carousel.snapBack(this, transitionDistance);
						} else {
							requestAnimationFrame(this.endSwipeAnimationBound);
						}
					}
				}
			}
			// Cleanup
			this.isSwiping = false;
			this.elem.classList.remove("is-swiping");
		}
	},
	touchMove: function(event) {
		if (this.isSwiping) {
			// If multitouch starts, cancel swipe handling
			if (event.touches.length != 1) {
				this.isSwiping = false;
				if (this.isAnimated) {
					requestAnimationFrame(this.endSwipeAnimationBound);
				}
			} else {
				event.stopPropagation();
				event.preventDefault();

				var timeElapsed = Date.now() - this.swipeMoveTimestamp;
				if (timeElapsed >= this.swipeMoveThreshold) {
					this.swipeMoveTimestamp = Date.now();
					var touch = event.touches[0];
					var deltaX = touch.pageX - this.currentX;
					var deltaY = touch.pageY - this.currentY;
					this.swipeDistance += Math.sqrt(deltaX * deltaX + deltaY * deltaY);
					this.currentX = touch.pageX;
					this.currentY = touch.pageY;
					if (!this.isScrollChecked) {
						if (this.swipeDistance > this.swipeThreshold) {
							this.isTouchMoved = true;
							this.isScrollChecked = true;
							var isVerticalScrolling = Math.abs(this.currentY - this.startY) > Math.abs(this.currentX - this.startX);
							if (isVerticalScrolling) {
								this.isSwiping = false;
								if (this.isAnimated) {
									requestAnimationFrame(this.endSwipeAnimationBound);
								}
								return;
							} else if (this.isAnimated) {
								requestAnimationFrame(this.startSwipeAnimationBound);
							}
						}
					}
					if (this.isAnimated) {
						requestAnimationFrame(this.updateSwipeAnimationBound);
					}
				}
			}
		}
	},
	startSwipeAnimation: function() {
		var currentItem = this.elem.querySelector(".Carousel-item.is-selected");
		var currentItemIndex = this.carouselItems.indexOf(currentItem);
		var prevItem;
		if (currentItemIndex < 1) {
			prevItem = this.carouselItems[this.carouselItems.length - 1];
		}
		else{
			prevItem = this.carouselItems[currentItemIndex - 1];
		}
		var nextItem;
		if (currentItemIndex > this.carouselItems.length - 2) {
			nextItem = this.carouselItems[0];
		} else {
			nextItem = this.carouselItems[currentItemIndex + 1];
		}
		Carousel.setupAnimation(this, prevItem, currentItem, nextItem);
	},
	endSwipeAnimation: function() {
		Carousel.endAnimation(this);
	},
	updateSwipeAnimation: function() {
		var transitionDistance = Carousel.getTransitionDistance(this);
		var deltaX = this.currentX - this.startX;
		this.swipeLeftElem.style.transform = "translate(" + (-transitionDistance + deltaX).toFixed(0) + "px, 0)";
		//this.swipeLeftElem.style.right = (transitionDistance - deltaX).toFixed(0) + "px";
		this.swipeCenterElem.style.transform = "translate(" + deltaX.toFixed(0) + "px, 0)";
		//this.swipeCenterElem.style.left = deltaX.toFixed(0) + "px";
		this.swipeRightElem.style.transform = "translate(" + (transitionDistance + deltaX).toFixed(0) + "px, 0)";
		//this.swipeRightElem.style.left = (transitionDistance + deltaX).toFixed(0) + "px";
		if (deltaX > 0) {
			this.swipeLeftElem.classList.add("is-active");
			this.swipeRightElem.classList.remove("is-active");
			//this.swipeLeftElem.style.zIndex = 1;
			//this.swipeRightElem.style.zIndex = "";
		} else {
			this.swipeLeftElem.classList.remove("is-active");
			this.swipeRightElem.classList.add("is-active");
			//this.swipeLeftElem.style.zIndex = "";
			//this.swipeRightElem.style.zIndex = 1;
		}
	},
	listenSticky: function() {
		if (this.isSticky) {
			this.stickyUpdateBound = this.stickyUpdate.bind(this);
			window.addEventListener("scroll", this.stickyListener.bind(this));
		}
	},
	stickyListener: function() {
		requestAnimationFrame(this.stickyUpdateBound);
	},
	stickyUpdate: function() {
		var viewportHeight = (window.innerHeight || document.documentElement.clientHeight);
		var rect = this.elem.getBoundingClientRect();
		var contentHeight = this.elem.offsetHeight;
		var pushDown = rect.top;
		//var pullUp = rect.bottom;
		var offset = Math.max(
			0, // Ensure that this can't go off the top of the Carousel
			Math.min(
				-pushDown, // The distance the prev/next buttons would have to be translated downwards to be centered
				contentHeight - viewportHeight // Ensure that this can't go off the bottom of the Carousel
			).toFixed(2)
		);
		this.previous.style.transform = "translateY(" + offset + "px)";
		this.next.style.transform = "translateY(" + offset + "px)";
	},
	snapToTop: function(elem) {
		var rect = elem.getBoundingClientRect();
		if (rect.top != 0) {
			window.scrollBy(0, rect.top);
		}
	},
	setupTimedInterval: function() {
		if (this.hasTimedInterval) {
			//	TODO: This should reset whenever the user manually navigates. Maybe we're better off with setTimeout.
			setInterval(this.showNext.bind(this), this.timedIntervalLength);
		}
	}
};

Carousel.init();

//	TODO: This shouldn't be page-specific to Timeline and also shouldn't be part of the same Carousel component
//	      used elsewhere. (See also in Carousel.jade)
function CarouselTimelineReboot (elem){
	this.elem = elem;
	this.elem.CarouselTimelineReboot = this;
	this.next = elem.querySelector(".Carousel-next");
	this.previous = elem.querySelector(".Carousel-prev");
	this.hasTimelineArrows = elem.classList.contains("Carousel-timelineArrows");
	this.init();
}

Object.assign(CarouselTimelineReboot, {
	init: function() {
		document.querySelectorAlways(".CarouselTimelineReboot", CarouselTimelineReboot.create);
	},
	create: function(elem){
		return new CarouselTimelineReboot(elem);
	}
});

CarouselTimelineReboot.prototype = {
	init: function () {
		var hasTimelineArrows = this.elem.classList.contains("Carousel-timelineArrows");
		if (hasTimelineArrows) {
			this.handleTimelineArrows();
		}
	},
	handleTimelineArrows: function() {
		var selectedCarouselItem = document.querySelector(".Carousel-desktopView");
		var hiddenNext;
		var hiddenPrev;

		if (!selectedCarouselItem.data("prev-url")) {
			document.querySelector(".Carousel-prev").classList.add('hide');
			hiddenPrev = true;
		}
		if (!selectedCarouselItem.data("next-url")) {
			document.querySelector(".Carousel-next").classList.add('hide');
			hiddenNext = true;
		}
		if (!hiddenNext) {
			this.handleTimelineNextNavigation();
		}
		if (!hiddenPrev) {
			this.handleTimelinePrevNavigation();

		}
	},
	handleTimelineNextNavigation: function(){
		var selectedCarouselItem = document.querySelector(".Carousel-desktopView");
		var newSlug = selectedCarouselItem.data("next-url");
		document.querySelector(".Carousel-next").attr("href", "/story/timeline" + newSlug)
	},
	handleTimelinePrevNavigation: function() {
		var selectedCarouselItem = document.querySelector(".Carousel-desktopView");
		var newSlug = selectedCarouselItem.data("prev-url");
		document.querySelector(".Carousel-prev").attr("href", "/story/timeline" + newSlug)
	}
};

CarouselTimelineReboot.init();

module.exports = Carousel;



// WEBPACK FOOTER //
// ./static/components/Carousel/Carousel.js