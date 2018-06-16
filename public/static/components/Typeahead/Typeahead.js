// Typeahead
function Typeahead (elem) {
	this.elem = elem;
	this.elem.Typeahead = this;

	this.defaultContentDiv = elem.querySelector(".Typeahead-defaultContent");
	this.resultsContentDiv = elem.querySelector(".Typeahead-resultsContent");
	this.loadingMask = elem.querySelector(".Typeahead-loadingMask");

	this.url = elem.data("typeahead-url");
	this.searchInput = document.querySelector("#" + elem.data("typeahead-input-id"));

	this.isActive = false;
	this.typeaheadResultsDiv = null;

	this.pendingSearchRequestId = -1;
	this.searchRequestDelay = 350;

	this.init();
}

Object.assign(Typeahead, {
	activeClass: "is-active",
	init: function () {
		document.querySelectorAlways(".Typeahead", Typeahead.create);
	},
	create: function (elem) {
		return new Typeahead(elem);
	}
});

Typeahead.prototype = {
	init: function () {
		if (this.searchInput) {
			this.searchInput.addEventListener("input", this.onInputChange.bind(this));
			this.searchInput.addEventListener("blur", this.clearTypeaheadResults.bind(this));
		}

		document.addEventListener("click", this.onClick.bind(this));
	},
	addActive: function () {
		this.defaultContentDiv.classList.remove(Typeahead.activeClass);
		this.resultsContentDiv.classList.add(Typeahead.activeClass);
		this.resultsContentDiv.classList.remove(Typeahead.activeClass);
		this.active = true;
	},
	removeActive: function () {
		this.defaultContentDiv.classList.add(Typeahead.activeClass);
		this.loadingMask.classList.remove(Typeahead.activeClass);
		this.resultsContentDiv.classList.remove(Typeahead.activeClass);
		this.active = false;
	},
	onInputChange: function (event) {
		var value = event.target.value;

		if(value && value.trim().length >= 3) {
			if(!this.active) {
				this.addActive();
			}

			this.insertTypeaheadResultsDiv(value);
		}
		else if(this.active) {
			this.clearTypeaheadResults();
		}
	},
	clearTypeaheadResults: function () {
		// Clear out the pending request (If it exists)
		clearTimeout(this.pendingSearchRequestId);

		this.removeActive();

		if (this.typeaheadResultsDiv) {
			this.resultsContentDiv.removeChild(this.typeaheadResultsDiv);
			this.typeaheadResultsDiv = null;
		}
	},
	onClick: function (event) {
		if (this.active) {
			var node = event.target;

			while (node !== document) {
				var isDefaultContentDiv = node.classList.contains("Typeahead-defaultContent");
				var isResultsDiv = node.classList.contains("Typeahead-resultsContent");

				if (isDefaultContentDiv || isResultsDiv) {
					event.stopPropagation();
					return;
				}

				node = node.parentNode;
			}

			this.removeActive();

			this.resultsContentDiv.removeChild(this.typeaheadResultsDiv);
			this.typeaheadResultsDiv = null;
		}
	},
	insertTypeaheadResultsDiv: function(value) {
		var url = this.url + "?q=" + value;

		if(this.typeaheadResultsDiv != null) {
			this.typeaheadResultsDiv.innerHTML = "";
		}
		else {

			this.typeaheadResultsDiv = AjaxContent.createElement();
			this.typeaheadResultsDiv.classList.add("Typeahead-results");

			// Listen for the load event from AjaxContent to perform any specific action when loading is done
			this.typeaheadResultsDiv.addEventListener("load", this.stopLoading.bind(this));

			this.resultsContentDiv.appendChild(this.typeaheadResultsDiv);
		}

		// Clear out the pending request (If it exists)
		clearTimeout(this.pendingSearchRequestId);

		this.pendingSearchRequestId = setTimeout(function() {
			this.typeaheadResultsDiv.ajaxContent.update(url);
		}.bind(this), this.searchRequestDelay);

		this.startLoading();
	},
	startLoading: function() {
		this.loadingMask.classList.add(Typeahead.activeClass);
	},
	stopLoading: function() {
		this.loadingMask.classList.remove(Typeahead.activeClass);
	}
};

Typeahead.init();

module.exports = Typeahead;



// WEBPACK FOOTER //
// ./static/components/Typeahead/Typeahead.js