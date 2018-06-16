// Pane
function Pane (elem) {
	this.elem = elem;
	this.elem.pane = this;
	this.bg = elem.querySelector(".Pane-bg");
	this.url    = elem.data("url");
	this.original = this.url;
	this.small  = elem.data("small");
	this.medium = elem.data("medium");
	this.large  = elem.data("large");

	this.forceStickyUpdate = false;
	this.forceFadeUpdate = false;

	// To actually implement variable speed parallax effects, the backdrop size must be adjusted as well (see Pane.less)
	this.parallaxSpeed = 50.0; // Speed of parallax effect, measured in percentage points (higher is faster)
	this.isParallax = elem.classList.contains("Pane--parallax");
	this.isParallaxReverse = elem.classList.contains("Pane--parallaxReverse");

	this.isSticky = elem.classList.contains("Pane--sticky");
	this.isStuck = false;

	this.fadeSpeed = 2.0; // Speed of fade effect as a ratio of opacity to scroll distance (higher is faster)
	this.fadeMinimum = 0.1; // Minimum opacity
	this.fadeMaximum = 1.0; // Maximum opacity
	this.isFading = elem.classList.contains("Pane--fade");
	this.isFaded = false;

	this.init();
}

Object.assign(Pane, {
	init: function () {
		document.querySelectorAlways(".Pane", Pane.create);
	},
	create: function (elem) {
		return new Pane(elem);
	},
	background: function (url) {
		return `url("${url}")`;
	}
});

// Detects whether the specified element is visible within the current viewport.
Pane.isInView = function (elem, viewportHeight) {
	var rect = elem.getBoundingClientRect();
	var top = rect.top + elem.offsetHeight;
	var bottom = rect.bottom - elem.offsetHeight;
	return (
		top >= 0 &&
		bottom <= viewportHeight
	);
};

Pane.prototype = {
	init: function () {
		this.listen();
	},
	listen: function () {
		this.updateBound = this.update.bind(this);
		window.addEventListener("scroll", this.updateBound);
		window.addEventListener("resize", function() {
			this.forceStickyUpdate = true;
			this.forceFadeUpdate = true;
			this.updateBound();
		}.bind(this));
		this.update();
	},
	update: function () {
		if (this.elem.classList.contains("Pane--viewport")) {
			this.elem.style.height = `${window.innerHeight}px`;
		}
		// This needs to be checked on every cycle in case the Pane gains or loses Pane--parallax
		if (this.elem.classList.contains("Pane--parallax")) {
			requestAnimationFrame(this.renderParallax.bind(this));
			this.isParallax = true;
		} else {
			// Remove the parallax styling if the element loses its parallax class
			// (i.e. if it's removed by a responsive snap-point)
			if (this.isParallax) {
				this.bg.style.top = "";
				this.isParallax = false;
			}
		}
		if (this.isSticky) {
			requestAnimationFrame(this.renderSticky.bind(this));
		}
		if (this.isFading) {
			requestAnimationFrame(this.renderFading.bind(this));
		}

		let isSmall  = this.elem.classList.contains("Pane--small");
		let isMedium = this.elem.classList.contains("Pane--medium");
		let isLarge  = this.elem.classList.contains("Pane--large");
		let isBackground = isSmall || isMedium || isLarge;
		if (isSmall && this.url != this.small) { this.background(this.small); }
		if (isMedium && this.url != this.medium) { this.background(this.medium); }
		if (isLarge && this.url != this.large) { this.background(this.large); }
		if (!isBackground && this.url != this.original) { this.background(this.original); }
	},
	background: function (url) {
		this.url = url;
		this.bg.style.backgroundImage = Pane.background(url);
	},
	renderParallax: function() {
		var viewportHeight = (window.innerHeight || document.documentElement.clientHeight);
		if (Pane.isInView(this.elem, viewportHeight)) {
			// Adjust the position of the background image based on the scroll distance of the Pane within the viewport
			var rect = this.elem.getBoundingClientRect();
			var middle = rect.top + rect.height / 2;
			var percentScrolled = (this.parallaxSpeed * (0.0 - middle / viewportHeight)).toFixed(2);
			if (this.isParallaxReverse) {
				percentScrolled = -percentScrolled-50;
			}
			this.bg.style.top = percentScrolled + '%';
		}
	},
	renderSticky: function() {
		var rect = this.elem.getBoundingClientRect();
		if(rect.top > 0) {
			if (this.isStuck || this.forceStickyUpdate) {
				this.bg.classList.remove("is-active");
				this.bg.style.height = "";
				this.isStuck = false;
				this.forceStickyUpdate = false;
			}
		} else {
			if (!this.isStuck || this.forceStickyUpdate) {
				var viewportHeight = (window.innerHeight || document.documentElement.clientHeight);
				this.bg.classList.add("is-active");
				this.bg.style.height = viewportHeight + "px";
				this.isStuck = true;
				this.forceStickyUpdate = false;
			}
		}
	},
	renderFading: function() {
		var rect = this.elem.getBoundingClientRect();
		if(rect.top >= 0) {
			if (this.isFaded || this.forceFadeUpdate) {
				this.bg.style.opacity = "";
				this.isFaded = false;
				this.forceFadeUpdate = false;
			}
		} else {
			var viewportHeight = (window.innerHeight || document.documentElement.clientHeight);
			var opacity = Math.max(this.fadeMinimum, Math.min((1 - (this.fadeSpeed * Math.abs(rect.top) / viewportHeight)), this.fadeMaximum));
			this.bg.style.opacity = ((opacity < 1.0) ? opacity.toFixed(2) : null);
			this.isFaded = true;
			this.forceFadeUpdate = false;
		}
	}
};

Pane.init();

module.exports = Pane;



// WEBPACK FOOTER //
// ./static/components/Pane/Pane.js