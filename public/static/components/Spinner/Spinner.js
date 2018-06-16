// Spinner
function Spinner (elem) {
	this.elem = elem;
	this.elem.spinner = this;
	this.init();
}

Object.assign(Spinner, {
	init: function () {
		document.querySelectorAlways(".Spinner", Spinner.create);
	},
	create: function (elem) {
		return new Spinner(elem);
	},
	createElement: function () {
		var elem = document.createElement("div");
			elem.classList.add("Spinner");

		var orange = [
			"<div class='Spinner-orange'></div>"
		].join("");
		var div = document.createElement("div");
		div.innerHTML = orange;
		elem.appendChild(div.firstChild);

		var donut = [
			"<div class='Spinner-donut'>",
				"<div class='Spinner-donut-icon'>",
					"<div class='Spinner-donut-cut'>",
						"<div class='Spinner-donut-donut'></div>",
					"</div>",
				"</div>",
			"</div>"
		].join("");
		var div = document.createElement("div");
		div.innerHTML = donut;
		elem.appendChild(div.firstChild);

		return elem;
	}
});

Spinner.prototype = {
	init: function () {}
};

Spinner.init();

module.exports = Spinner;



// WEBPACK FOOTER //
// ./static/components/Spinner/Spinner.js