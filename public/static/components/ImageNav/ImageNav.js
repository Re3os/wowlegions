// ImageNav
function ImageNav (elem) {
	this.elem = elem;
	this.elem.imageNav = this;
	this.imageNavList = elem.querySelector(".ImageNav-list");
	this.imageNavListItems = elem.querySelectorAll(".ImageNav-listItem");
	this.isDefault = elem.classList.contains("ImageNav--default");
	this.isMatchSlug = elem.classList.contains("ImageNav--matchSlug");
	this.imageNavTimeline = document.querySelector(".Carousel-desktopView") != false;
	this.init();
}

Object.assign(ImageNav, {
	init: function () {
		document.querySelectorAlways(".ImageNav", ImageNav.create);
	},
	create: function (elem) {
		return new ImageNav(elem);
	}
});

ImageNav.prototype = {
	init: function () {
		this.findDefault();
		this.selectDefault();
		this.findSlug();
		this.findSlugMatch();
		this.scrollToSelected();
	},
	findDefault: function () {
		var defaultItem = this.elem.querySelector(".ImageNav-listItem--default");
		var firstItem = this.imageNavListItems[0];
		this.defaultItem = defaultItem || firstItem;
	},
	selectDefault: function () {
		if (!this.isDefault) {
			return false;
		}
		if (this.defaultItem) {
			this.selectItem(this.defaultItem);
		}
	},
	findSlug: function () {
		var pathArray = window.location.pathname.split("/");
		if (!pathArray[pathArray.length - 1]) {
			// if there is nothing at index
			pathArray.pop();
		}
		this.slug = pathArray.pop();
	},
	findSlugMatch: function () {
		if (!this.isMatchSlug) {
			return false;
		}
		if (this.slug) {
			var matchingItem;
			// In order to get the hiding of arrows to work on the index page we need a beginning / on our game ids
				// since this could be reusable I added this check to account for only this use case
			var isTimeline = this.imageNavTimeline
			var slugWeWant = isTimeline ? "/" + this.slug : this.slug; // save scope

			this.imageNavListItems.forEach(function (item) {
				// Dealing with the edge case of / navigation vs. /timeline navigation
					// I think having editors just put / for home page makes the other pages work better so this wonky logic will just be here.
				if (item.data("imagenav-item") == slugWeWant || item.data("imagenav-item") + "timeline" == slugWeWant ) {
					matchingItem = item;
				}
			});
			if (matchingItem) {
				this.selectItem(matchingItem);
			}
		}
	},
	selectItem: function (elem) {
		this.removeSelection();
		elem.classList.add("ImageNav-listItem--selected");
	},
	removeSelection: function () {
		this.imageNavListItems.forEach(function (item) {
			item.classList.remove("ImageNav-listItem--selected");
		});
	},
	scrollToSelected: function () {
		var selectedItem = this.imageNavList.querySelector(".ImageNav-listItem--selected");
		var firstNotSelectedItem = this.imageNavList.querySelector(".ImageNav-listItem:not(.ImageNav-listItem--selected)");
		if (selectedItem && firstNotSelectedItem) {
			var selectedItemPosition = this.imageNavListItems.indexOf(selectedItem);
			var defaultItemWidth = firstNotSelectedItem.offsetWidth || ~~window.getComputedStyle(firstNotSelectedItem).width;
			var defaultListLeft = window.getComputedStyle(this.imageNavList).marginLeft;
			this.imageNavList.style.marginLeft = parseInt(defaultListLeft) - (defaultItemWidth * selectedItemPosition) + "px";
		}
	}
};

ImageNav.init();

module.exports = ImageNav;



// WEBPACK FOOTER //
// ./static/components/ImageNav/ImageNav.js