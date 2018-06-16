// ScrollAnchor
function ScrollAnchor (elem) {
	this.elem = elem;
	this.control = elem.querySelector(".ScrollAnchor-control > .Sticky");
	this.icon = elem.querySelector(".ScrollAnchor-icon");
	this.indicator = this.icon.querySelector(".ScrollAnchor-indicator");
	this.overlay = elem.querySelector(".ScrollAnchor-overlay");

	this.isScrolled = false;
	this.isMaxedOut = false;

	this.scrollFrom = 0;
	this.scrollDelta = 0;
	this.scrollStart = 0;
	this.scrollProgress = 0;
	this.scrollEnd = 0;
	this.scrollDuration = 500; // Static: scroll animation duration in ms.
	this.scrollThreshold = 0.60; // Static: screen scroll distance before the overlay is completely removed; 1.0 = 100vh

	// The constant here should match the vh margin of the ScrollAnchor-control class in ScrollAnchor.less
	this.scrollDistance = ScrollAnchor.calcScrollDistance(this.scrollThreshold);

	this.init();
}

Object.assign(ScrollAnchor, {
	init: function () {
		document.querySelectorAlways(".ScrollAnchor", ScrollAnchor.create);
	},
	create: function (elem) {
		return new ScrollAnchor(elem);
	},
	// Ease-out Cubic
	ease: function (t, b, c, d) {
		t = t / d - 1;
		return c * (t * t * t + 1) + b;
	},
	calcScrollDistance: function(threshold) {
		return Math.floor(threshold * (window.innerHeight || document.documentElement.clientHeight));
	}
});

ScrollAnchor.prototype = {
	init: function () {
		this.listen();
	},
	listen: function () {
		this.updateBound = this.update.bind(this);
		window.addEventListener("scroll", this.updateBound);
		window.addEventListener("resize", function() {
			this.scrollDistance = ScrollAnchor.calcScrollDistance(this.scrollThreshold);
			this.updateBound();
		}.bind(this));
		this.animateBound = this.animate.bind(this);
		this.scrollBound = this.scroll.bind(this);
		this.icon.addEventListener("click", this.scrollBound);
		this.update();
	},
	update: function () {
		requestAnimationFrame(this.render.bind(this));
	},
	showOpenIcon: function() {
		if (this.indicator.classList.contains("Icon--closeSwitchOff")) {
			this.indicator.classList.remove("Icon--closeSwitchOff");
			this.indicator.classList.add("Icon--closeSwitchOn");
		}
	},
	showCloseIcon: function() {
		if (this.indicator.classList.contains("Icon--closeSwitchOn")) {
			this.indicator.classList.remove("Icon--closeSwitchOn");
			this.indicator.classList.add("Icon--closeSwitchOff");
		}
	},
	render: function() {
		var rect = this.control.getBoundingClientRect();
		// Overlay is locked to full opacity when content is scrolled up
		if(rect.top >= this.scrollDistance) {
			if (this.isStuck || this.isMaxedOut) {
				//this.overlay.style.opacity = "";
				//this.overlay.classList.remove("hide");
				this.isStuck = false;
				this.isMaxedOut = false;
				this.showOpenIcon();
			}
		}
		// Overlay fades out as content scrolls down
		else if(rect.top > 0) {
			//this.overlay.style.opacity = Math.abs(rect.top / this.scrollDistance).toFixed(2);
			//this.overlay.classList.remove("hide");
			this.isStuck = true;
			this.isMaxedOut = false;
			// The open/close tab flip-flops at the half-way point to prevent rounding errors from breaking behavior
			if(rect.top >= (this.scrollDistance / 2)) {
				this.showOpenIcon();
			} else {
				this.showCloseIcon();
			}
		}
		// Overlay is removed when content is fully scrolled into view.
		else {
			if (!this.isMaxedOut) {
				//this.overlay.style.opacity = "0";
				//this.overlay.classList.add("hide");
				this.isStuck = true;
				this.isMaxedOut = true;
				this.showCloseIcon();
			}
		}
	},
	scroll: function() {
		var rect = this.control.getBoundingClientRect();
		this.scrollFrom = window.scrollY;
		// Scroll down to content
		if(rect.top >= (this.scrollDistance / 2)) {
			this.scrollDelta = (rect.top);
		}
		// Scroll up to top of ScrollAnchor
		else {
			this.scrollDelta = -Math.round(this.scrollDistance - rect.top);
		}
		this.scrollEnd = (this.scrollStart = this.scrollProgress = new Date().getTime()) + this.scrollDuration;
		requestAnimationFrame(this.animateBound);
	},
	animate: function() {
		// Progressive interpolation is used here to account for both slow computers and high-framerate monitors
		if (this.scrollProgress < this.scrollEnd) {
			this.scrollProgress += (new Date().getTime() - this.scrollProgress);
			var progress = Math.min(this.scrollDuration, this.scrollProgress - this.scrollStart);
			var dest = ScrollAnchor.ease(progress, this.scrollFrom, this.scrollDelta, this.scrollDuration);
			window.scrollTo(window.scrollX, dest);

			if (!this.scrollBound) {
				this.scrollBound = this.scroll.bind(this);
			}
			requestAnimationFrame(this.animateBound);
		}
	}
};

ScrollAnchor.init();

module.exports = ScrollAnchor;



// WEBPACK FOOTER //
// ./static/components/ScrollAnchor/ScrollAnchor.js