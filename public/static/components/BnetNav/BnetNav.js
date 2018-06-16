class BnetNav {

	constructor ({elem}) {
		this.elem = elem;
		this.elem.BnetNav = this;
		this.modalClose = this.elem.querySelector(".Navbar-siteMenu .Navbar-modalClose");
		this.init();
	}

	static init () {
		document.querySelectorAlways(".BnetNav", BnetNav.create);
		window.addEventListener("SelectMenu/open", BnetNav.onSelectMenuOpen);
		window.addEventListener("SelectMenu/close", BnetNav.onSelectMenuClose);
	}

	static create (elem) {
		return new BnetNav({elem});
	}

	static hideNavs () {
		let navs = document.querySelectorAll(".BnetNav");
		Array.from(navs).map((nav) => { nav.BnetNav.hide(); });
	}

	static showNavs () {
		let navs = document.querySelectorAll(".BnetNav");
		Array.from(navs).map((nav) => { nav.BnetNav.show(); });
	}

	static onSelectMenuOpen (e) {
		if (e.detail.elem.SelectMenu.isFullscreen()) { BnetNav.hideNavs(); }
	}

	static onSelectMenuClose (e) {
		if (e.detail.elem.SelectMenu.isFullscreen()) { BnetNav.showNavs(); }
	}

	init () {
		// let cloned content propagate first
		setImmediate(() => { this.listen(); });
	}

	listen () {
		let anchors = this.elem.querySelectorAll(".Link[data-anchor]");
		for (let anchor of anchors) {
			anchor.addEventListener("click", (e) => { this.close(); });
		}
	}

	close () {
		this.modalClose.click();
	}

	show () {
		this.elem.classList.remove("hide");
	}

	hide () {
		this.elem.classList.add("hide");
	}
}

BnetNav.init();

export default BnetNav;



// WEBPACK FOOTER //
// ./static/components/BnetNav/BnetNav.js