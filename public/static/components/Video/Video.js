// Video
function Video (elem) {
	this.elem = elem;
	this.elem.video = this;
	this.video = elem.querySelector(".Video-video");
	this.started = elem.classList.contains("is-started");
	this.init();
}

Object.assign(Video, {
	init: function () {
		document.querySelectorAlways(".Video", Video.create);
	},
	create: function (elem) {
		return new Video(elem);
	}
});

Video.prototype = {
	init: function () {
		this.youtube();
		this.listen();
	},
	listen: function () {
		this.elem.addEventListener("click", this.onclick.bind(this));
		this.elem.addEventListener("dblclick", this.ondblclick.bind(this));
		this.video.addEventListener("ended", this.onended.bind(this));
	},
	start: function () {
		if (!this.started) {
			this.started = true;
			this.elem.classList.add("is-started");
			// waiting to set the video source till here prevents browsers from preloading the video
			var src = this.video.data("src");
			if (src) {
				this.video.attr("src", src);
			}
		}
	},
	play: function () {
		this.elem.classList.add("is-playing");
		this.video.play();
	},
	pause: function () {
		this.elem.classList.remove("is-playing");
		this.video.pause();
	},
	toggle: function () {
		if (this.video.paused) {
			this.play();
		} else {
			this.pause();
		}
	},
	onclick: function (e) {
		if(this.isDummy()) {
			return;
		}
		this.start();
		this.toggle();
	},
	ondblclick: function (e) {
		e.stopPropagation();
		if(this.isDummy()) {
			return;
		}		
		this.elem.webkitRequestFullscreen(); //TODO: polyfill browser neutral API
		this.play();
	},
	onended: function (e) {
		this.elem.classList.remove("is-playing");
	},
	youtube: function () {
		var src = this.video.data("src");
		var matches = /^https?:\/\/(?:www\.)?youtube.com\/(?:watch\?v=|embed\/)(\w+)/.exec(src);
		var videoID = matches && matches[1];
		if (videoID) {
			var iframe = document.createElement("iframe");
			iframe.src = "https://www.youtube.com/embed/" + videoID + "?wmode=transparent&autohide=1&showinfo=0&controls=0";
			iframe.attr("allowfullscreen", true);
			iframe.classList.add("Video-iframe");
			this.iframe = iframe;
			this.elem.insertBefore(this.iframe, this.elem.firstChild);
		}
	},
	isDummy: function() {
		return this.elem.classList.contains("Video--disabled");
	}
};

Video.init();

module.exports = Video;



// WEBPACK FOOTER //
// ./static/components/Video/Video.js