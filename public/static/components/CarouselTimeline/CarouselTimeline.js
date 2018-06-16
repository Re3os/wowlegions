// CarouselTimeline
function CarouselTimeline (elem) {
	this.elem = elem;
	this.carouselIdentifier = elem.data("timeline");
	this.leftEndCap = elem.querySelector(".CarouselTimeline-endCapLeft");
	this.rightEndCap = elem.querySelector(".CarouselTimeline-endCapRight");
	this.scrollable = elem.querySelector(".Scrollable");
	this.nodeContainer = elem.querySelector(".CarouselTimeline-nodes");
	this.nodes = elem.querySelectorAll(".CarouselTimeline-node");

	this.isInline = elem.classList.contains("CarouselTimeline--inline");

	this.maxWidth = 0.80; // Static: Max timeline width relative to the size of the viewport
	this.maxNodeWidth = 25; // Static: Width of an unconstrained timeline node
	this.dotWidth = 15; // Static: Width of a node dot
	this.endCapAdditionalWidth = 20; // Static: Additional width of endcap nodes

	this.isConstrained = false;
	this.isCompact = false;
	this.isTouching = false;

	this.activeNodeIndex = null;
	this.startX = 0;
	this.nodeWidth = this.maxNodeWidth;

	this.init();
}

Object.assign(CarouselTimeline, {
	init: function () {
		document.querySelectorAlways(".CarouselTimeline", CarouselTimeline.create);
	},
	create: function (elem) {
		return new CarouselTimeline(elem);
	},
	calcFullWidth: function(timeline) {
		if (timeline.nodes && timeline.nodes.length > 0) {
			var width = timeline.nodes.length * timeline.maxNodeWidth;
			width += Math.min(timeline.nodes.length, 2) * timeline.endCapAdditionalWidth;
			return width;
		}
		return 0;
	},
	calcIndex: function(nodes, nodeWidth, baseIndex, deltaX) {
		var index = baseIndex + (deltaX / nodeWidth);
		index = deltaX < 0 ? Math.ceil(index) : Math.floor(index);
		return Math.max(0, Math.min(index, nodes.length - 1));
	}
});

CarouselTimeline.prototype = {
	init: function () {
		this.listen();
	},
	listen: function () {
		window.addEventListener("resize", this.resize.bind(this));

		this.nodes.map(function(elem) {
			elem.addEventListener("touchstart", this.touchStart.bind(this, ~~elem.data("timeline-index")));
			elem.addEventListener("touchmove", this.touchMove.bind(this, ~~elem.data("timeline-index")));
		}.bind(this));
		this.nodeContainer.addEventListener("touchend", this.touchEnd.bind(this));
		this.nodeContainer.addEventListener("touchcancel", this.touchCancel.bind(this));

		this.updateActiveNodeBound = this.updateActiveNode.bind(this);
		this.updateBound = this.update.bind(this);
		this.updateBound();

		if (this.carouselIdentifier) {
			var carousel = Carousel.allCarouselsById[this.carouselIdentifier];
			if (carousel && carousel.elem) {
				carousel.elem.addEventListener("carouselchange", this.change.bind(this));
			}
		}
	},
	resize: function() {
		requestAnimationFrame(this.updateBound);
	},
	update: function () {
		var viewportWidth = (window.innerWidth || document.documentElement.clientWidth);
		var maxSize = Math.floor(viewportWidth * this.maxWidth);
		var fullSize = CarouselTimeline.calcFullWidth(this);
		if (fullSize > maxSize) {
			this.isConstrained = true;
			var availableSpace = maxSize - this.endCapAdditionalWidth - (2 * this.maxNodeWidth);
			var nodeWidth = Math.floor(availableSpace / (this.nodes.length - 2));
			var firstNode = this.nodes[0];
			var lastNode = this.nodes[this.nodes.length - 1];
			this.nodes.map(function(node) {
				if (node != firstNode && node != lastNode) {
					node.style.width = nodeWidth + "px";
				}
			});
			if (nodeWidth < this.dotWidth) {
				if (!this.isCompact) {
					this.isCompact = true;
					this.nodeContainer.classList.add("is-compact");
				}
			} else {
				if (this.isCompact) {
					this.isCompact = false;
					this.nodeContainer.classList.remove("is-compact");
				}
			}
			this.nodeWidth = parseInt(nodeWidth);
			this.nodeContainer.classList.add("is-constrained");
		} else {
			if (this.isConstrained) {
				this.isConstrained = false;
				this.nodes.map(function(node) {
					node.style.width = "";
				});
				this.nodeContainer.classList.remove("is-constrained");
			}
		}
		this.isInline = this.elem.classList.contains("CarouselTimeline--inline");
	},
	touchStart: function(index, event) {
		event.stopPropagation();
		event.preventDefault();
		this.isTouching = true;
		this.activeNodeIndex = index;
		requestAnimationFrame(this.updateActiveNodeBound);
		this.isTouching = true;

		var touch = event.touches[0];
		this.startX = touch.pageX;
	},
	touchEnd: function(event) {
		if (this.isTouching) {
			this.isTouching = false;

			event.stopPropagation();
			event.preventDefault();
			if (this.activeNodeIndex != null) {
				this.nodes[this.activeNodeIndex].querySelector(".CarouselLink").click();

				this.activeNodeIndex = null;
				requestAnimationFrame(this.updateActiveNodeBound);
			}
		}
	},
	touchCancel: function(index, event) {
		if (this.isTouching) {
			this.isTouching = false;

			event.stopPropagation();
			event.preventDefault();
			this.activeNodeIndex = null;
			requestAnimationFrame(this.updateActiveNodeBound);
		}
	},
	touchMove: function(index, event) {
		if (this.isTouching) {
			event.stopPropagation();
			event.preventDefault();
			var touch = event.touches[0];
			var calculatedIndex = CarouselTimeline.calcIndex(this.nodes, this.nodeWidth, index, touch.pageX - this.startX);
			if (this.activeNodeIndex != calculatedIndex) {
				this.activeNodeIndex = calculatedIndex;
				requestAnimationFrame(this.updateActiveNodeBound);
			}
		}
	},
	updateActiveNode: function() {
		this.nodeContainer.querySelectorAll(".CarouselTimeline-node.is-selected").map(function(node) {
			node.classList.remove("is-selected");
		});
		if (this.activeNodeIndex != null) {
			var selector = ".CarouselTimeline-node[data-timeline-index=\"" + this.activeNodeIndex + "\"]";
			var newNode = this.nodeContainer.querySelector(selector);
			newNode.classList.add("is-selected");
		}
	},
	change: function(event) {
		if (this.isInline && this.carouselIdentifier) {
			var carousel = Carousel.allCarouselsById[this.carouselIdentifier];
			var selectedItem = carousel.getCurrentItem();
			var index = selectedItem.data("carousel-index");
			var node = this.nodes[index];
			if (node) {
				var rect = node.getBoundingClientRect();
				var viewportWidth = (window.innerWidth || document.documentElement.clientWidth);
				var offset = Math.round(rect.left + (node.offsetWidth / 2) - (viewportWidth / 2));
				this.scrollable.scrollLeft = this.scrollable.scrollLeft + offset;
			}
		}
	}
};

CarouselTimeline.init();

module.exports = CarouselTimeline;



// WEBPACK FOOTER //
// ./static/components/CarouselTimeline/CarouselTimeline.js