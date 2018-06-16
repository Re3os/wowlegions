var Photoswipe = require("components/Photoswipe/Photoswipe.js");

// Blog
function Blog (elem) {
	this.elem = elem;
	this.elem.blog = this;
	this.links = elem.querySelectorAll("a.lightbox");
	this.init();
}

Object.assign(Blog, {
	init: function () {
		document.querySelectorAlways(".Blog", Blog.create);
	},
	create: function (elem) {
		return new Blog(elem);
	}
});

Blog.prototype = {
	init: function () {
		this.links.each(this.listen.bind(this));
	},
	listen: function (link) {
		link.addEventListener("click", this.click.bind(this, link));
	},
	click: function (link, event) {
		event.preventDefault();
		var img = new Image();
		img.src = link.href;
		var timer = new Animation(checkImage.bind(this));
		function checkImage () {
			if (img.naturalWidth) {
				timer.stop();
				this.lightbox({src:img.src, msrc:img.src, w:img.naturalWidth, h:img.naturalHeight});
			}
		}
		timer.start();
	},
	lightbox: function (item) {
		var options = {
			bgOpacity: 1.0,
			history: false,
			showHideOpacity: false,
			index: 0,
			arrowEl: false,
			shareEl: false
		};
		Photoswipe.open({
			layer: "lightbox",
			options: options,
			items: [item]
		});
	}
};

Blog.init();

module.exports = Blog;



// WEBPACK FOOTER //
// ./static/components/Blog/Blog.js