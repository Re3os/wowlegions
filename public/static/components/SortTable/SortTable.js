// SortTable
function SortTable (elem) {
	this.elem = elem;
	this.elem.sortTable = this;
	this.rows = elem.querySelectorAll(".SortTable-row");
	this.labels = Array.from(elem.querySelectorAll(".SortTable-label"));
	this.labels.map(function(label, index){ label.index = index; });
	this.labels.sortBy(function(){ return SortTable.priority(this); });
	this.body = elem.querySelector(".SortTable-body");
	this.isDisabled = false;
	this.init();
}

Object.assign(SortTable, {
	init: function () {
		document.querySelectorAlways(".SortTable", SortTable.create);
	},
	create: function (elem) {
		return new SortTable(elem);
	},
	stop: function (event) {
		event.preventDefault();
	},
	priority: function (elem) {
		return ~~elem.data("priority");
	},
	colWidth: function (col) {
		var widths = col.map(SortTable.elemWidth);
		return Math.max.apply(Math, widths);
	},
	colHide: function (col) {
		col.map(SortTable.elemHide);
	},
	colShow: function (col) {
		col.map(SortTable.elemShow);
	},
	elemWidth: function (elem) {
		return elem.offsetWidth;
	},
	elemHide: function (elem) {
		elem.classList.add("is-hidden");
	},
	elemShow: function (elem) {
		elem.classList.remove("is-hidden");
	}
});

SortTable.prototype = {
	init: function () {
		this.isDisabled = this.elem.classList.contains("SortTable--disabled");
		this.cols = this.labels.map(this.findCols.bind(this));
		if (!this.isDisabled) {
			this.labels.map(this.listen.bind(this));
		}
		window.addEventListener("resize", this.update.bind(this));
		this.update();
	},
	listen: function (label) {
		label.addEventListener("click",this.onclick.bind(this,label));
		// label.addEventListener("mousedown", SortTable.stop);
	},
	onclick: function (label) {
		if (label.classList.contains("is-sorted")) {
			label.classList.remove("is-sorted");
			label.classList.add("is-sorted-reverse");
		} else if(label.classList.contains("is-sorted-reverse")) {
			label.classList.remove("is-sorted-reverse");
			label.classList.add("is-sorted");
		} else {
			function removeSort (label) {
				label.classList.remove("is-sorted");
				label.classList.remove("is-sorted-reverse");
			}
			this.labels.map(removeSort);
			var sortReverse = label.classList.contains("sort-reverse");
			label.classList.add(sortReverse ? "is-sorted-reverse" : "is-sorted");
		}
		this.sort();
	},
	update: function () {
		// save widths upon sitewide font size changes at the large breakpoint
		var size = media.matches["media-huge"] ? "huge" : media.matches["media-large"] ? "large" : "small";
		if (this.size != size) {
			this.size = size;
			this.saveWidths();
		}
		var width = 0;
		var widths = this.widths; //TODO: consider updating this value occasionally
		this.cols.map(SortTable.colHide);
		var wide = this.width();
		function showCol (col, index){
			width += widths[index];

			// Do a force show if the width is 0 (Likely part of hidden modal)
			if(wide === 0 || width <= wide ){
				SortTable.colShow(col);
			}
		}
		this.cols.map(showCol);
	},
	findCols: function (label) {
		return this.elem.querySelectorAll(".SortTable-col:nth-child(" + (label.index + 1) + ")");
	},
	width: function() {
		var style = this.elem.style;
		var styleWidth = style.width;
		style.width = "100%";
		var width = this.elem.offsetWidth;
		style.width = styleWidth;
		return width;
	},
	saveWidths: function() {

		// Walk up DOM forcing elements to be visible so width can be calculated
		var altered = [];
		function forceVisibility (node) {
			while (node != document) {
				enableVisibility(node);
				node = node.parentNode;
			}
		}

		// Enable visibility of elements
		function enableVisibility (node) {
			if (getComputedStyle(node).display == "none") {
				altered.push({node:node, display:node.style.display});
				node.style.display = "block";
			}
		}

		// Restore visibility of elements back to what they were
		function restoreVisibility (item) {
			item.node.style.display = item.display
		}

		// Save the width of the columns
		forceVisibility(this.elem);
		this.elem.classList.add("is-resizing");
		this.labels.map(enableVisibility);
		this.cols.map(function (col) { col.map(enableVisibility); });
		this.widths = this.cols.map(SortTable.colWidth);
		altered.map(restoreVisibility);
		this.elem.classList.remove("is-resizing");
	},
	sort: function () {

		// Find the table state
		var sortLabel = null;
		var reverse = false;
		this.labels.map(function (label) {
			if (label.classList.contains("is-sorted")) {
				sortLabel = label;
				reverse = false;
			} else if (label.classList.contains("is-sorted-reverse")) {
				sortLabel = label;
				reverse = true;
			}
		});
		if (!sortLabel) { return; } //nothing to do
		var index = sortLabel.index;

		function rowValue (row) {
			var data = row.querySelector(".SortTable-data:nth-child(" + (index + 1) + ")");
			var value = null
			if (data) {
				value = data.data("value");
				if (!value) {
					value = data.textContent;
				}
			}
			var num = parseFloat(value);
			if (!isNaN(num)) { value = num; }
			return {row:row, value:value};
		}

		function notEmpty (data) {
			return data.value != null;
		}

		var body = this.body;
		function addValue (data) {
			body.appendChild(data.row);
		}

		var values = this.rows.map(rowValue).filter(notEmpty);
		values = values.sortBy("value"); // magic happens here folks
		if (reverse) { values = values.reverse(); }
		values.map(addValue);
	}
};

SortTable.init();

module.exports = SortTable;



// WEBPACK FOOTER //
// ./static/components/SortTable/SortTable.js