// SocialButtons
function SocialButtons (elem) {
	this.elem = elem;
	this.elem.SocialButtons = this;
	this.init();
}

Object.assign(SocialButtons, {
	init: function () {
		document.querySelectorAlways(".SocialButtons", SocialButtons.create);
	},
	create: function (elem) {
		return new SocialButtons(elem);
	},
	openPopup: function (href, height, width) {
		window.open(href, "", "height=" + height + ",width=" + width).focus();
	}
});

SocialButtons.prototype = {
	init: function () {
		var socialButtonsLinks = this.elem.getElementsByClassName("SocialButtons-link");

		for (var i = 0; i < socialButtonsLinks.length; i++) {
			socialButtonsLinks[i].onclick = function() {
				SocialButtons.openPopup(this.attr("href") , this.data("popup-height"), this.data("popup-width"));
				return false;
			};
		}
	}
};

SocialButtons.init();

module.exports = SocialButtons;



// WEBPACK FOOTER //
// ./static/components/SocialButtons/SocialButtons.js