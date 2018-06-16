// AjaxContent
function AjaxContent (elem) {
	this.elem = elem;
	this.elem.ajaxContent = this;
	this.url = elem.data("url");
	this.init();
}

Object.assign(AjaxContent, {
	init: function () {
		document.querySelectorAlways(".AjaxContent", AjaxContent.create);
	},
	create: function (elem) {
		return new AjaxContent(elem);
	},
	createElement: function (options) {
		var options = options || {};
		var elem = document.createElement("div");
		elem.classList.add("AjaxContent");
		if (options.url) { elem.data("url", options.url); }
		if (options.child) { elem.appendChild(options.child); }
		return elem;
	}
});

AjaxContent.prototype = {
	init: function () {
		this.ajax(this.url, this.load.bind(this));
	},
	ajax: function (url, fn) {
		if (!url) { return null; }
		this.startLoading();
		function onload () {
			this.stopLoading();
			if (xhr.status<400) {
				fn(xhr.responseText, xhr);
			} else {
				this.error(xhr);
			}
		}
		var xhr = new XMLHttpRequest();
		xhr.onerror = this.error.bind(this);
		xhr.onload = onload.bind(this);
		xhr.open("GET", encodeURI(url), true);
		xhr.send();
		return xhr;
	},
	update: function(url) {
		if (url) { this.elem.attr("url", url); }
		this.url = this.elem.attr("url");
		this.ajax(this.url, this.load.bind(this));
	},
	error: function (xhr) {
		this.elem.attr("disabled", true);
		this.elem.trigger("error", xhr.status);
	},
	load: function (html) {
		this.elem.innerHTML = html; //TODO: improve with a safer method
		document.querySelectorAlways.update();
		this.elem.trigger("load");
	},
	startLoading: function () {
		this.elem.classList.add("is-loading");
		this.elem.trigger("loading");
	},
	stopLoading: function () {
		this.elem.classList.remove("is-loading");
	}
};

AjaxContent.init();

module.exports = AjaxContent;



// WEBPACK FOOTER //
// ./static/components/AjaxContent/AjaxContent.js