// Poll
function Poll(elem) {
	this.elem = elem;
	this.elem.Poll = this;

	this.form = elem.querySelector(".Poll-vote");
	this.url = elem.data("url");
	this.maxChoices = this.form ? ~~this.form.data("choices") : 0;

	this.numSelected = 0;
	this.submitted = false;

	this.init();
}

Object.assign(Poll, {
	init: function () {
		document.querySelectorAlways(".Poll", Poll.create);
	},
	create: function (elem) {
		return new Poll(elem);
	}
});

Poll.prototype = {
	init: function () {
		if (this.form) {
			this.form.addEventListener("submit", this.onSubmit.bind(this));

			this.selectionBoxes = this.form.elements["selection[]"];
			for (var i = 0; i < this.selectionBoxes.length; i++) {
				this.selectionBoxes[i].addEventListener("click", this.onSelect.bind(this, this.selectionBoxes[i]));
			}
		}
	},
	onSubmit: function (event) {
		if (this.submitted) {
			return false;
		}

		event.preventDefault();

		this.form.submitBtn.disabled = true;
		this.submitted = true;

		var url = this.form.action;
		var xhr = new XMLHttpRequest();

		var params = [];

		for (var i = 0; i < this.form.elements.length; i++) {
			var el = this.form.elements[i];

			// We only want the csrf field OR checked boxes
			if (el.name == "_csrf" || el.checked) {
				params.push(encodeURIComponent(el.name) + "=" + encodeURIComponent(el.value));
			}
		}

		xhr.open("POST", url);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		function onLoadCallback() {
			this.elem.outerHTML = xhr.responseText;
		}

		xhr.onload = onLoadCallback.bind(this);
		xhr.send(params.join("&"));
	},
	onSelect: function (selectionBox) {
		if (this.maxChoices == 1) {
			if (!this.submitted) {
				this.form.submitBtn.disabled = false;
			}
		}
		else {
			if (selectionBox.checked) {
				if (this.numSelected >= this.maxChoices) {
					selectionBox.checked = false;
				} else {
					this.numSelected++;
				}
			} else {
				this.numSelected--;
			}

			this.form.submitBtn.disabled = this.numSelected <= 0 || this.submitted;
		}
	}
};

Poll.init();

module.exports = Poll;



// WEBPACK FOOTER //
// ./static/components/Poll/Poll.js