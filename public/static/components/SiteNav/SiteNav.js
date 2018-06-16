// SiteNav
function SiteNav (elem) {
	this.elem = elem;
	this.elem.siteNav   = this;
	this.searchInput    = elem.querySelector(".SiteNav-searchInput");
	this.searchDropdown = elem.querySelector(".SiteNav-searchDropdown");
	this.searchLinks    = elem.querySelectorAll(".SiteNav-searchLink");
	this.stickyElem     = elem.querySelector(".SiteNav-sticky");
	this.init();
}

Object.assign(SiteNav, {
	elems: [],
	dynamicContentClass: "has-dynamic-content",
	init: function () {
		document.querySelectorAlways(".SiteNav", SiteNav.create);
	},
	create: function (elem) {
		return new SiteNav(elem);
	},
	getStickyOffset: function () {
		var siteNavs = document.querySelectorAll(".SiteNav");
		var stickyOffset = 0;
		var siteNavSticky, siteNavArea;
		for (var i = 0; i < siteNavs.length; i++) {
			siteNavSticky = siteNavs[i].querySelector(".SiteNav-sticky");
			if (siteNavSticky && siteNavSticky.classList.contains("is-active")) {
				siteNavArea = siteNavs[i].querySelector(".SiteNav-area");
				if (siteNavArea) {
					stickyOffset += siteNavArea.offsetHeight;
				}
			}
		}
		return stickyOffset;
	}
});

SiteNav.prototype = {
	init: function () {
		SiteNav.elems.push(this.elem);
		document.addEventListener("keydown", this.keydown.bind(this));
		this.searchLinks.map(this.listen.bind(this));
		function delayedUpdate () {
			requestAnimationFrame(this.onStickyUpdate.bind(this));
		}
		this.stickyElem.addEventListener("update", delayedUpdate.bind(this));
		window.addEventListener("resize", delayedUpdate.bind(this));
		function click (elem) {
			return function (event) {
				event.preventDefault();
				elem.click();
			}
		}
		window.addEventListener("hashchange", () => {
			this.closeActiveDropdown();
		});
	},
	listen: function (link) {
		var click = this.click.bind(this);
		function delayClick () {
			requestAnimationFrame(click);
		}
		link.addEventListener("click", delayClick);
	},
	get active() {
		return this.searchDropdown.classList.contains("is-active");
	},
	get search() {
		return this.searchInput;
	},
	get searchLink() {
		return this.searchLinks[0];
	},
	click: function () {
		if (this.active) {
			this.focus();
		} else {
			this.blur();
		}
	},
	clear: function (input) {
		input.value = "";
	},
	focus: function () {
		this.search.value = "";
		this.search.focus();
		if (!this.active) {
			this.searchLink.click();
		}
	},
	blur: function () {
		this.search.value = "";
		this.search.blur();
	},
	open: function () {
		if (!this.active) {
			this.searchLink.click();
		}
	},
	close: function () {
		if (this.active && !this.search.value) {
			this.searchLink.click();
		}
	},
	keydown: function (event) {
		var isSearchInput = event.target === this.search;
		var isInputElem = event.target.nodeName === "INPUT";
		var isTextAreaElem = event.target.nodeName === "TEXTAREA";
		if (!isSearchInput && (isInputElem || isTextAreaElem)) { return; } //ignore when typing in input or textarea elements
		switch (event.keyCode) {
			case 27: //ESC
				this.close();
				break;
			case 9: //Tab
				if (this.active) {
					this.close();
					event.preventDefault();
					break;
				}
			case 191: //Slash
				if (!this.active) {
					this.open();
					event.preventDefault();
				}
				break;
		}
	},
	onStickyUpdate: function() {
		var isSticky = this.stickyElem.classList.contains("is-active");
		if(isSticky) {
			this.elem.classList.add("SiteNav--thinFull");
		} else {
			this.elem.classList.remove("SiteNav--thinFull");
		}
		this.elem.trigger("update");
	},
	onMobileMenuClick: function (elem) {
		this.elem.classList.remove(SiteNav.dynamicContentClass);
		this.removeDynamicContent();
	},
	removeDynamicContent: function () {
		var existingContents = this.mobileMenuDynamicContentArea.firstChild;
		while (existingContents) {
			if (existingContents) {
				if (existingContents.destroyComponent) {
					existingContents.destroyComponent();
				} else {
					this.mobileMenuDynamicContentArea.removeChild(this.mobileMenuDynamicContentArea.firstChild);
				}
				existingContents = this.mobileMenuDynamicContentArea.firstChild;
			}
		}
	},
	toggleMobileMenu: function () {
		this.mobileMenu.click();
	},
	closeActiveDropdown: function () {
		let doormat = this.elem.querySelector(".SiteNav-doormat.is-active");
		if (doormat) {
			doormat.dropdown.close();
		}
	}
};

SiteNav.init();

module.exports = SiteNav;



// WEBPACK FOOTER //
// ./static/components/SiteNav/SiteNav.js