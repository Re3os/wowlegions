//ProgressDonut
function ProgressDonut (elem) {
	this.elem = elem;
	this.elem.progressDonut = this;
	this.borderPath = this.elem.querySelector(".ProgressDonut-border");
	this.filledPath = this.elem.querySelector(".ProgressDonut-filled");
	this.unfilledPath = this.elem.querySelector(".ProgressDonut-unfilled");
	this.decimal = this.elem.data("decimal");
	this.init();
}

Object.assign(ProgressDonut, {
	init: function () {
		document.querySelectorAlways(".ProgressDonut", ProgressDonut.create);
	},

	create: function (elem) {
		return new ProgressDonut(elem);
	}
});

ProgressDonut.createPath = function (decimal, filled) {
	this.percent = decimal * 100;

	// Special case: If we have 0, assume 100 percent so that the border and unfilled portion
	// at always rendered
	if (decimal <= 0) {
		this.percent = 100;
		filled = true;
	}

	this.progress = "";

	this.points = (Math.PI * 2) / 100;
	this.endpointX = 50 + 50 * Math.sin(this.points * this.percent);
	this.endpointY = 50 - 50 * Math.cos(this.points * this.percent);

	this.largeFlag = 0;
	var reflexFilled   =  filled && this.percent > 50;
	var reflexUnfilled = !filled && this.percent < 50;
	if(reflexFilled || reflexUnfilled) {
		this.largeFlag = 1;
	}

	this.sweepFlag = 1;
	if(!filled) {
		this.sweepFlag = 0;
	}

	if(this.percent >= 100) {
		this.endpointX = 49.9999; // The number '49.999' allows for a circle that looks complete whereas '50' will result with no circle at all
		this.endpointY = 0;
	}

	this.progress += "M50 0 A 50 50, 0, " + this.largeFlag + ", " + this.sweepFlag + ", " + this.endpointX + " " + this.endpointY;

	return this.progress;
};

ProgressDonut.prototype = {
	init: function () {
		// Always draw border and unfilled portion
		if (this.borderPath != null) {
			this.borderPath.attr("d", ProgressDonut.createPath(1.0, true));
		}

		if (this.borderPath != null) {
			this.unfilledPath.attr("d", ProgressDonut.createPath(this.decimal, false));
		}

		var hasProgress = this.decimal > 0;
		if(hasProgress && this.filledPath != null) {
			this.filledPath.attr("d", ProgressDonut.createPath(this.decimal, true));
		}
	}
};

ProgressDonut.init();

module.exports = ProgressDonut;



// WEBPACK FOOTER //
// ./static/components/ProgressDonut/ProgressDonut.js