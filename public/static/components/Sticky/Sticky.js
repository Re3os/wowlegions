// Sticky
function Sticky (elem) {
	this.elem = elem;
	this.elem.sticky = this;
	this.content = elem.querySelector(".Sticky-content");
	this.limiter = elem.data("limiter");
	this.offset = 0;
	this.isActive = Sticky.checkActive(elem);
	this.isStuck = false;
	this.isFixedWidth = elem.classList.contains("Sticky--fixedWidth");
	this.isReversed = elem.classList.contains("Sticky--reverse");
	this.isOffscreen = elem.classList.contains("Sticky--offscreen");
	this.forceUpdate = false;
	this.zIndex = 999;
	this.init();
}

Object.assign(Sticky, {
	init: function () {
		document.querySelectorAlways(".Sticky", Sticky.create);
		window.addEventListener("resize", Sticky.resize);
	},
	create: function (elem) {
		return new Sticky(elem);
	},
	allElements: [],
	checkActive: function (elem) {
		var isDisabled = elem.classList.contains("is-disabled");
		var isHidden = elem.classList.contains("hide");
		var isDisplayNone = window.getComputedStyle(elem).display === "none";
		return !(isDisabled || isHidden || isDisplayNone);
	},
	resize: function () {
		var offset = 0;
		var zIndex = 999;
		var reversedElements = [];
		Sticky.allElements.map(function (sticky) {
			sticky.isActive = Sticky.checkActive(sticky.elem);
			sticky.isFixedWidth = sticky.elem.classList.contains("Sticky--fixedWidth");
			// Set reversed elements aside in backwards order.
			if (sticky.isReversed) {
				reversedElements.unshift(sticky);
				return;
			}
			sticky.offset = offset;
			sticky.forceUpdate = true;
			if (!sticky.isActive) sticky.isStuck = false;
			if (sticky.update()) {
				sticky.zIndex = zIndex;
				zIndex++;
				offset += sticky.isActive ? sticky.content.offsetHeight : 0;
			}
		});

		offset = 0;
		zIndex = 999;
		// Iterate through reversed elements (in bottom-up order)
		reversedElements.map(function (sticky) {
			sticky.offset = offset;
			sticky.forceUpdate = true;
			if (!sticky.isActive) sticky.isStuck = false;
			if (sticky.update()) {
				sticky.zIndex = zIndex;
				zIndex++;
				offset += sticky.isActive ? sticky.content.offsetHeight : 0;
			}
		});
	},
	isScrolledOff: function (elem, offset, reversed, offscreen) {
		var rect = elem.getBoundingClientRect();
		if (reversed) {
			var viewportHeight = (window.innerHeight || document.documentElement.clientHeight);
			return rect.bottom >= (viewportHeight - offset);
		} else {
			return (offscreen ? rect.bottom : rect.top) <= offset;
		}
	},
	calcLimiterOffset: function(isReversed, limiter, content, height, offset) {
		var min;
		if (isReversed) {
			var viewportHeight = (window.innerHeight || document.documentElement.clientHeight);
			min = viewportHeight - height - limiter.getBoundingClientRect().bottom;
		} else {
			min = limiter.getBoundingClientRect().top - height;
		}
		if (min < offset) {
			content.style.zIndex = "";
			return min;
		}
		return offset;
	}
});

Sticky.prototype = {
	init: function () {
		this.listen();
	},
	listen: function () {
		function triggerUpdate () {
			this.elem.trigger("update");
		}
		function throttledUpdate () {
			requestAnimationFrame(triggerUpdate.bind(this));
		}
		window.addEventListener("scroll", throttledUpdate.bind(this));
		this.elem.addEventListener("update", this.update.bind(this));
		Sticky.allElements.push(this);
		//Sticky.resize();
		this.update();
	},
	update: function () {
		// This sanity code disables this component in the unlikely case that it is somehow deleted.
		if (this.elem == null || this.content == null) {
			this.destroy();
			return false;
		}

		var contentStyle = this.content.style;
		if (this.isActive && Sticky.isScrolledOff(this.elem, this.offset, this.isReversed, this.isOffscreen)) {
			if (!this.isStuck || this.forceUpdate || this.limiter) {
				var height = this.content.offsetHeight;
				this.elem.style.height = this.content.offsetHeight + "px";
				this.elem.classList.add("is-active");
				contentStyle.zIndex = this.zIndex;

				// Test for a limiting element
				var offset = this.offset;
				var limiter = this.limiter ? document.querySelector(this.limiter) : null;
				if (limiter) {
					offset = Sticky.calcLimiterOffset(this.isReversed, limiter, this.content, this.elem.offsetHeight, offset);
				}

				// Set the distance from the sticky edge
				if (this.isReversed) {
					contentStyle.bottom = offset + "px";
				} else {
					if (this.isOffscreen) {
						offset -= height;
					}
					contentStyle.top = offset + "px";
				}

				// Manipulate widths if necessary
				if (this.isFixedWidth) {
					var rect = this.elem.getBoundingClientRect();
					contentStyle.left = rect.left + "px";
					contentStyle.right = "";
					contentStyle.width = this.elem.offsetWidth + "px";
				} else {
					contentStyle.left = "";
					contentStyle.right = scrollbar.width + "px";
				}
				this.isStuck = true;
				this.forceUpdate = false;
			}
		} else {
			if (this.isStuck || this.forceUpdate) {
				this.elem.style.height = "";
				this.elem.classList.remove("is-active");
				contentStyle.top = "";
				contentStyle.bottom = "";
				contentStyle.left = "";
				contentStyle.right = "";
				contentStyle.zIndex = "";
				contentStyle.width = "";
				this.isStuck = false;
				this.forceUpdate = false;
			}
		}
		return true;
	},
	destroy: function () {
		document.removeEventListener("scroll", this.updateBound);
		var index = Sticky.allElements.indexOf(this);
		if (index > -1) {
			Sticky.allElements.splice(index, 1);
		}
	}
};

Sticky.init();

module.exports = Sticky;



// WEBPACK FOOTER //
// ./static/components/Sticky/Sticky.js