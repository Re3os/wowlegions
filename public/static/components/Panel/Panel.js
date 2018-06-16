//Panel
function Panel (elem) {
	this.elem = elem;
	this.elem.panel = this;
	this.video = elem.querySelector(".Panel-video");
	this.videoInitialized = false;
	this.init();
}

Object.assign(Panel, {
	init: function () {
		document.querySelectorAlways(".Panel", Panel.create);
	},

	create: function (elem) {
		return new Panel(elem);
	}
});

Panel.prototype = {
	init: function () {
		if (this.video) {
			this.videoInit();
			this.listen();
		}
	},
	listen: function () {
		window.addEventListener("resize", this.update.bind(this));
		document.addEventListener("visibilitychange", this.update.bind(this));
	},
	disabled: function () {
		return this.elem.classList.contains("Panel-video--disabled") || document.hidden;
	},
	update: function () {
		if(!this.disabled()) {
			if(this.videoInitialized) {
				this.play();
			} else {
				this.videoInit();
			}
		} else {
			if(this.videoInitialized) {
				this.pause();
			}
		}
	},
	play: function () {
		this.video.play();
	},
	pause: function () {
		this.video.pause();
	},
	videoInit: function () {
		if(this.disabled()) {
			this.video.src = "";
		} else {
			this.video.src = this.video.data("src");
			this.video.play();
			this.videoInitialized = true;
		}
	}
};

Panel.init();

module.exports = Panel;



// WEBPACK FOOTER //
// ./static/components/Panel/Panel.js