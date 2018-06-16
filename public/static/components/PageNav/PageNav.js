import Anchor from "../Anchor/Anchor.js";

class PageNav {

	constructor ({elem}) {
		this.elem = elem;
		this.elem.pageNav = this;
		this.links = this.elem.querySelectorAll(".PageNav-link");
		this.activeLink = this.links.match(".is-active");
		this.isLive = this.elem.classList.contains("PageNav--live");
		this.init();
	}

	static init () {
		document.querySelectorAlways(".PageNav", PageNav.create);
	}

	static create (elem) {
		return new PageNav({elem});
	}

	init () {
		window.addEventListener("scroll", (e) => { this.requestUpdate(); });
		this.requestUpdate();
	}

	activate (link) {
		if (this.activeLink != link) {
			if (this.activeLink) {
				this.activeLink.classList.remove("is-active");
			}
			this.activeLink = link;
			this.activeLink.classList.add("is-active");
			if (this.isLive && link.href) {
				history.replaceState({}, document.title, link.href); //update hash
			}
		}
	}

	requestUpdate () {
		requestAnimationFrame(() => { this.update(); });
	}

	update () {
		let activeLink = null;
		for (let link of this.links) {
			let anchor = link.link && Anchor.find(link.link.anchor);
			if (anchor) {
				let isFirstAnchor = !activeLink;
				let isScrolledPast = anchor.position() <= 1; // use 1 to get around subpixel issues
				if (isFirstAnchor || isScrolledPast) {
					activeLink = link;
				} else if (activeLink) {
					break; // stop at the first anchor link found
				}
			} else if (link.host == location.host && link.pathname == location.pathname) {
				activeLink = link;
			}
		}
		if (activeLink) { this.activate(activeLink); }
	}

}

PageNav.init();

export default PageNav;



// WEBPACK FOOTER //
// ./static/components/PageNav/PageNav.js