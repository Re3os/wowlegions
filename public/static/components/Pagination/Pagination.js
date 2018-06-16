var AjaxContent = require("components/AjaxContent/AjaxContent.js");

// Pagination
function Pagination (elem) {
	this.elem = elem;
	this.elem.Pagination = this;

	this.url   = elem.data("url");
	this.page  = ~~elem.data("page")  || 1;
	this.total = ~~elem.data("total") || 1;
	this.size  = elem.data("size");
	this.start = elem.data("start");
	this.end   = elem.data("end");

	this.nav       = elem.querySelector(".Pagination-nav");
	this.loadmore  = elem.querySelector(".Pagination-loadmore");
	this.container = elem.querySelector(".Pagination-pages");

	this.pages = [];
	this.pages.length = this.total;

	this.init();
}

Object.assign(Pagination, {
	init: function () {
		document.querySelectorAlways(".Pagination", Pagination.create);
	},
	create: function (elem) {
		return new Pagination(elem);
	}
});

Pagination.prototype = {
	init: function () {
		this.initPage();
		if (this.loadmore) {
			this.loadmore.addEventListener("click", this.nextPage.bind(this));
		}
		this.setPage();
	},
	initPage: function () {
		this.elem.querySelectorAll(".Pagination-page").map(this.savePage.bind(this));
	},
	savePage: function (elem) {
		var page = ~~elem.data("page") || 1;
		this.pages[page-1] = elem;
	},
	nextPage: function () {
		if (this.page < this.total) {
			this.setPage(this.page + 1);
		}
	},
	setPage: function (page) {
		if (page) {
			if (!this.loadmore) {
				this.hidePage(this.page);
			}
			this.page = page;
		}
		this.showPage(this.page);
		var isLastPage = this.page == this.total;
		if (isLastPage) {
			if (this.loadmore) {
				this.nav.classList.add("hide");
			}
		} else {
			this.preloadPage(this.page+1);
		}
	},
	hidePage: function (page) {
		var elem = this.pages[page-1];
		if (elem) {
			elem.classList.add("hide");
		}
	},
	showPage: function (page) {
		var elem = this.pages[page-1];
		if (elem) {
			elem.classList.remove("hide");
			window.trigger("resize");
		} else {
			this.addPage(page);
		}
	},
	preloadPage: function (page) {
		var elem = this.pages[page-1];
		if (!elem) {
			elem = this.addPage(page);
			elem.addEventListener("loading", function () {
				elem.classList.add("hide");
			});
		}
	},
	addPage: function (page) {
		var elem = this.createPage(page);
		this.pages[page-1] = elem;
		elem.addEventListener("load", this.stopLoading.bind(this));
		this.startLoading();
		var nextPage = this.findNextPage(page);
		if (nextPage) {
			this.container.insertBefore(elem, nextPage);
		} else {
			this.container.appendChild(elem);
		}
		return elem;
	},
	createPage: function (page) {
		var elem = AjaxContent.createElement({ url: this.createUrl(page) });
		elem.classList.add("Pagination-page");
		elem.data("page", page);
		return elem;
	},
	createUrl: function (page) {
		var hasQuery = ~this.url.indexOf("?");
		var url = this.url + (hasQuery?"&":"?") + "page=" + page || this.page;
		if (this.size)  { url += "&size="  + this.size;  }
		if (this.start) { url += "&start=" + this.start; }
		if (this.end)   { url += "&end="   + this.end;   }
		return url;
	},
	findNextPage: function (page) {
		while(!this.pages[page] && page < this.total){ page++; }
		return this.pages[page];
	},
	startLoading: function () {
		if (this.loadmore) {
			this.loadmore.attr("disabled", true);
		}
		this.elem.classList.add("is-loading");
	},
	stopLoading: function () {
		if (this.loadmore) {
			this.loadmore.attr("disabled", null);
		}
		this.elem.classList.remove("is-loading");
	}
};

Pagination.init();

module.exports = Pagination;



// WEBPACK FOOTER //
// ./static/components/Pagination/Pagination.js