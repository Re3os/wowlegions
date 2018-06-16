// BrowserWarning
function BrowserWarning (elem) {
	this.elem = elem;
	this.elem.browserWarning = this;
	this.init();
}

Object.assign(BrowserWarning, {
	init: function () {
		document.querySelectorAlways(".BrowserWarning", BrowserWarning.create);
	},
	create: function (elem) {
		return new BrowserWarning(elem);
	},
	oldIEregex: /MSIE [5-8]\.\d+;/
});

BrowserWarning.prototype = {
	init: function () {
		var isOldIE = BrowserWarning.oldIEregex.test(navigator.userAgent);
		if (isOldIE) {
			this.elem.classList.add("is-active");
		}
	}
};

BrowserWarning.init();

module.exports = BrowserWarning;



// WEBPACK FOOTER //
// ./static/components/BrowserWarning/BrowserWarning.js