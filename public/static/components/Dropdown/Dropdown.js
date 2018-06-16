
// Dropdown
function Dropdown (elem) {
	this.elem = elem;
	this.elem.dropdown = this;
	this.name = elem.attr("name");
	this.init();
}

Object.assign(Dropdown, {
	elems: [],
	active: false,
	activeClass: "is-active",
	dataAttr: "data-dropdown",
	groupAttr: "data-dropdown-group",
	init: function () {
		document.querySelectorAlways(".Dropdown", Dropdown.create);
		document.addEventListener("click", Dropdown.onclick);
	},
	create: function (elem) {
		return new Dropdown(elem);
	},
	link: function (link, name) {
		link.addEventListener("click", Dropdown.onLinkClick.bind(this, name));
	},
	addActive: function (elem) {
		elem.classList.add(Dropdown.activeClass);
		elem.querySelectorAll(".SyncHeight").map(Dropdown.updateSync);
	},
	removeActive: function (elem) {
		elem.classList.remove(Dropdown.activeClass);
	},
	updateSync: function (elem) {
		elem.syncHeight.update();
	},
	addOverlap: function (elem) {
		var link = document.querySelector(".DropdownLink" + elem.attributeSelector("data-dropdown-anchor"));
		var dropdown = document.querySelector(".Dropdown" + elem.attributeSelector("data-dropdown-anchor"));
		if (link && dropdown) {
			var linkLeft = link.offsetLeft;
			var linkWidth = link.offsetWidth;
			dropdown.style.left = linkLeft + "px";
			//TODO: Split this off into a separate function - Use if you want the dropdown to be the same width as the link it is anchored to
			dropdown.style.width = linkWidth + "px";
		}
	},
	select: function (elem) {
		var isOpen = elem.classList.contains(Dropdown.activeClass);
		if (isOpen) {
			Dropdown.close(elem);
		} else {
			Dropdown.open(elem);
		}
	},
	close: function (elem) {
		Dropdown.active = false;
		Dropdown.removeActive(elem);
		elem.dropdown.links.map(Dropdown.removeActive);
	},
	open: function (elem) {
		var groupName = elem.attr(Dropdown.groupAttr);
		if (groupName) {
			Dropdown.findAllInGroup(elem).map(Dropdown.close);
		} else {
			Dropdown.closeAll();
		}
		Dropdown.active = true;
		Dropdown.addActive(elem);
		elem.dropdown.links.map(Dropdown.addActive);
	},
	find: function (name) {
		var query = `.Dropdown[name=${name}]`;
		var elems = document.querySelectorAll(query);
		return elems && elems.length ? elems[0].dropdown : undefined;
	},
	findAll: function (elem) {
		var query = ".Dropdown" + elem.attributeSelector(Dropdown.dataAttr);
		return NodeList.prototype.matches.call(Dropdown.elems, query);
	},
	findAllInGroup: function (elem) {
		var query = ".Dropdown" + elem.attributeSelector(Dropdown.groupAttr);
		return NodeList.prototype.matches.call(Dropdown.elems, query);
	},
	onLinkClick: function (name) {
		var dropdown = Dropdown.find(name);
		if (dropdown) { dropdown.select(); }
	},
	onclick: function (event) {
		if (Dropdown.active) {
			var node = event.target;
			while (node !== document) {
				var isDropdown = node.classList.contains("Dropdown");
				var isClosedOnClick = node.classList.contains("Dropdown--closedOnClick");
				var isLink = node.classList.contains("Link");
				if ((isDropdown && !isClosedOnClick) || isLink) {
					return;
				}
				node = node.parentNode;
			}
			Dropdown.closeAll();
			Dropdown.active = false;
		}
	},
	closeAll: function () {
		Dropdown.elems.map(Dropdown.close);
	}
});

Dropdown.prototype = {
	init: function () {
		Dropdown.elems.push(this.elem);
	},
	get links () {
		// This isn't great because Dropdown is aware of Links selector,
		// but to avoid a circular dependency Dropdown can not require Link...
		var query = ".Link[data-dropdown='" + this.name + "']";
		var elems = document.querySelectorAll(query);
		return elems;
	},
	select: function (link) {
		Dropdown.select(this.elem);
	},
	close: function () {
		Dropdown.close(this.elem);
	}
};
Dropdown.init();

module.exports = Dropdown;



// WEBPACK FOOTER //
// ./static/components/Dropdown/Dropdown.js