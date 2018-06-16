
// SelectMenu
function SelectMenu (elem) {
	this.elem                  = elem;
	this.elem.SelectMenu       = this;
	this.elem.destroyComponent = this.destroyComponent.bind(this);
	this.clickToCloseListener  = null;
	this.escapeToCloseListener = null;
	this.maxResults            = this.elem.data("max-results") || SelectMenu.maxResults;
	this.toggle                = this.elem.querySelector(".SelectMenu-toggle");
	this.menu                  = this.elem.querySelector(".SelectMenu-menu");
	this.close                 = this.menu.querySelector(".SelectMenu-close");
	this.itemsContainer        = this.elem.querySelector(".SelectMenu-items");
	this.tabs                  = this.elem.querySelector(".Tabs");
	this.input                 = this.menu.querySelector(".SelectMenu-input");
	this.exception             = this.menu.querySelector(".SelectMenu-exception");
	this.defaultsContainer     = this.menu.querySelector(".SelectMenu-defaults");
	this.groups                = this.menu.querySelectorAll(".SelectMenu-group");
	this.items                 = this.menu.querySelectorAll(".SelectMenu-item");
	this.init();
}

Object.assign(SelectMenu, {
	activeClass: "is-active",
	hasMatchesClass: "has-matches",
	hasInputClass: "has-input",
	fullscreenClass: "SelectMenu--fullscreen",
	maxResults: 10,
	elems: [],
	init: function () {
		document.querySelectorAlways(".SelectMenu", SelectMenu.create);
	},
	create: function (elem) {
		return new SelectMenu(elem);
	},
	closeAll: function () {
		SelectMenu.elems.map(function (elem) {
			elem.SelectMenu.closeMenu();
		});
	}
});

SelectMenu.prototype = {
	init: function () {
		this.elem.SelectMenu = this;
		SelectMenu.elems.push(this.elem);
		this.items = this.filterItems();
		this.listen();
	},
	filterItems: function () {
		var self = this;
		var filter = Array.prototype.filter;
		var items = Array.prototype.slice.call(this.items);
		return filter.call(items, (elem) => {
			return elem.parentNode != self.defaultsContainer;
		});
	},
	listen: function () {
		var self = this;
		self.input.addEventListener("input", self.onInput.bind(self));
		self.toggle.addEventListener("click", self.onToggleClick.bind(self));
		self.items.map(function (item) {
			item.addEventListener("click", self.onItemClick.bind(self));
		});
		self.close.addEventListener("click", self.onCloseClick.bind(self));
	},
	openMenu: function () {
		SelectMenu.closeAll();
		trigger("SelectMenu/open", { elem: this.elem });
		this.menu.classList.add(SelectMenu.activeClass);
		this.focusInput();
		var isListening = this.clickToCloseListener != null && this.escapeToCloseListener != null;
		if (!this.windowListening) {
			// bind click to close menus if clicking off of the opened menu
			this.clickToCloseListener = this.onWindowClick.bind(this);
			window.addEventListener("click", this.clickToCloseListener);
			// bind closing the menu with the escape key
			this.escapeToCloseListener = this.onEscapeClick.bind(this);
			window.addEventListener("keydown", this.escapeToCloseListener);
		}
		if (this.isFullscreen()) { document.body.classList.add("z-index-reset"); }
	},
	closeMenu: function () {
		trigger("SelectMenu/close", { elem: this.elem });
		this.menu.classList.remove(SelectMenu.activeClass);
		window.removeEventListener("click", this.clickToCloseListener);
		window.removeEventListener("keydown", this.escapeToCloseListener);
		this.clickToCloseListener = null;
		this.escapeToCloseListener = null;
		if (this.isFullscreen()) { document.body.classList.remove("z-index-reset"); }
	},
	isFullscreen: function () {
		return this.elem.classList.contains(SelectMenu.fullscreenClass);
	},
	focusInput: function () {
		this.input.focus();
	},
	showItem: function (elem) {
		elem.classList.add(SelectMenu.activeClass);
	},
	hideItem: function (elem) {
		elem.classList.remove(SelectMenu.activeClass);
	},
	showException: function () {
		this.exception.classList.add(SelectMenu.activeClass);
	},
	hideException: function () {
		this.exception.classList.remove(SelectMenu.activeClass);
	},
	showDefaults: function () {
		this.elem.classList.remove(SelectMenu.hasInputClass);
	},
	hideDefaults: function () {
		this.elem.classList.add(SelectMenu.hasInputClass);
	},
	addHasMatches: function () {
		this.elem.classList.add(SelectMenu.hasMatchesClass);
	},
	removeHasMatches: function () {
		this.elem.classList.remove(SelectMenu.hasMatchesClass);
	},
	updateToggleLabel: function () {
		var selectionText = this.tabs.querySelector(".is-selected").textContent;
		this.toggle.textContent = selectionText;
	},
	onWindowClick: function (e) {
		e.stopPropagation();
		var isMenuComponent = this.menu.contains(e.target);
		if (isMenuComponent) { return; }
		this.closeMenu();
	},
	onEscapeClick: function (e) {
		if (e.key === "Escape") {
			this.closeMenu();
		}
	},
	onCloseClick: function (e) {
		this.closeMenu();
	},
	onToggleClick: function (e) {
		e.stopPropagation();
		var isMenuOpen = this.menu.classList.contains(SelectMenu.activeClass);
		if (isMenuOpen) {
			this.closeMenu();
		} else {
			this.openMenu();
		}
	},
	onItemClick: function (e) {
		if (this.tabs) {
			this.updateToggleLabel();
		}
		this.closeMenu();
	},
	onInput: function () {
		var value = this.input.value;
		this.hideException();
		this.items.map(this.hideItem.bind(this));
		this.groups.map(this.hideItem.bind(this));
		if (value == "") {
			this.showDefaults();
			this.removeHasMatches();
			return;
		}
		this.hideDefaults();
		value = value.toLowerCase();
		var matches = [];
		for (var i = 0; i < this.items.length; i ++) {
			if (this.valueMatches(this.items[i], value)) {
				matches.push(this.items[i]);
				if (matches.length >= this.maxResults) { break; }
			}
		}
		var maxResults = (matches.length > this.maxResults) ? this.maxResults : matches.length;
		for (var i = 0; i < maxResults; i ++) {
			this.showItem(matches[i]);
			this.showItem(matches[i].parentNode);
		}
		var hasMatches = matches.length > 0;
		if (hasMatches) {
			this.addHasMatches();
		} else {
			this.removeHasMatches();
			this.showException();
		}
	},
	valueMatches: function (item, value) {
		var dataValue = item.data("value").toLowerCase();
		return dataValue.indexOf(value) == 0;
	},
	destroyComponent: function () {
		SelectMenu.elems.splice(SelectMenu.elems.indexOf(this.elem), 1);
		this.elem.remove();
	}
};

SelectMenu.init();

module.exports = SelectMenu;



// WEBPACK FOOTER //
// ./static/components/SelectMenu/SelectMenu.js