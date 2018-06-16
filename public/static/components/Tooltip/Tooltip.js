// Tooltip
function Tooltip (elem) {
	this.elem = elem;
	this.elem.tooltip = this;
	this.name = elem.attr("name");
	this.offset = parseFloat(elem.data("offset") || 20);
	this.init();
}

Object.assign(Tooltip, {
	tooltips: {},
	active: false,
	activeClass: "is-active",
	init: function () { document.querySelectorAlways(".Tooltip", Tooltip.create); },
	create: function (elem) { return new Tooltip(elem); },
	addActive: function (elem) { elem.classList.add(Tooltip.activeClass); },
	removeActive: function (elem) { elem.classList.remove(Tooltip.activeClass); },
	find: function (name) { return Tooltip.tooltips[name]; },
	show: function (name) {
		var tooltip = Tooltip.find(name);
		if (tooltip) { tooltip.show(); }
	},
	hide: function (name) {
		var tooltip = Tooltip.find(name);
		if (tooltip) { tooltip.hide(); }
	},
	link: function (link, name) {
		link.addEventListener("mouseover", () => {
			if (window.supports.touch) { return; }
			let tooltip = Tooltip.find(name);
			if (tooltip) {
				tooltip.show();
			}
		});
		link.addEventListener("mouseout", () => {
			let tooltip = Tooltip.find(name);
			tooltip.hide();
		});
	}
});

Tooltip.prototype = {
	init: function () {
		this.remove();
		Tooltip.tooltips[this.name] = this;
		this.animation = new Animation(this.update.bind(this));
	},
	position: function (position) {
		this.orient(position);
	},
	orient: function (position) {
		var top = Math.min(document.body.clientHeight - this.height - this.offset, position.y + this.offset);
		var left = position.x + this.offset;
		var isOffRight = position.x + this.width + this.offset * 2 > document.body.clientWidth;
		if (isOffRight) {
			var isOffLeft = position.x - this.width < 0;
			if (isOffLeft) { left = document.body.clientWidth - this.width - this.offset; }
			else { left = position.x - this.width - this.offset; }
		}
		this.elem.style.top = top + "px";
		this.elem.style.left = left + "px";
	},
	add: function () {
		document.body.appendChild(this.elem);
	},
	remove: function () {
		this.elem.remove();
	},
	show: function () {
		Tooltip.addActive(this.elem);
		this.add();
		this.width = this.elem.offsetWidth;
		this.height = this.elem.offsetHeight;
		this.update();
		this.animation.start();
	},
	hide: function () {
		this.animation.stop();
		this.remove();
		Tooltip.removeActive(this.elem);
	},
	update: function () {
		this.position(mouse);
	}
};
Tooltip.init();

module.exports = Tooltip;



// WEBPACK FOOTER //
// ./static/components/Tooltip/Tooltip.js