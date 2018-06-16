// CharacterProfile
function CharacterProfile (elem) {
	this.elem = elem;
	this.elem.characterProfile = this;
	this.image = this.elem.querySelector(".CharacterProfile-image");
	this.fallback = this.image.data("fallback");
	this.init();
}

Object.assign(CharacterProfile, {
	init: function () {
		document.querySelectorAlways(".CharacterProfile", CharacterProfile.create);
	},
	create: function (elem) {
		return new CharacterProfile(elem);
	}
});

CharacterProfile.prototype = {
	init: function () {
		if (this.image && this.image.art && this.fallback) {
			var img = new Image();
			img.addEventListener("error", this.onerror.bind(this));
			img.src = this.image.art.url();
		}
	},
	onerror: function () {
		this.image.art.set(this.fallback);
	}
};

CharacterProfile.init();

module.exports = CharacterProfile;



// WEBPACK FOOTER //
// ./static/components/CharacterProfile/CharacterProfile.js