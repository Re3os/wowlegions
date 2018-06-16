//Art
function Art (elem) {
	this.elem = elem;
	this.elem.art = this;
	this.image = elem.querySelector(".Art-image");
	this.video = elem.querySelector(".Art-video");
	this.init();
}

Object.assign(Art, {
	init: function () {
		document.querySelectorAlways(".Art", Art.create);
	},

	create: function (elem) {
		return new Art(elem);
	}
});

Art.prototype = {
	init: function () {
		// The Art JavaScript class currently only exists for the handling of video,
		// which is why the listen and update functions only execute if the 'this.video' condition is met.
		if (this.video) {
			this.listen();
			this.update();
		}
	},
	url: function () {
		return this.image.style.backgroundImage.replace(/^url\(['"]?/, "").replace(/['"]?\)/, "");
	},
	set: function (url) {
		this.image.style.backgroundImage = "url(\"" + url + "\")";
	},
	listen: function () {
		window.addEventListener("resize", this.update.bind(this));
	},
	disabled: function () {
		return this.elem.classList.contains("Art--disabled");
	},
	update: function () {
		if(this.disabled()) {
			this.video.classList.add("VideoPane--disabled");
		} else {
			this.video.classList.remove("VideoPane--disabled");
		}
	}
};

Art.init();

module.exports = Art;



// WEBPACK FOOTER //
// ./static/components/Art/Art.js