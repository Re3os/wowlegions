
//VideoPane
function VideoPane (elem) {
	this.elem = elem;
	this.elem.videoPane = this;
	this.video = elem.querySelector(".VideoPane-video");
	this.isInitialized = false;
	this.hasVideoError = false;
	this.init();
}

Object.assign(VideoPane, {
	init: function () {
		document.querySelectorAlways(".VideoPane", VideoPane.create);
	},
	create: function (elem) {
		return new VideoPane(elem);
	}
});

VideoPane.prototype = {
	init: function () {
		if (!this.disabled()) {
			this.bindErrorHandler();
			this.videoInit();
		}
		this.listenToDomEvents();
	},
	listenToDomEvents: function () {
		window.addEventListener("resize", () => { this.update(); });
		document.addEventListener("visibilitychange", () => { this.update(); });
	},
	disabled: function () {
		return this.elem.classList.contains("VideoPane--disabled") || document.hidden;
	},
	update: function () {
		if (this.disabled() && this.isInitialized) {
			return this.pause();
		}
		if (this.isInitialized && !this.hasVideoError) {
			return this.play();
		} 
		this.videoInit();
		if (this.hasVideoError !== true) {
			this.play();
		}
	},
	play: function () {
		this.video.play();
	},
	pause: function () {
		this.video.pause();
	},
	bindErrorHandler: function () {
		this.video.addEventListener("error", (e) => {
			this.onVideoError(e);
		});
	},
	getSourceFilename: function () {
		var url = this.video.src;
		return url.substring(url.lastIndexOf("/") + 1);
	},
	getSourceFileExtension: function (filename) {
		var fileExtensionRegex = /(?:\.([^.]+))?$/;
		return fileExtensionRegex.exec(filename)[1];
	},
	videoInit: function () {
		var fileExtension = this.getSourceFileExtension(this.getSourceFilename());
		if (!this.video.src || !fileExtension) {
			this.video.src = this.video.data("src");
		}
		this.videoInitialized = true;
	},
	onVideoError: function (e) {
		this.elem.classList.add("VideoPane--fallback");
		this.hasVideoError = true;
	}
};

VideoPane.init();

module.exports = VideoPane;



// WEBPACK FOOTER //
// ./static/components/VideoPane/VideoPane.js