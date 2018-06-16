// SyncHeight will find the tallest SyncHeight-item element and set all items to that height.
// This allows us to keep content aligned where visually important. The main use case of this
// is with text filled content in a grid.
function SyncHeight (elem) {
	this.elem = elem;
	this.elem.syncHeight = this;
	this.height = 0;
	this.items = elem.querySelectorAll(".SyncHeight-item");
	this.init();
}

Object.assign(SyncHeight, {
	init: function () {
		document.querySelectorAlways(".SyncHeight", SyncHeight.create);
	},
	create: function (elem) {
		return new SyncHeight(elem);
	}
});

SyncHeight.prototype = {
	init: function () {
		this.listen();
		requestAnimationFrame(this.update.bind(this)); //delayed to let other scripts load
	},
	listen: function () {
		window.addEventListener("resize", this.update.bind(this));
		window.addEventListener("load", this.update.bind(this));
	},
	hide: function (elem) {
		elem.style.opacity = "0";
	},
	show: function (elem) {
		elem.style.removeProperty('opacity');
	},
	removeHeight: function (elem) {
		elem.style.removeProperty('height'); // remove the heights of elements so that on resize the elements can be re-sync'd
	},
	getHeight: function (elem) {
		var elemHeight = elem.offsetHeight;
		if (elem.hasAttribute("data-syncheight-multiplier")) {
			elemHeight = elemHeight / elem.data("syncheight-multiplier");
		}
		return elemHeight;
	},
	setHeight: function (elem) {
		var newHeight = this.height;
		if (elem.hasAttribute("data-syncheight-multiplier")) {
			newHeight = newHeight * elem.data("syncheight-multiplier");
		}
		elem.style.height = newHeight + "px";
	},
	reset: function () {
		this.items.map(this.removeHeight.bind(this));
	},
	update: function () {
		if (document.body.classList.contains("is-preloading")) {
			return requestAnimationFrame(this.update.bind(this));
		}
		if (!this.elem.classList.contains("SyncHeight--disabled")) {
			this.items.map(this.hide.bind(this));
			this.reset();
			function recalculate () {
				var heights = this.items.map(this.getHeight.bind(this));
				this.height = Math.max.apply(Math, heights);
				if (this.height) { //elems that are hidden report a height of 0
					this.items.map(this.setHeight.bind(this));
				}
				this.items.map(this.show.bind(this));
			}
			requestAnimationFrame(recalculate.bind(this)); //delay update to allow css to properly apply
		} else {
			this.reset();
		}
	}
};

SyncHeight.init();

module.exports = SyncHeight;



// WEBPACK FOOTER //
// ./static/components/SyncHeight/SyncHeight.js