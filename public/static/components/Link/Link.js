import Anchor from "../Anchor/Anchor.js";
import Dropdown from "../Dropdown/Dropdown.js";
import Expand from "../Expand/Expand.js";
import Lightbox from "../Lightbox/Lightbox.js";
import Modal from "../Modal/Modal.js";
import Tooltip from "../Tooltip/Tooltip.js";
import Tab from "../Tab/Tab";

class Link {

	constructor ({elem}) {
		this.elem = elem;
		this.elem.link = this;
		this.type = this.elem.type;
		this.url = this.elem.data("url");
		this.image = this.elem.data("image");
		this.video = this.elem.data("video");
		this.comic = this.elem.data("comic");
		this.modal = this.elem.data("modal");
		this.modalAnalyticsType = this.elem.data("modal-analytics-type");
		this.anchor = this.elem.data("anchor");
		this.tooltip = this.elem.data("tooltip");
		this.dropdown = this.elem.data("dropdown");
		this.expand = this.elem.data("expand");
		this.tab = this.elem.data("tab");
		this.init();
	}

	static init () {
		document.querySelectorAlways(".Link:not([href])", Link.create);
	}

	static create (elem) {
		return new Link({elem});
	}

	init () {
		this.elem.addEventListener("click", (e) => { this.onclick(e); });
		// Let the other elements initialize themselves first
		setTimeout(() => {
			this.link();
			// custom urls overrides
			if (this.url) {
				this.elem.attr("href", this.url);
			}
		}, 1);
	}

	onclick (e) {
		// Disable all link listeners
		if (this.elem.attr("disabled")) {
			e.preventDefault();
			e.stopImmediatePropagation();
		}
	}

	link () {
		if (this.image) { Lightbox.link(this.elem, this.image, "IMAGE", this.modalAnalyticsType); }
		if (this.video) { Lightbox.link(this.elem, this.video, "VIDEO", this.modalAnalyticsType); }
		if (this.comic) { Modal.link(this.elem, this.comic); }
		if (this.modal) { Modal.link(this.elem, this.modal); }
		if (this.anchor) { Anchor.link(this.elem, this.anchor); }
		if (this.tooltip) { Tooltip.link(this.elem, this.tooltip); }
		if (this.dropdown) { Dropdown.link(this.elem, this.dropdown); }
		if (this.expand) { Expand.link(this.elem, this.expand); }
		if (this.tab) { Tab.link(this.elem, this.tab); }
	}
}

Link.init();

export default Link;



// WEBPACK FOOTER //
// ./static/components/Link/Link.js