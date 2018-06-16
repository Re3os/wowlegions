// GameTooltip
function GameTooltip (elem) {
	this.elem = elem;
	this.elem.GameTooltip = this;
	this.init();
}

Object.assign(GameTooltip, {
	init: function () {
		document.querySelectorAlways(".GameTooltip", GameTooltip.create);
	},
	create: function (elem) {
		return new GameTooltip(elem);
	}
});

GameTooltip.prototype = {
	init: function () {
		this.elem.querySelectorAll("a").forEach(function (anchor) {
			anchor.addEventListener("click", function (e) { e.preventDefault(); });
		});
	}
};

GameTooltip.init();

module.exports = GameTooltip;


// WEBPACK FOOTER //
// ./static/components/GameTooltip/GameTooltip.js