var PhotoSwipe           = require("photoswipe/dist/photoswipe.js");
var PhotoSwipeUI_Default = require("photoswipe/dist/photoswipe-ui-default.js");
var pageUrl              = window.pageUrl;

// Photoswipe
function Photoswipe (elem) {
	this.elem = elem;
	this.elem.photoswipe = this;
	this.name = this.elem.attr("name");
	this.prevElem = this.elem.querySelector(".Photoswipe-prev");
	this.nextElem = this.elem.querySelector(".Photoswipe-next");

	this.init();
}

Object.assign(Photoswipe, {
	layers: {},
	history: [],
	init: function () {
		document.querySelectorAlways(".Photoswipe", Photoswipe.create);
	},
	create: function (elem) {
		return new Photoswipe(elem);
	},
	show: function (layer, items, index, type, remember) {
		layer = Photoswipe.layers[layer];

		if (layer) {
			layer.show.call(layer.photoswipe, items, index, type, remember);
		}
	},
	hide: function (layer) {
		layer = Photoswipe.layers[layer];
		if (layer) {
			layer.photoswipe.hide.call(layer.photoswipe);
		}
	},
	layer: function (layer) {
		Photoswipe.layers[layer.name] = layer;
	},
	back: function () {
		if (Photoswipe.history.length > 0) {
			var previousItem = Photoswipe.history.pop();
			var item = previousItem.item;
			var type = previousItem.type;
			Photoswipe.show(item.plugin.layer, item.items(), item.index(), type, false);
		}
	},
	open: function (options) {
		var pswp = Photoswipe.layers[options.layer].photoswipe.elem;
		new PhotoSwipe(pswp, PhotoSwipeUI_Default, options.items, options.options).init();
	},
	onClose: function () {
		delete pageUrl.parts.hash.modal;
		pageUrl.save();
	},
	updateHash: function (name) {
		if (name) {
			pageUrl.parts.hash.modal = name;
		} else {
			delete pageUrl.parts.hash.modal;
		}
		pageUrl.save();
	}
});

Photoswipe.prototype = {
	init: function () {
		var layer = this.layer();
		if (layer) {
			layer.photoswipe = this;
			if (layer.init) {
				layer.init.call(this);
			}
			this.prevElem.addEventListener("click", this.prev.bind(this));
			this.nextElem.addEventListener("click", this.next.bind(this));
		}
	},
	layer: function () {
		return Photoswipe.layers[this.name];
	},
	prev: function () {
		this.pswp && this.pswp.prev();
	},
	next: function () {
		this.pswp && this.pswp.next();
	},
	show: function (items, index) {
		this.layer().show.call(this, items, index);
	},
	hide: function () {
		this.pswp && this.pswp.close();
	}
};

Photoswipe.layer({
	name: "lightbox",
	show: function (items, index) {
		var options = {
			bgOpacity: 1.0,
			history: false,
			showHideOpacity: !items[index].elem,
			index: index,
			arrowEl: false,
			shareEl: false,
			closeOnScroll: false,
			addCaptionHTMLFn: function(item, captionEl, isFake) {
				// item      - slide object
				// captionEl - caption DOM element
				// isFake    - true when content is added to fake caption container

				let container = captionEl.children[0];
				if (item.content && item.content.children.length) {
					if (!isFake) {
						while (container.firstChild) { container.removeChild(container.firstChild); }
						container.appendChild(item.content);
					}
				} else {
					let html = [];

					if (item.title && typeof item.title == "string") {
						html.push(`<div class="PhotoSwipe-caption-title">${item.title}</div>`);
					}

					if (item.caption && typeof item.caption == "string") {
						html.push(`<div class="PhotoSwipe-caption-body">${item.caption}</div>`);
					}

					container.innerHTML = html.join("");
				}

				return true;
			}
		};
		this.pswp = new PhotoSwipe(this.elem, PhotoSwipeUI_Default, items, options);
		this.pswp.listen("destroy", function () { delete this.pswp; }.bind(this));
		this.pswp.listen("close", Photoswipe.onClose);
		this.pswp.listen("afterChange", () => {
			if (this.pswp.currItem.lightbox.canDeepLink) {
				Photoswipe.updateHash(this.pswp.currItem.lightbox.name);
			}
		});
		this.pswp.init();
	}
});

Photoswipe.layer(Photoswipe.modal = {
	name: "modal",
	item: (function () {
		var wrap = document.createElement("div");
		wrap.classList.add("Photoswipe-wrap");
		wrap.classList.add("pswp__close");
		var item = document.createElement("div");
		item.classList.add("Photoswipe-item");
		item.classList.add("pswp__close");
		wrap.appendChild(item);
		var scrollbarWidth = scrollbar.width ? scrollbar.width + 1 : 0; // add one extra pixel to width to prevent FOUC when animating because of rounding issues
		wrap.style.right = -scrollbarWidth + "px";
		return wrap;
	})(),
	wrap: function (item) {
		if (item.html) {
			var wrap = Photoswipe.modal.item.cloneNode(true);
			if (item.html.tagName) {
				wrap.firstChild.appendChild(item.html);
			} else {
				wrap.firstChild.innerHTML = item.html;
			}
			item.html = wrap;
		}
	},
	show: function (items, index, type, remember) {
		items.each(function (item) {
			Photoswipe.modal.wrap(item);
			item.lightbox.hideBackButton();
		});

		// TODO Consider a better way to keep this at the photoswipe layer
		Photoswipe.modal.analyticsType = type;
		Photoswipe.modal.prevIndex = index;
		Photoswipe.modal.currIndex = index;

		if (window.dataLayer) {
			window.dataLayer.push({'event': 'modalClick', 'modalAction': 'Open', 'modalType': Photoswipe.modal.analyticsType});
		}

		// handle opening of a modal when a Photoswipe modal instance is already open.
		if (this.pswp) {
			if (remember !== false) { Photoswipe.history.push({ item: this.pswp.currItem.modal, type: type }); }
			if (Photoswipe.history.length > 0) { items[index].modal.showBackButton(); }
			Photoswipe.modal.replaceItems.call(this, items);
			this.pswp.goTo(index);
			return;
		}

		var options = {
			bgOpacity: 0,
			history: false,
			showHideOpacity: false,
			index: index,
			closeOnScroll: false,
			closeOnVerticalDrag: false,
			closeElClasses: ["close"],
			closeEl:false,
			captionEl: false,
			fullscreenEl: false,
			zoomEl: false,
			shareEl: false,
			counterEl: false,
			arrowEl: false,
			preloaderEl: false,
			isClickableElement: function(el) {
				// prevent photoswipe from hijacking scroll
				return el.tagName === "A" || el.matches(".Photoswipe-item");
			}
		};

		document.body.classList.add("is-overlaid", "is-scrollLocked");

		var pswp = this.pswp = new PhotoSwipe(this.elem, PhotoSwipeUI_Default, items, options);
		pswp.listen("close", function () {
			document.body.classList.remove("is-overlaid", "is-scrollLocked");
			Photoswipe.onClose();
		});
		pswp.listen("destroy", function () {
			items.map(function (item) {
				item.html.remove();
			});
			delete this.pswp;
			Photoswipe.history = [];
		}.bind(this));
		pswp.init();
		// prevent photoswipe from preventing the default scroll action since we wrap the items
		pswp.listen("bindEvents", function () {
			["wheel", "mousewheel", "DOMMouseScroll"].each(function (event) {
				pswp.template.removeEventListener(event, pswp.handleMouseWheel);
			});
		});

		pswp.listen("afterChange", function() {

			Photoswipe.modal.currIndex =  pswp.getCurrentIndex();

			// Only check if the indicies differ
			if (window.dataLayer && Photoswipe.modal.prevIndex !== Photoswipe.modal.currIndex) {
				if (Photoswipe.modal.prevIndex < Photoswipe.modal.currIndex) {
					// If the difference is great than 1, we've looped
					if (Photoswipe.modal.currIndex - Photoswipe.modal.prevIndex > 1) {
						window.dataLayer.push({'event': 'modalClick', 'modalAction': 'Previous', 'modalType': Photoswipe.modal.analyticsType});
					}
					else {
						window.dataLayer.push({'event': 'modalClick', 'modalAction': 'Next', 'modalType': Photoswipe.modal.analyticsType});
					}
				} else {
					// If the difference is greater than 1, we've looped
					if (Photoswipe.modal.prevIndex - Photoswipe.modal.currIndex > 1) {
						window.dataLayer.push({
							'event': 'modalClick',
							'modalAction': 'Next',
							'modalType': Photoswipe.modal.analyticsType
						});
					} else {
						window.dataLayer.push({'event': 'modalClick', 'modalAction': 'Previous', 'modalType': Photoswipe.modal.analyticsType});
					}
				}
			}

			Photoswipe.modal.prevIndex = Photoswipe.modal.currIndex;

		}.bind(this));
	},
	/**
	 * This method must be called using apply() or call() with a bound `this` where this is a WoW-UI Photoswipe instance.
	 */
	replaceItems: function (items) {
		// apply is used here to manipulate the underlying memory locations that the existing `pswp.items` pointer is pointing to.
		// using `pswp.items = [...something]` would create a new array with a new pointer, and photoswipe would become out of sync.
		this.pswp.items.splice.apply(this.pswp.items, [0, this.pswp.items.length].concat(items));
		this.pswp.invalidateCurrItems();
		this.pswp.updateSize(true);
	}
});

Photoswipe.init();

module.exports = Photoswipe;



// WEBPACK FOOTER //
// ./static/components/Photoswipe/Photoswipe.js