// PatchNotes
function PatchNotes (elem) {
	this.elem = elem;
	this.elem.patchNotes = this;
	this.body         = elem.querySelector(".PatchNotes-body");
	this.expandElem   = elem.querySelector(".PatchNotes-expand");
	this.collapseElem = elem.querySelector(".PatchNotes-collapse");
	this.init();
}

Object.assign(PatchNotes, {
	init: function () {
		document.querySelectorAlways(".PatchNotes", PatchNotes.create);
	},
	create: function (elem) {
		return new PatchNotes(elem);
	},
	stop: function (event) {
		event.preventDefault();
	}
});

PatchNotes.prototype = {
	init: function () {
		this.listen(this.expandElem, this.expand);
		this.listen(this.collapseElem, this.collapse);
	},
	listen: function (elem, fn) {
		elem.addEventListener("click", fn.bind(this,elem));
		elem.addEventListener("mousedown", PatchNotes.stop);
	},
	expand: function () {
		this.elem.classList.add("is-expanded");
		this.body.scrollTop = 0;
		if (this.elem.SyncHeight) {
			this.elem.SyncHeight.update();
		}
	},
	collapse: function () {
		this.elem.classList.remove("is-expanded");
		if (this.elem.SyncHeight) {
			this.elem.SyncHeight.update();
		}
	}
};

PatchNotes.init();

module.exports = PatchNotes;


// WEBPACK FOOTER //
// ./static/components/PatchNotes/PatchNotes.js