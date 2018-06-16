// CarouselIndicator
function CarouselIndicator (elem) {
	this.elem = elem;
	elem.carouselIndicator = this;
	this.carouselIdentifier = elem.data("indicator");
	this.nodeContainer = elem.querySelector(".CarouselIndicator-nodes");
	this.nodes = elem.querySelectorAll(".CarouselIndicator-node");
	this.activeNodeIndex = null;
	this.init();
}

Object.assign(CarouselIndicator, {
	init: function () {
		document.querySelectorAlways(".CarouselIndicator", CarouselIndicator.create);
	},
	create: function (elem) {
		return new CarouselIndicator(elem);
	}
});

CarouselIndicator.prototype = {
	init: function () {
		if (this.nodeContainer && !this.nodes.length) {
			this.getCarouselItems();
			this.populateNodes();
		}
	},
	getCarouselItems: function() {
		this.carouselItems = document.querySelectorAll(".Carousel-item[data-carousel='" + this.carouselIdentifier + "']");
	},
	populateNodes: function() {
		if (this.carouselItems) {
			for (var i = 0; i < this.carouselItems.length; i++) {
				this.buildNodeElement(i);
			}
			this.nodes = this.elem.querySelectorAll(".CarouselIndicator-node");
			document.querySelectorAlways.update();
			this.selectActiveNode();
		}
	},
	buildNodeElement: function(index) {
		var carouselIndicatorNode = document.createElement("div");
		carouselIndicatorNode.classList.add("CarouselIndicator-node");
		carouselIndicatorNode.data("indicator-index", index);

		var carouselLink = document.createElement("div");
		carouselLink.classList.add("CarouselLink");
		carouselLink.data("carousel", this.carouselIdentifier);
		carouselLink.data("carousel-index", index);

		var carouselIndicatorLink = document.createElement("div");
		carouselIndicatorLink.classList.add("CarouselIndicator-link");

		var carouselIndicatorDot = document.createElement("div");
		carouselIndicatorDot.classList.add("CarouselIndicator-dot");

		carouselIndicatorLink.appendChild(carouselIndicatorDot);
		carouselLink.appendChild(carouselIndicatorLink);
		carouselIndicatorNode.appendChild(carouselLink);

		this.nodeContainer.appendChild(carouselIndicatorNode);
	},
	selectActiveNode: function() {
		if (this.carouselItems) {
			var selectedItemIndex = 0;

			for (var i = 0; i < this.carouselItems.length; i++) {
				if (this.carouselItems[i].classList.contains("is-selected")) {
					selectedItemIndex = this.carouselItems[i].data("carousel-index");
				}
			}

			for (var j = 0; j < this.nodes.length; j++) {
				var nodeLink = this.nodes[j].querySelector(".CarouselLink");
				var nodeLinkIndex = nodeLink.data("carousel-index");

				if (nodeLinkIndex == selectedItemIndex) {
					nodeLink.classList.add("is-selected");
				}
			}
		}
	},
	updateActiveNode: function() {
		this.nodeContainer.querySelectorAll(".CarouselIndicator-node.is-selected").map(function(node) {
			node.classList.remove("is-selected");
		});
		if (this.activeNodeIndex != null) {
			var selector = ".CarouselIndicator-node[data-indicator-index=\"" + this.activeNodeIndex + "\"]";
			var newNode = this.nodeContainer.querySelector(selector);
			newNode.classList.add("is-selected");
		}
	}
};

CarouselIndicator.init();

module.exports = CarouselIndicator;



// WEBPACK FOOTER //
// ./static/components/CarouselIndicator/CarouselIndicator.js