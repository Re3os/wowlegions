// Anchor
let pageUrl = window.pageUrl;

class Anchor {

	static anchors = new Map();
	static viewportOffset = 0.1; // percentage to offset from top of viewport

	constructor ({elem}) {
		this.elem = elem;
		this.elem.link = this;
		this.name = this.elem.attr("name");
		this.isDefault = this.elem.classList.contains("Anchor--default");
		this.init();
	}

	static init () {
		document.querySelectorAlways(".Anchor", Anchor.create);
	}

	static create (elem) {
		return new Anchor({elem});
	}

	static link (link, name) {
		let anchor = this.find(name);
		if (anchor) {
			anchor.link(link);
		}
	}

	static find (name) {
		return Anchor.anchors.get(name);
	}

	static offset () {
		return window.innerHeight * Anchor.viewportOffset;
	}

	init () {
		Anchor.anchors.set(this.name, this);
		const hash = pageUrl.parts.hash;
		if (hash[this.name]) {
			setTimeout(() => {
				this.scrollTo();
			}, 750);
		}
	}

	link (link) {
		if (this.isDefault) {
			link.href = location.pathname;
		} else {
			link.href = `${location.pathname}#${this.name}`;
		}
		link.addEventListener("click", (e) => {
			let isModified = e.ctrlKey || e.shiftKey || e.altKey;
			if (!isModified) {
				e.preventDefault();
				history.replaceState({}, document.title, link.href); //update hash
				this.scrollTo();
			}
		});
	}

	top () {
		return this.elem.getBoundingClientRect().top;
	}

	position () {
		return this.top() - Anchor.offset();
	}

	scrollTo () {
		let position = this.position();
		document.body.scrollTop = document.body.scrollTop + position; //Chrome
		document.documentElement.scrollTop = document.documentElement.scrollTop + position; //IE/Firefox
	}

}

Anchor.init();

export default Anchor;



// WEBPACK FOOTER //
// ./static/components/Anchor/Anchor.js