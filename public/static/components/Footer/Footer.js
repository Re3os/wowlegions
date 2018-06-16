
class Footer {

	static init () {
		Footer.setPagePath();
		document.querySelectorAlways("a.NavbarFooter-selectorLocale", Footer.addCurrentPathToLocaleSelector);
	}

	static setPagePath () {
		let a = document.createElement("a");
		a.href = ".";
		Footer.path = location.pathname.replace(a.pathname, ""); // clever tricks for removing locale from path
	}

	static addCurrentPathToLocaleSelector (elem) {
		elem.href = elem.href + Footer.path;
	}
}

Footer.init();

export default Footer;



// WEBPACK FOOTER //
// ./static/components/Footer/Footer.js