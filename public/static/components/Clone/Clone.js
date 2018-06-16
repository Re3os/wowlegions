// Clone
function Clone (elem) {
	this.elem = elem;
	this.elem.Clone = this;
	this.init();
}

Object.assign(Clone, {
	cloneClass: "is-cloned",
	attr: "data-clone",
	init: function () {
		document.querySelectorAlways(".Clone", Clone.create);
	},
	create: function (elem) {
		return new Clone(elem);
	},
	find: function (elem) {
		return document.querySelector(".CloneSource" + elem.attributeSelector(Clone.attr));
	},
	load: function (source) {
		var clones = document.querySelectorAll(".Clone" + source.attributeSelector(Clone.attr));
		clones.each(function (clone) {
			clone.Clone.load(source);
		});
	}
});

Clone.prototype = {
	init: function () {
		this.load(Clone.find(this.elem));
	},
	get isCloned() {
		return this.elem.classList.contains(Clone.cloneClass);
	},
	load: function (source) {
		if (source && !this.isCloned) {
			this.elem.classList.add(Clone.cloneClass);
			source.classList.add(Clone.cloneClass);
			source.childNodes.each(function (child) {
				this.elem.appendChild(child.cloneNode(true));
			}.bind(this));
		}
	}
};

Clone.init();

module.exports = Clone;


// WEBPACK FOOTER //
// ./static/components/Clone/Clone.js