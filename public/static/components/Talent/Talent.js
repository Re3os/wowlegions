// Clone
function Talent (elem) {
	this.elem = elem;
	this.elem.Talent = this;
	this.checkbox = null;
	this.checkboxInput = null;
	this.init();
}

Object.assign(Talent, {
	activeClass: "is-selected",
	smallModifier: "Talent--small",
	init: function () {
		document.querySelectorAlways(".Talent", Talent.create);
	},
	create: function (elem) {
		return new Talent(elem);
	}
});

Talent.prototype = {
	init: function () {
		this.checkbox = this.elem.querySelector(".Talent-checkbox");
		this.checkboxInput = this.elem.querySelector(".Talent-checkboxInput");
	},
	get isSelected() {
		return this.elem.classList.contains(Talent.activeClass);
	},
	get isCollapsed() {
		return this.elem.classList.contains(Talent.smallModifier);
	},
	select: function() {
		this.elem.classList.add(Talent.activeClass);
		this.checkboxInput.checked = true;
	},
	unselect: function() {
		this.elem.classList.remove(Talent.activeClass);
		this.checkboxInput.checked = false;
	},
	expand: function() {
		this.elem.classList.remove(Talent.smallModifier);
	},
	collapse: function() {
		this.elem.classList.add(Talent.smallModifier);
	},
};

Talent.init();

module.exports = Talent;



// WEBPACK FOOTER //
// ./static/components/Talent/Talent.js