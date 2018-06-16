const AjaxContent     = require("components/AjaxContent/AjaxContent.js");
const HammerJS        = require("hammerjs");
const iziModalFactory = require("izimodal");
const Spinner         = require("components/Spinner/Spinner.js");

class Modal {

	static elems = {};
	static modals = {};
	static groups = [];
	static history = [];
	static queue = null;
	static fadeOutDuration = 333;
	static multitouchManager = null;

	static init () {
		iziModalFactory(null, $);
		Modal.noopIziModalHashChange();
		document.querySelectorAlways(".Modal", (elem) => { Modal.create(elem); });
	}

	static noopIziModalHashChange() {
		$(window).off('hashchange.iziModal').on('hashchange.iziModal', () => {});
	}

	static create (elem) {
		let modalId = elem.data("modal");
		Modal.elems[modalId] = elem;
	}

	static link (link, id) {
		link.addEventListener("click", (e) => {
			e.preventDefault();
			Modal.openById(id);
		});
	}

	static openById (id, transition) {
		let elem = Modal.elems[id];
		Modal.openByElem(elem, transition);
	}

	static openByElem (elem, transition) {
		Modal.storeGroupInfo(elem);
		Modal.initializeForElem(elem);

		if (Modal.thereAreVisibleModalElements()) {
			Modal.addVisibleModalsToHistory();
			Modal.addToQueueByElem(elem);
			Modal.closeVisibleModals();
			return;
		}

		let options = {};
		if (transition) {
			options.transition = transition;
		}
		$(elem).iziModal("open", options);

		Modal.showOverlay();
		if (Modal.isElemInAModalGroup(elem)) {
			Modal.buildNavigation();
		}
		Modal.trackEvent("Open", elem);
	}

	static storeGroupInfo (elem) {
		let groupName = elem.data("izimodal-group");
		if (groupName && !Modal.groups[groupName]) {
			let elemsInGroup = document.querySelectorAll(`[data-izimodal-group=${groupName}]`);
			let elemsInGroupArray = Array.prototype.slice.call(elemsInGroup);
			for (let i = 0; i < elemsInGroupArray.length; i++) {
				elemsInGroupArray[i].data("izimodal-group-index", i);
			}
			Modal.groups[groupName] = elemsInGroupArray;
		}
	}

	static initializeForElem (elem) {
		let id = elem.data("modal");
		if (!Modal.isInitializedForId(id)) {
			let $elemIziModal = $(elem).iziModal({
				closeOnEscape: false, // To enable this we'll need to hide our navigation and overlay on keypress.
				navigateArrows: false,
				navigateCaption: false,
				history: false,
				onOpening: Modal.onOpening,
				onClosed: Modal.onClosed,
				transitionIn: "fadeIn",
				transitionOut: "fadeOut"
			});
			Modal.modals[id] = $elemIziModal[0];
			Modal.enableMediaAttributes(Modal.modals[id]);
			Modal.enableNestedModalLinks(Modal.modals[id]);
		}
	}

	static isInitializedForId (id) {
		return Modal.modals[id] ? true : false;
	}

	static addVisibleModalsToHistory () {
		let visibleModalElements = Modal.getVisibleModalElements();
		visibleModalElements.map((modalElement) => {
			Modal.history.push(modalElement.data("modal"));
		});
	}

	static closeVisibleModals () {
		let visibleModalElements = Modal.getVisibleModalElements();
		visibleModalElements.map((modalElement) => {
			$(modalElement).iziModal("close");
		});
	}

	static showOverlay () {
		document.body.classList.add("is-overlaid", "is-scrollLocked");
		Modal.applyBodyScrollbarPadding();
	}

	static hideOverlay () {
		document.body.classList.remove("is-overlaid");
		window.setTimeout(() => {
			document.body.classList.remove("is-scrollLocked");
			Modal.removeBodyScrollbarPadding();
		}, Modal.fadeOutDuration);
	}

	static isElemInAModalGroup (elem) {
		return elem.data("izimodal-group") ? true : false;
	}

	static enableMediaAttributes (elem) {
		if (window.Media && window.media) {
			let childElemsWithMediaAttributes = elem.querySelectorAll(window.Media.query);
			childElemsWithMediaAttributes.map((childElem) => {
				window.media.addElem(childElem);
			});
		}
	}

	static enableNestedModalLinks (elem) {
		let innerLinks = elem.querySelectorAll(".Link");
		innerLinks.map((innerLink) => {
			let innerLinkId = innerLink.data("modal");
			if (innerLinkId) {
				Modal.link(innerLink, innerLinkId);
			}
		});
	}

	static enableMultitouch (elem) {
		Modal.enableGlobalMultitouch();
		Modal.enableScrollAndSwipeInAndroidChrome(elem);
	}

	static enableGlobalMultitouch () {
		if (!Modal.multitouchManager) {
			Modal.multitouchManager = new Hammer(document.body);
			Modal.multitouchManager.on("swipeleft", Modal.navigateToNextGroupItem);
			Modal.multitouchManager.on("swiperight", Modal.navigateToPreviousGroupItem);
		}
	}

	static enableScrollAndSwipeInAndroidChrome (elem) {
		//	Starting with Android Chrome v55 and up to v62, the current version
		//	as of November 2017, HammerJS has issues reporting swipe events.
		//	The following is a workaround for that.
		//	More info: https://github.com/hammerjs/hammer.js/issues/1065#issuecomment-310620039
		let modalWrap = elem.querySelector(".iziModal-wrap");
		if (modalWrap && !modalWrap.data("multitouch-override")) {
			modalWrap.data("multitouch-override", "");
			let wrapManager = new Hammer(modalWrap);
			wrapManager.on("swipeleft", function(){});
			wrapManager.on("swiperight", function(){});
		}
	}

	static disableMultitouch () {
		if (Modal.multitouchManager) {
			Modal.multitouchManager.destroy();
			Modal.multitouchManager = null;
		}
	}

	static onOpening (iziModal) {
		let overlayElem = iziModal.$overlay[0];
		let modalElem = iziModal.$element[0];
		let closeButtonElem = modalElem.querySelector("[data-izimodal-close]");
		let backButtonElem = modalElem.querySelector(".Modal-back");

		//	Normally a modifier class would be used here, but iziModal removes any classes
		//	that aren't on the element when a modal is initially loaded.
		if (Modal.history.length) {
			modalElem.setAttribute("data-history", "");
		} else {
			modalElem.removeAttribute("data-history");
		}

		Modal.loadAjaxContent(modalElem);
		Modal.loadIFrame(modalElem);
		Modal.enableMultitouch(modalElem);

		overlayElem.addEventListener("click", Modal.closeSupportingElements);
		closeButtonElem.addEventListener("click", Modal.closeSupportingElements);
		backButtonElem.addEventListener("click", Modal.goBackInHistory);
	}

	static onClosed (iziModal) {
		let modalElem = iziModal.$element[0];
		let modalContentElem = Modal.getContentElem(modalElem);
		Modal.removeIFrameFromElem(modalContentElem);
		Modal.openFromQueue();
	}

	static openFromQueue () {
		if (Modal.queue) {
			Modal.openById(Modal.queue.id, Modal.queue.transition);
			Modal.clearQueue();
		}
	}

	static loadAjaxContent (elem) {
		let contentElem = Modal.getContentElem(elem);
		let ajaxUrl = elem.data("url");
		let preexistingAjaxContent = elem.querySelector(".AjaxContent");

		if (contentElem && ajaxUrl && !preexistingAjaxContent) {
			let spinner = Spinner.createElement();
			let ajaxContent = AjaxContent.createElement({
				url: ajaxUrl,
				child: spinner
			});
			spinner.classList.add("Spinner--donut");
			spinner.classList.add("contain-center");
			ajaxContent.addEventListener("load", function() {
				$(elem).iziModal("recalcLayout");
			});
			contentElem.appendChild(ajaxContent);
		}
	}

	static loadIFrame (elem) {
		let contentElem = Modal.getContentElem(elem);
		let iframeUrl = elem.data("iframe-url");
		let preexistingIFrame = elem.querySelector(".Modal-iframe");

		if (contentElem && iframeUrl && !preexistingIFrame) {
			let iframe = document.createElement("iframe");
			iframe.classList.add("Modal-iframe");
			iframe.attr("src", iframeUrl + "/modal");
			iframe.attr("frameborder", "0");
			iframe.attr("allowfullscreen", true);
			contentElem.appendChild(iframe);
		}
	}

	static removeIFrameFromElem (elem) {
		let iframe = elem.querySelector(".Modal-iframe");
		if (iframe) {
			iframe.remove();
		}
	}

	static getContentElem (modalElem) {
		return modalElem.querySelector(".iziModal-content");
	}

	static closeSupportingElements () {
		Modal.disableMultitouch();
		Modal.hideOverlay();
		Modal.destroyNavigation();
	}

	static goBackInHistory () {
		if (Modal.history.length) {
			let lastIDInHistory = Modal.history.pop();
			Modal.addToQueueById(lastIDInHistory);
			Modal.closeVisibleModals();
		}
	}

	static buildNavigation () {
		let preexistingNav = document.querySelector(".ModalNav");

		if (!preexistingNav) {
			let navWrap = Modal.buildNavWrapElement();
			let navPrev = Modal.buildNavPrevElement();
			let navNext = Modal.buildNavNextElement();

			navPrev.addEventListener("click", Modal.navigateToPreviousGroupItem);
			navNext.addEventListener("click", Modal.navigateToNextGroupItem);

			navWrap.appendChild(navPrev);
			navWrap.appendChild(navNext);
			document.body.appendChild(navWrap);
		}
	}

	static destroyNavigation () {
		let navElement = document.querySelector(".ModalNav");
		if (navElement) {
			navElement.classList.add("is-fadingOut");
			window.setTimeout(() => {
				navElement.remove();
			}, Modal.fadeOutDuration);
		}
	}

	static buildNavWrapElement () {
		let navWrap = document.createElement("div");
		navWrap.classList.add("ModalNav");
		return navWrap;
	}

	static buildNavPrevElement () {
		let navPrev = document.createElement("div");
		let navPrevIcon = document.createElement("span");
		navPrev.classList.add("ModalNav-prev");
		navPrevIcon.classList.add("Icon", "Icon--prev");
		navPrev.appendChild(navPrevIcon);
		return navPrev;
	}

	static buildNavNextElement () {
		let navNext = document.createElement("div");
		let navNextIcon = document.createElement("span");
		navNext.classList.add("ModalNav-next");
		navNextIcon.classList.add("Icon", "Icon--next");
		navNext.appendChild(navNextIcon);
		return navNext;
	}

	static navigateToPreviousGroupItem () {
		let visibleModalElements = Modal.getVisibleModalElements();
		visibleModalElements.map((elem) => {
			if (Modal.isElemInAModalGroup(elem)) {

				let groupName = elem.data("izimodal-group");
				let groupElems = Modal.groups[groupName];
				let currentIndex = elem.data("izimodal-group-index");
				let previousIndex = parseInt(currentIndex) - 1;
				if (currentIndex == 0) {
					previousIndex = groupElems.length - 1;
				}

				Modal.initializeForElem(groupElems[previousIndex]);

				$(elem).iziModal("close", {
					transition: "fadeOutRight"
				});

				Modal.addToQueueByElem(groupElems[previousIndex], "fadeInLeft");
				Modal.trackEvent("Previous", elem);
			}
		});
	}

	static navigateToNextGroupItem () {
		let visibleModalElements = Modal.getVisibleModalElements();
		visibleModalElements.map((elem) => {
			if (Modal.isElemInAModalGroup(elem)) {

				let groupName = elem.data("izimodal-group");
				let groupElems = Modal.groups[groupName];
				let currentIndex = elem.data("izimodal-group-index");
				let nextIndex = parseInt(currentIndex) + 1;
				if (currentIndex == groupElems.length - 1) {
					nextIndex = 0;
				}

				Modal.initializeForElem(groupElems[nextIndex]);

				$(elem).iziModal("close", {
					transition: "fadeOutLeft"
				});

				Modal.addToQueueByElem(groupElems[nextIndex], "fadeInRight");
				Modal.trackEvent("Next", elem);
			}
		});
	}

	static getVisibleModalElements () {
		let allModalElements = document.querySelectorAll(".Modal");
		let visibleModalElements = [];
		allModalElements.map((modalElement) => {
			if (modalElement.style.display == "block") {
				visibleModalElements.push(modalElement);
			}
		});
		return visibleModalElements;
	}

	static thereAreVisibleModalElements () {
		let visibleModalElements = Modal.getVisibleModalElements();
		return visibleModalElements.length ? true : false;
	}

	static trackEvent (eventType, elem) {
		let elemAnalyticsType = elem.data("analytics-type");
		if (elemAnalyticsType && window.dataLayer) {
			window.dataLayer.push({
				"event": "modalClick",
				"modalAction": eventType,
				"modalType": elemAnalyticsType
			});
		}
	}

	static applyBodyScrollbarPadding () {
		let bodyWrapElem = document.body.querySelector(".body");
		let bodyScrollbarWidth = Modal.getBodyScrollbarWidth();
		bodyWrapElem.style.paddingRight = bodyScrollbarWidth + "px";
	}

	static removeBodyScrollbarPadding () {
		let bodyWrapElem = document.body.querySelector(".body");
		bodyWrapElem.style.removeProperty("padding-right");
	}

	static getBodyScrollbarWidth () {
		let measureElem = document.createElement("div");
		measureElem.classList.add("Modal-scrollbarMeasure");
		document.body.appendChild(measureElem);
		let scrollbarWidth = measureElem.getBoundingClientRect().width - measureElem.clientWidth;
		document.body.removeChild(measureElem);
		return scrollbarWidth;
	}

	static addToQueueByElem (elem, transition) {
		let id = elem.data("modal");
		Modal.addToQueueById(id, transition);
	}

	static addToQueueById (id, transition) {
		Modal.queue = {
			id: id,
			transition: transition
		};
	}

	static clearQueue () {
		Modal.queue = null;
	}

}

Modal.init();

export default Modal;



// WEBPACK FOOTER //
// ./static/components/Modal/Modal.js