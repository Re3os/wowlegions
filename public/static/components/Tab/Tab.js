let pageUrl = window.pageUrl;

class Tab {

	static tabs = new Map();
	static links = new Map();
	static groups = new Map();
	static viewportOffset = 0.1; // percentage to offset from top of viewport

	constructor ({elem}) {
		this.elem = elem;
		this.elem.tab = this;
		this.name = this.elem.attr("name");
		this.group = this.elem.data("group");
		this.isSelected = this.elem.classList.contains("is-selected");
		this.isDefault = this.elem.classList.contains("Tab--default");
		this.isSave = this.elem.classList.contains("Tab--save");
		this.isToggle = this.elem.classList.contains("Tab--toggle");
		this.init();
	}

	static init () {
		document.querySelectorAlways(".Tab", Tab.create);
		window.addEventListener("pageUrl/update", () => {
			Tab.select(pageUrl.parts.hash.tab);
		});
	}

	static create (elem) {
		return new Tab({elem});
	}

	static link (link, name) {
		Tab.findLinks(name).add(link);
		link.addEventListener("click", (e) => {
			let isModified = e.ctrlKey || e.shiftKey || e.altKey;
			if (!isModified) {
				e.preventDefault();
				Tab.select(name);
				Tab.save(name);
			}
		});
		// update link href after tab loads on page
		setImmediate(() => {
			let info = Tab.info(name);
			if (info.isSave) {
				let parts = Object.create(pageUrl.parts);
				let hash = Object.create(parts.hash);
				if (info.isDefault) {
					delete hash.tab;
				} else {
					hash.tab = name;
				}
				parts.hash = hash;
				link.href = pageUrl.url(parts);
			}
		});
	}

	static get (store, name) {
		if (!store.has(name)) {
			store.set(name, new Set());
		}
		return store.get(name);
	}

	static findTabs (name) {
		return Tab.get(Tab.tabs, name);
	}

	static findLinks (name) {
		return Tab.get(Tab.links, name);
	}

	static findGroup (name) {
		return Tab.get(Tab.groups, name);
	}

	static select (name) {
		let tabs = Tab.findTabs(name);
		for (let tab of tabs) {
			if (tab.group) {
				let group = Tab.findGroup(tab.group);
				for (let tab of group) {
					if (tab.name != name) {
						tab.deselect();
					}
				}
			}
			if (!tab.isSelected) {
				tab.select();
			} else if (tab.isToggle) {
				tab.deselect();
			}
		}
	}

	static info (name) {
		let tabs = Tab.findTabs(name);
		let isSave = false;
		let isDefault = false;
		for (let tab of tabs) {
			if (tab.isSave) {
				isSave = true;
				if (tab.isDefault) {
					isDefault = true;
				}
			}
		}
		return {name, tabs, isSave, isDefault};
	}

	static save (name) {
		let info = Tab.info(name);
		if (info.isSave) {
			if (info.isDefault) {
				delete pageUrl.parts.hash.tab;
			} else {
				pageUrl.parts.hash.tab = name;
			}
			pageUrl.save();
		}
	}

	static offset () {
		return window.innerHeight * Tab.viewportOffset;
	}

	// Scroll to first tab on page
	static scrollTo (name) {
		let tabs = Tab.findTabs(name);
		let pos = Array.from(tabs).map((tab) => { return tab.position(); });
		let top = Math.min.apply(Math, pos);
		Tab.scrollTop(top);
	}

	static scrollTop (position) {
		document.body.scrollTop = document.body.scrollTop + position; //Chrome
		document.documentElement.scrollTop = document.documentElement.scrollTop + position; //IE/Firefox
	}

	init () {
		Tab.findTabs(this.name).add(this);
		if (this.group) {
			Tab.findGroup(this.group).add(this);
		}
		// functions to save lookups costs when checks not needed
		let isSaved = () => {
			return pageUrl.parts.hash.tab == this.name;
		};
		let isDefaulted = () => {
			if (this.group) {
				let group = Tab.findGroup(this.group);
				for (let tab of group) {
					if (tab.isSelected && !tab.isDefault) {
						return false; // don't select default tab of groups that already found their match
					}
				}
			}
			return true;
		};
		setTimeout(() => { // let links and other tabs initialize
			if (this.isSave && isSaved()) {
				Tab.select(this.name);
				Tab.scrollTo(this.name);
			} else if (this.isDefault && isDefaulted()) {
				Tab.select(this.name);
			}
		}, 10);
	}

	deselect () {
		if (this.isSelected) {
			this.isSelected = false;
			this.elem.classList.remove("is-selected");
			let links = Tab.findLinks(this.name);
			for (let link of links) {
				link.classList.remove("is-selected");
			}
		}
	}

	select () {
		if (!this.isSelected) {
			this.isSelected = true;
			this.elem.classList.add("is-selected");
			let links = Tab.findLinks(this.name);
			for (let link of links) {
				link.classList.add("is-selected");
			}
		}
	}

	top () {
		return this.elem.getBoundingClientRect().top;
	}

	position () {
		return this.top() - Tab.offset();
	}

}

Tab.init();

export default Tab;



// WEBPACK FOOTER //
// ./static/components/Tab/Tab.js