class DropdownMenu {

	constructor ({elem}) {
		this.elem = elem;
		this.elem.dropdownMenu = this;
		this.toggle = this.elem.querySelector(".DropdownMenu-toggle");
		this.menu = this.elem.querySelector(".DropdownMenu-menu");
		this.links = this.elem.querySelectorAll(".DropdownMenu-menuLink");
		this.init();
	}

	static init () {
		document.querySelectorAlways(".DropdownMenu", DropdownMenu.create);
	}

	static create (elem) {
		return new DropdownMenu({elem});
	}

	init () {
		for (let link of this.links) {
			link.addEventListener("click", (e) => {
				this.toggle.textContent = link.textContent;
				this.menu.dropdown.close();
			});
		}
		setTimeout(() => { // wait for links to initialize
			let currentLink = this.links.matches(".is-selected")[0];
			if (currentLink) {
				this.toggle.textContent = currentLink.textContent;
			}
		}, 10);
	}

}

DropdownMenu.init();

export default DropdownMenu;



// WEBPACK FOOTER //
// ./static/components/DropdownMenu/DropdownMenu.js