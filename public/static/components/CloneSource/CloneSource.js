var Clone = require("components/Clone/Clone.js");

// CloneSource
function CloneSource (elem) {
	this.elem = elem;
	this.elem.CloneSource = this;
	this.init();
}

Object.assign(CloneSource, {
	init: function () {
		document.querySelectorAlways(".CloneSource", CloneSource.create);
	},
	create: function (elem) {
		return new CloneSource(elem);
	}
});

CloneSource.prototype = {
	init: function () {
		Clone.load(this.elem);
	}
};

CloneSource.init();

module.exports = CloneSource;



// WEBPACK FOOTER //
// ./static/components/CloneSource/CloneSource.js