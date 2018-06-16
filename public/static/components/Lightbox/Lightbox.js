var Photoswipe         = require("components/Photoswipe/Photoswipe.js");
var NeteaseVideoPlayer = require("components/NeteaseVideoPlayer/NeteaseVideoPlayer.js");
var Spinner            = require("components/Spinner/Spinner.js");
var AjaxContent        = require("components/AjaxContent/AjaxContent.js");
var Tooltip            = require("components/Tooltip/Tooltip.js");
var pageUrl            = window.pageUrl;

// Lightbox
function Lightbox (elem) {
	this.elem = elem;
	this.elem.lightbox = this;
	this.type = this.elem.attr("type");
	this.name = this.elem.attr("name");
	this.group = this.elem.data("group");
	this.thumb = this.elem.data("thumb");
	this.title = this.elem.data("title");
	this.caption = this.elem.data("caption");
	this.analyticsType = this.elem.data("analytics-type");
	this.content = this.elem.querySelector(".Lightbox-content");
	this.back = this.elem.querySelector(".Lightbox-back");
	this.close = this.elem.querySelector(".Lightbox-close");
	this.init();
}

Object.assign(Lightbox, {
	groups: {},
	plugins: {},
	// TODO: comeup with a better name. Our stateful classes should by convention be `.is-state`.
	hasHistoryClass: "Lightbox--hasHistory",
	canDeepLinkClass: "Lightbox--canDeepLink",
	loadedFromHash: false,
	init: function () {
		document.querySelectorAlways(".Lightbox", Lightbox.create);
	},
	create: function (elem) {
		return new Lightbox(elem);
	},
	find: function (name, type) {
		var plugin = Lightbox.plugins[type];
		if (plugin) {
			return plugin.lightboxes[name];
		}
	},
	link: function (link, name, type, analyticType) {
		let self = this;
		function onLinkClick (e) {
			e.preventDefault();
			var lightbox = Lightbox.find(name, type);
			if (lightbox) {
				self.analyticsType = analyticType;
				lightbox.analyticsType = analyticType;
				lightbox.link(link);
				link.removeEventListener("click", onLinkClick);
				lightbox.show(lightbox.elem, e);
			}
		}
		link.addEventListener("click", onLinkClick);
	},
	stop: function (event) {
		if (!event) { return true };
		if (event.target.nodeName != "INPUT" && !event.ctrlKey) {
			event.preventDefault();
			return true;
		}
	},
	hideTooltip: function (elem) {
		var tooltip = elem.data("tooltip");
		if (tooltip) {
			tooltip = Tooltip.find(tooltip);
			if (tooltip) {
				tooltip.hide();
			}
		}
	},
	group: function (group) {
		return Lightbox.groups[group] || (Lightbox.groups[group] = []);
	},
	plugin: function (plugin) {
		Lightbox.plugins[plugin.type] = plugin;
		plugin.lightboxes = {};
	}
});

Lightbox.prototype = {
	init: function () {
		var plugin = Lightbox.plugins[this.type];
		if (plugin) {
			this.plugin = plugin;
			plugin.lightboxes[this.name] = this; //save for fast lookup of lightboxes
			this.elem.remove(); //prevents iframes from loading
			if (this.group) {
				Lightbox.group(this.group).push(this);
			}
			if (plugin.init) {
				plugin.init.call(this);
			}
			this.back.addEventListener("click", Photoswipe.back);
			this.close.addEventListener("touchend", this.hide.bind(this));
			this.canDeepLink = this.elem.classList.contains(Lightbox.canDeepLinkClass);
			if (this.canDeepLink) { this.showOnLoad(); }
		}
	},
	link: function (elem) {
		elem.addEventListener("click", this.show.bind(this, elem));
		elem.addEventListener("mousedown", Lightbox.stop);
		if (!this.firstLink) {
			this.firstLink = elem;
		}
		if (this.plugin.link) {
			this.plugin.link.call(this, elem);
		}
	},
	findGroup: function () {
		return Lightbox.groups[this.group] || [this];
	},
	item: function () {
		var item = this.plugin.item.call(this, this.elem);
		if (item) {
			item.lightbox = this;
			return item;
		}
	},
	index: function () {
		return this.findGroup().indexOf(this);
	},
	items: function () {
		return this.findGroup().map(function (lightbox) { return lightbox.item(); });
	},
	show: function (elem, event) {
		if (Lightbox.stop(event)) {
			if (elem) { Lightbox.hideTooltip(elem); }
			var layer = this.plugin.layer;
			var items = this.items();
			var index = this.index();
			var type = this.analyticsType;
			if (elem) { items[index].elem = elem; }
			Photoswipe.show(layer, items, index, type);
			if (this.canDeepLink) { Photoswipe.updateHash(this.name); }
		}
	},
	showOnLoad: function () {
		let shouldShow =
			pageUrl.parts.hash.modal
			&& pageUrl.parts.hash.modal == this.name
			&& Lightbox.loadedFromHash == false;
		if (shouldShow) {
			Lightbox.loadedFromHash = true;
			this.show();
		}
	},
	hide: function (event) {
		Lightbox.stop(event);
		Photoswipe.hide(this.plugin.layer);
	},
	showBackButton: function () {
		this.elem.classList.add(Lightbox.hasHistoryClass);
	},
	hideBackButton: function () {
		this.elem.classList.remove(Lightbox.hasHistoryClass);
	}
};


// Image Lightboxes;
Lightbox.plugin({
	type: "IMAGE",
	layer: "lightbox",
	init: function () {
		this.image = this.elem.data("image");
		this.width  = ~~this.elem.attr("width");
		this.height = ~~this.elem.attr("height");
	},
	link: function (link) {
		link.href = this.image;
	},
	item: function () {
		return {
			src: this.image,
			msrc: undefined, //this.thumb
			w: this.width,
			h: this.height,
			elem: this.firstLink,
			title: this.title || true,
			caption: this.caption || true,
			content: this.content
		};
	}
});


// Video Lightboxes
Lightbox.plugin(Lightbox.video = {
	type: "VIDEO",
	layer: "modal",
	neteaseFallbackElem: null,
	sites: [],
	extensions: [],
	a: function (url) {
		var a = document.createElement("a");
		a.href = url;
		return a;
	},
	site: function (url) {
		let hostname = Lightbox.video.a(url).hostname;
		return Lightbox.video.sites[hostname];
	},
	extension: function (url) {
		let ext = url.split(".").pop();
		return Lightbox.video.extensions[ext];
	},
	init: function () {
		this.video = this.elem.data("video");
		let site = Lightbox.video.site(this.video);
		let video = null;
		if (site) {
			video = site.call(this);
		} else {
			let extension = Lightbox.video.extension(this.video);
			if (extension) { video = extension.call(this); }
		}
		if (video) {
			this.elem.appendChild(video);
		}
	},
	link: function (link) {
		link.href = this.video;
	},
	item: function () {
		return {html:this.elem};
	}
});

Lightbox.video.youtube = function (youtubeID) {
	var video = document.createElement("iframe");
	video.classList.add("Lightbox-video");
	video.attr("src", "//www.youtube.com/embed/" + youtubeID + "?autoplay=1&showinfo=0");
	video.attr("frameborder", "0");
	video.attr("allowfullscreen", true);
	return video;
};

Lightbox.video.netease = function (options) {
	return NeteaseVideoPlayer.createElement(options);
};

Lightbox.video.mp4 = function (url) {
	let video = document.createElement("video");
	video.classList.add("Lightbox-video");
	video.attr("src", url);
	video.attr("autoplay", false);
	video.attr("controls", true);
	return video;
};

Lightbox.video.sites["youtu.be"] = function () {
	//                          _____1_____
	// matches https://youtu.be/-_bdvyWv_aQ
	var videoId = /\/([-\w]+)/.exec(Lightbox.video.a(this.video).pathname);
	if (videoId) { return Lightbox.video.youtube(videoId[1]); }
};

Lightbox.video.sites["www.youtube.com"] = Lightbox.video.sites["youtube.com"] = function () {
	//                                         _____1_____                                   _____1_____
	// matches https://www.youtube.com/watch?v=xyPzTywUBsQ and https://www.youtube.com/embed/xyPzTywUBsQ
	var videoId = /(?:(?:\?|&)v=|\/embed\/)([-\w]+)/.exec(this.video);
	if (videoId) { return Lightbox.video.youtube(videoId[1]); }
};

Lightbox.video.sites["www.v.163.com"] = Lightbox.video.sites["v.163.com"] = function () {
	var options = NeteaseVideoPlayer.parseUrl(this.video);
	return Lightbox.video.netease(options);
};

Lightbox.video.extensions["mp4"] = function () {
	return Lightbox.video.mp4(this.video);
};

// Comic Lightboxes
Lightbox.plugin({
	type: "COMIC",
	layer: "modal",
	init: function () {
		this.comic = this.elem.data("comic");
		if (this.comic) {
			var comicViewer = document.createElement("iframe");
			comicViewer.classList.add("Lightbox-comic");
			comicViewer.attr("src", this.comic + "/modal");
			comicViewer.attr("frameborder", "0");
			comicViewer.attr("allowfullscreen", true);
			this.elem.appendChild(comicViewer);
		}
	},
	item: function () {
		return {html:this.elem};
	}
});

// HTML Lightboxes
Lightbox.plugin({
	type: "MODAL",
	layer: "modal",
	init: function () {
		this.url = this.elem.data("url");
		if (this.url) {
			var spinner = Spinner.createElement();
			spinner.classList.add("Spinner--donut");
			spinner.classList.add("contain-center");
			var ajax = AjaxContent.createElement({ url: this.url, child: spinner });
			this.elem.appendChild(ajax);
		}
	},
	item: function () {
		return {html:this.elem};
	}
});


Lightbox.init();

module.exports = Lightbox;



// WEBPACK FOOTER //
// ./static/components/Lightbox/Lightbox.js