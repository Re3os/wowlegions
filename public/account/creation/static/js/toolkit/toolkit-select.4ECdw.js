/**
 * CSS polyfill for select boxes.
 *
 * @author          dlawton
 * @author          sboyce
 * @author          djkim
 *
 * @class           Select
 * @requires        jQuery
 */
var Select = {

	/**
	 * Configuration.
	 */
	config: {},

	/**
	 * CSS selectors
	 */
	query: "",

	/**
	 * jQuery objects
	 */
	select: null,

	/**
	 * DOM objects
	 */
	selectBox: null,
	optionList: null,

	/**
	 * Create an instance of the Select class.
	 * Any parameters passed to this method will be passed to the _construct method.
	 *
	 * @returns             An instance of Select
	 *
	 * @example             var classTemplate = Select.create(query, config)
	 */
	create: function create () {
		var instance = Object.create(this);
		instance._construct.apply(instance, arguments);
		return instance;
	},

	/**
	 * Initialize the Select class and apply the (optional) config.
	 *
	 * @constructs
	 *
	 * @param query         CSS selector for the select element
	 * @param config        Optional configuration
	 */
	_construct: function _construct (query, config) {
		query = typeof query === "undefined" ? "#select" : query;

		this.select = $(query);

		// Check if the element exists
		if (!this.select.length) {
			return;
		}

		config = typeof config === "undefined" ? {} : config;

		// Merge configuration
		this.config = $.extend({}, config);

		this.setup();
	},

	/**
	 * Convenience method to call parent methods in the context of the current object.
	 *
	 * @param childObject   Reference to the object that"s overriding the method
	 * @param methodName    Name of the method being overridden
	 * @param parameters    Array of parameters
	 */
	_super: function _super (childObject, methodName, parameters) {
		if (typeof methodName !== "string") {
			parameters = methodName;
			methodName = "_construct";
		}
		return Object.getPrototypeOf(childObject)[methodName].apply(this, parameters);
	},

	/**
	 * Sets up the Select class.
	 */
	setup: function setup () {
		this.selectBox = this._buildSelect(this.select[0]);
		this.optionList = this._buildOptionList(this.select.children());

		this.selectBox.append(this.optionList);

		this.select.wrap(this.selectBox);

		// respect autofocus attribute of original select box
		if (this.select[0].getAttribute("autofocus") === "autofocus") {
			// re-jQueryfying this element because we need it in the document context to set focus
			$("#" + this.selectBox.attr("id")).focus();
		}
	},

	/**
	 * Create the select box"s XHTML structure.
	 *
	 * @param element
	 * @return {*|jQuery|HTMLElement}
	 * @private
	 */
	_buildSelect: function buildSelect (element) {
		var doc = document,
			selectBox = doc.createElement("div"),
			original = doc.createElement("span"),
			current = doc.createElement("span"),
			currentIcon = doc.createElement("i"),
			currentText = doc.createElement("span"),
			arrow = doc.createElement("span"),
			id = (typeof element.id === "string" ? element.id : "select-box-" + Math.floor(Math.random() * 11000000000) + 1),
		// To achieve the best performance when using :selected to select elements, first select the elements using a pure CSS selector, then use .filter(":selected").
		// @see http://api.jquery.com/selected-selector/
			elSelectedOption = $(element).find("option").filter(":selected")[0];

		// wrap the original
		original.className = "original";

		// A tabindex value is required for keyboard events such as :focus
		selectBox.tabIndex = element.tabIndex || 0;
		selectBox.className = "select-box" + (typeof element.className === "string" ? " " + element.className : "") + (element.disabled ? " disabled" : "");
		selectBox.id = "select-box-" + id;
		selectBox.setAttribute("data-select", "select");
		selectBox.setAttribute("data-original-id", id);
		selectBox.setAttribute("data-select-id", "select-box-" + id);

		current.className = "current" + (elSelectedOption.getAttribute("data-placeholder") ? " placeholder" : "");

		currentIcon.className = elSelectedOption.getAttribute("data-icon") || "";
		currentText.className = "text";
		currentText.appendChild(doc.createTextNode(elSelectedOption.text));

		arrow.className = "arrow";

		current.appendChild(currentIcon);
		current.appendChild(currentText);
		selectBox.appendChild(original);
		selectBox.appendChild(current);
		selectBox.appendChild(arrow);

		element.style.display = "none";
		element.setAttribute("data-original-id", id);
		element.setAttribute("data-select-id", "select-box-" + id);

		return $(selectBox);
	},

	/**
	 * Build the complete list of options based on all the children of a <select/> element
	 *
	 * @param children
	 * @return {HTMLElement}
	 * @private
	 */
	_buildOptionList: function _buildOptionList (children) {
		var options = document.createElement("div");

		options.className = "options";

		this._buildOptions(children, options);

		return options;
	},

	/**
	 * Build a list of options from the children of a <select/> or <optgroup/> and append them to a container (either
	 * <div class="options"/> or <div class="option-group"/>, respectively)
	 *
	 * @param children
	 * @param container
	 * @return {*}
	 * @private
	 */
	_buildOptions: function _buildOptions (children, container) {
		var i, len, el;

		for (i = 0, len = children.length; i < len; i++) {
			el = children[i];
			if (el.tagName.toLowerCase() === "optgroup") {
				container.appendChild(this._buildOptgroup(el));
			} else if (el.tagName.toLowerCase() === "option") {
				container.appendChild(this._buildOption(el));
			}
		}

		return container;
	},

	/**
	 * Return the XHTML for a single <div class="option-group"/> element, based on a corresponding <optgroup/> element
	 * and its <option/> children
	 *
	 * @param element
	 * @return {HTMLElement}
	 * @private
	 */
	_buildOptgroup: function _buildOptgroup (element) {
		var doc = document,
			optgroup = doc.createElement("div"),
			optgroupLabel = doc.createElement("div"),
			optgroupIcon = doc.createElement("i"),
			optgroupText = doc.createElement("span");

		optgroup.className = "option-group";

		if (typeof element.label !== "undefined") {
			optgroupLabel.className = "option-group-label";
			optgroupIcon.className = element.getAttribute("data-icon") || "";
			optgroupText.className = "text";
			optgroupText.appendChild(doc.createTextNode(element.label));
			if (optgroupIcon.className !== "") {
				optgroupLabel.appendChild(optgroupIcon);
			}
			optgroupLabel.appendChild(optgroupText);
			optgroup.appendChild(optgroupLabel);
		}

		this._buildOptions(element.children, optgroup);
		return optgroup;
	},

	/**
	 * Return the XHTML for a single <div class="option"/> element, based on a corresponding <option/> element
	 *
	 * @param element
	 * @return {HTMLElement}
	 * @private
	 */
	_buildOption: function _buildOption (element) {
		var doc = document,
			option = doc.createElement("div"),
			optionIcon = doc.createElement("i"),
			optionText = doc.createElement("span");

		option.className = "option" + (element.selected ? " selected" : "") + (element.getAttribute("data-placeholder") ? " placeholder" : "");
		option.setAttribute("data-value", element.value || "");

		optionIcon.className = element.getAttribute("data-icon") || "";
		optionText.className = "text";
		optionText.appendChild(doc.createTextNode(element.text));

		if (optionIcon.className !== "") {
			option.appendChild(optionIcon);
		}
		option.appendChild(optionText);

		return option;
	}

};

/**
 * Select data-API
 */
var SelectEventHandler = {

	container: null,
	body: null,

	searchTerm: "",
	repeatCount: 1,

	timer: null,
	ticks: 0,
	maxTicks: 300,

	pagerSize: 20,

	/**
	 * Register events for interaction. Prefer .on() handlers as of jQuery 1.7.
	 *
	 * @see http://api.jquery.com/category/version/1.7/
	 *
	 * @param query
	 */
	registerEvents: function registerEvents (query) {
		query = query || document;

		this.container = $(query);

		// Check if the element exists
		if (!this.container.length) {
			return;
		}

		this.body = $("body");

		this._clearTimer();

		this.container.on("click.select.data-api", "[data-select]", $.proxy(this._processClickSelect, this));
		this.container.on("touchend.select.data-api", "[data-select]", $.proxy(this._processClickSelect, this));
		this.container.on("keydown.select.data-api", "[data-select]", $.proxy(this._processKeydownSelect, this));
		this.container.on("keypress.select.data-api", "[data-select]", $.proxy(this._processKeypressSelect, this));
		this.container.on("blur.select.data-api", "[data-select]", $.proxy(this._processBlurSelect, this));

		this.container.on("click.select.data-api", "[data-select] div.option", $.proxy(this._processClickOption, this));
		this.container.on("touchend.select.data-api", "[data-select] div.option", $.proxy(this._processClickOption, this));
		this.container.on("click", "select:not(.css-input, [multi]) option", $.proxy(this._processClickOption, this));

		this.container.on("disable.select.data-api", "[data-select]", $.proxy(this._processDisableSelect, this));
		this.container.on("enable.select.data-api", "[data-select]", $.proxy(this._processEnableSelect, this));
		this.container.on("disable", "select:not(.css-input, [multi])", $.proxy(this._processDisableSelect, this));
		this.container.on("enable", "select:not(.css-input, [multi])", $.proxy(this._processEnableSelect, this));
	},

	_incrementTimer: function _incrementTimer () {
		if (this.ticks < this.maxTicks) {
			this.ticks = this.ticks + 1;
		} else {
			this._clearTimer();
		}
	},

	_clearTimer: function _clearTimer () {
		clearInterval(this.timer);
		this.timer = null;
		this.ticks = 0;
		this.repeatCount = 1;
		this.searchTerm = "";
	},

	/**
	 * User clicked on the select box, so update the UI accordingly.
	 *
	 * @param e             Event data
	 * @private
	 */
	_processClickSelect: function _processClickSelect (e) {
		var target = e.currentTarget, selectId = target.getAttribute("data-original-id"), selectBoxId = target.getAttribute("data-select-id"), selectBoxElement = $("#" + selectBoxId), selectElement = $("#" + selectId);

		// cancel subsequent emulated mouse events if this is a touch event
		if (e.type.indexOf("touch") === 0) {
			e.preventDefault();
		}

		if (selectBoxElement.hasClass("disabled") && selectElement.prop("disabled")) {
			return false;
		} else {
			if (selectBoxElement.hasClass("expanded")) {
				// Don't hide the option list if the user clicks on the scrollbar
				if ($.inArray(e.target.className, ["scrollbar", "track", "thumb", "end"]) === -1) {
					this.hideOptions(selectBoxElement);
				}
			} else {
				this.hideOptions($("[data-select]").not(selectBoxElement));
				this.showOptions(selectBoxElement);
			}
			return true;
		}
	},

	/**
	 * We want to replicate functionality of the default <select/> elements as closely as possible.
	 *
	 * Keypresses generate charCodes (unlike keydowns) so Unicode may be used to search in option lists (i.e. for Russian keyboards)
	 *
	 * @param e event object
	 * @return (boolean)
	 * @private
	 */
	_processKeypressSelect: function _processKeypressSelect (e) {
		var target = $(e.currentTarget), selectId = target[0].getAttribute("data-original-id"), selectBoxId = target[0].getAttribute("data-select-id"), selectElement = $("#" + selectId), selectBoxElement = $("#" + selectBoxId), key = e.which || e.keyCode, // In Firefox, charCode/which returns 0 for tab, so fall back to keyCode if falsey
			character = String.fromCodePoint(key);

		switch (key) {
			case 38: // ARROW UP
				return true; // pass this through
			case 40: // ARROW DOWN
				return true; // pass this through
			case 36: // HOME KEY
				return true; // pass this through
			case 35: // END KEY
				return true; // pass this through
			case 33: // PGUP KEY
				return true; // pass this through
			case 34: // PGDN KEY
				return true; // pass this through
			case 27: // ESCAPE
				return true; // pass this through
			case 9: // TAB
				return true; // pass this through
			default:
				if (this.timer === null) {

					this.timer = setInterval($.proxy(this._incrementTimer, this), 1);
					this.searchTerm = character;
				} else {
					// handle "FFF", e.g. repeated search of first initial
					if (this.searchTerm === character) {
						this.repeatCount += 1;
					}
					// regular string search
					else {
						this.searchTerm += character;
					}
				}

				this.selectOptionByValue(this.searchTerm, selectBoxElement, selectElement, this.repeatCount);
				return false;
		}
	},

	/**
	 * Processes keydown events for non char-generating keys that won"t be handled by _processKeypressSelect()
	 *
	 * @param e
	 * @returns {boolean}
	 * @private
	 */
	_processKeydownSelect: function _processKeydownSelect (e) {
		var target = $(e.currentTarget), selectedOption = target.find(".selected"), selectId = target[0].getAttribute("data-original-id"), selectBoxId = target[0].getAttribute("data-select-id"), selectElement = $("#" + selectId), selectBoxElement = $("#" + selectBoxId), isExpanded = selectBoxElement.hasClass("expanded"), key = e.keyCode;

		switch (key) {
			case 38: // ARROW UP
				this.selectOption(this._getNthOption(selectBoxElement, selectedOption, -1), selectBoxElement, selectElement);

				if (!isExpanded) {
					this.setOption(selectElement);
				}
				return false;

			case 40: // ARROW DOWN
				this.selectOption(this._getNthOption(selectBoxElement, selectedOption, 1), selectBoxElement, selectElement);

				if (!isExpanded) {
					this.setOption(selectElement);
				}
				return false;

			case 36: // HOME KEY
				this.selectOption(this._getFirstOption(selectBoxElement), selectBoxElement, selectElement);

				if (!isExpanded) {
					this.setOption(selectElement);
				}
				return false;

			case 35: // END KEY
				this.selectOption(this._getLastOption(selectBoxElement), selectBoxElement, selectElement);

				if (!isExpanded) {
					this.setOption(selectElement);
				}
				return false;

			case 33: // PGUP KEY
				// only handle if the dropdown is expanded.
				if (isExpanded) {
					this.selectOption(this._getNthOption(selectBoxElement, selectedOption, -(this.pagerSize)), selectBoxElement, selectElement);
				}
				return false;

			case 34: // PGDN KEY
				// only handle if the dropdown is expanded.
				if (isExpanded) {
					this.selectOption(this._getNthOption(selectBoxElement, selectedOption, this.pagerSize), selectBoxElement, selectElement);
				}
				return false;

			case 27: // ESC
			case 13: // ENTER
				this._processEnterKeydownSelect(e);
				this.setOption(selectElement);
				break;

			case 9: // TAB
				this._clearTimer(); // reset the timer so user doesn"t have to wait it out when switching fields
				this._processTabKeydownSelect(e);
				this.setOption(selectElement);
				return true; // pass this key through
		}
	},

	/**
	 * User removed focus from the select box (usually by clicking or tabbing away), so update the UI accordingly.
	 *
	 * Note that IE fires the the onblur event on the original object before the onfocus or onclick event on the
	 * object receiving focus. So we check here for the focused element, and if it"s an .option we
	 * prevent the onblur event from doing anything.
	 *
	 * @param e             Event data
	 * @private
	 */
	_processBlurSelect: function _processBlurSelect (e) {
		var target = e.currentTarget,
			selectBoxId = target.getAttribute("data-select-id"),
			selectBoxElement = $("#" + selectBoxId),
			selectId = selectBoxElement[0].getAttribute("data-original-id"),
			selectElement = $("#" + selectId);

		// http://msdn.microsoft.com/en-us/library/ie/ms536909%28v=vs.85%29.aspx
		if (document.activeElement && $.inArray($(document.activeElement)[0].className, ["option", "scrollbar", "track", "thumb", "end"]) > -1) {
			if (["option", "scrollbar", "track", "thumb", "end"].indexOf(document.activeElement.className) > -1) {
				return false;
			}
		}

		this.hideOptions(selectBoxElement);
		this.setOption(selectElement);
		return true;
	},

	/**
	 * User clicked on the select box, so update the UI accordingly.
	 *
	 * @param e             Event data
	 * @private
	 */
	_processClickOption: function _processClickOption (e) {
		var tagName = e.currentTarget.tagName.toLowerCase(),
			target,
			selectBoxElement,
			selectId,
			selectBoxId,
			selectElement;

		if (tagName === "option") {
			selectElement = $(e.currentTarget).parents("select");
			selectBoxId = selectElement[0].getAttribute("data-select-id");
			selectBoxElement = $("#" + selectBoxId);
			target = selectBoxElement.find("[data-value=\"" + e.currentTarget.value + "\"]");
			e.preventDefault();
			e.stopPropagation();
		} else {
			// cancel subsequent emulated mouse events if this is a touch event
			if (e.type.indexOf("touch") === 0) {
				e.preventDefault();
			}

			target = $(e.currentTarget);
			selectBoxElement = target.parents(".select-box");
			selectId = selectBoxElement[0].getAttribute("data-original-id");
			selectElement = $("#" + selectId);
		}

		this.selectOption(target, selectBoxElement, selectElement);
		this.setOption(selectElement);
	},

	/**
	 * Custom event handler for disabling the UI and corresponding <select/> element.
	 *
	 * @param e             Event data
	 * @private
	 */
	_processDisableSelect: function _processDisableSelect (e) {
		var target = e.currentTarget,
			selectId = target.getAttribute("data-original-id"),
			selectBoxId = target.getAttribute("data-select-id"),
			selectElement = $("#" + selectId),
			selectBoxElement = $("#" + selectBoxId);

		this.hideOptions(selectBoxElement);

		// DOM property, XHTML attribute
		selectElement.prop("disabled", true).attr("disabled", "disabled");
		// UI
		selectBoxElement.addClass("disabled");
	},

	/**
	 * Custom event handler for enabling the UI and corresponding <select/> element.
	 *
	 * @param e             Event data
	 * @private
	 */
	_processEnableSelect: function _processEnableSelect (e) {
		var target = e.currentTarget,
			selectId = target.getAttribute("data-original-id"),
			selectBoxId = target.getAttribute("data-select-id"),
			selectElement = $("#" + selectId),
			selectBoxElement = $("#" + selectBoxId);

		// DOM property, XHTML attribute
		selectElement.prop("disabled", false).removeAttr("disabled", "disabled");
		// UI
		selectBoxElement.removeClass("disabled");
	},

	/**
	 * Gets the first option in the full option list
	 *
	 * @param selectBoxElement
	 * @private
	 */
	_getFirstOption: function _getFirstOption (selectBoxElement) {
		return selectBoxElement.find(".option").first();
	},

	/**
	 * Gets the last option in the full option list
	 * @param selectBoxElement
	 * @private
	 */
	_getLastOption: function _getLastOption (selectBoxElement) {
		return selectBoxElement.find(".option").last();
	},

	/**
	 * Gets the nth option in the option list, relative to the current option
	 *
	 * @param selectBoxElement
	 * @param currentOption
	 * @param delta             (int) position relative to current index. negative for up, positive for down.
	 * @return jQuery object
	 * @private
	 */
	_getNthOption: function _getNthOption (selectBoxElement, currentOption, delta) {
		var optionList = selectBoxElement.find(".option"),
			len = optionList.length,
			currentOptionIndex = optionList.index(currentOption),
			searchIndex = delta + currentOptionIndex;

		if (searchIndex < 0) {
			return $(optionList[0]);
		} else if (searchIndex > len) {
			return $(optionList[len - 1]);
		} else {
			return $(optionList[searchIndex]);
		}
	},

	/**
	 * User pressed enter key, so hide the option list (don"t submit the form)
	 *
	 * @param e             Event data
	 * @private
	 */
	_processEnterKeydownSelect: function _processEnterKeydownSelect (e) {
		e.preventDefault();
		this.hideOptions($("#" + e.currentTarget.getAttribute("data-select-id")));
	},

	/**
	 * User pressed tab key, so hide the option list (don"t submit the form)
	 *
	 * @param e             Event data
	 * @private
	 */
	_processTabKeydownSelect: function _processTabKeydownSelect (e) {
		this.hideOptions($("#" + e.currentTarget.getAttribute("data-select-id")));
	},

	/**
	 * Calculate the appropriate scroll offset when displaying the option list.
	 *
	 * @param selectBoxElement
	 * @return {number}
	 * @private
	 */
	_calculateScrollOffset: function _calculateScrollOffset (selectBoxElement) {
		var maxHeight = parseInt(selectBoxElement.find(".options").css("max-height"), 10) || 200,
			midpoint = Math.floor((maxHeight - parseInt(selectBoxElement.find(".option").css("height"), 10)) / 2) || 30,
			maxOffset = selectBoxElement.find(".overview").outerHeight() - maxHeight,
			optionOffset = selectBoxElement.find(".selected").position().top - midpoint;

		if (optionOffset < 0) {
			return 0;
		} else if (optionOffset > maxOffset) {
			return maxOffset;
		} else {
			return optionOffset;
		}
	},

	/**
	 * Show the options list for the select box.
	 *
	 * @param selectBoxElement
	 */
	showOptions: function showOptions (selectBoxElement) {
		var optionList = selectBoxElement.find(".options"),
			optionOffset;

		selectBoxElement.addClass("expanded");
		this.body.addClass("no-select");

		if (optionList.hasClass("scrollbar-content")) {
			optionOffset = this._calculateScrollOffset(selectBoxElement);
			optionList.tinyscrollbar_update(optionOffset);

		} else if (optionList[0].scrollHeight > parseInt(optionList.css("max-height"), 10)) {
			optionList.tinyscrollbar({
				wheel: 24,
				sizethumb: "auto"
			});

			optionOffset = this._calculateScrollOffset(selectBoxElement);
			optionList.tinyscrollbar_update(optionOffset);
		}
	},

	/**
	 * Hide the options list for the select box.
	 *
	 * @param selectBoxElement
	 */
	hideOptions: function hideOptions (selectBoxElement) {
		selectBoxElement.removeClass("expanded");
		this.body.removeClass("no-select");
	},

	/**
	 * Select an option by matching its value against a provided string.
	 *
	 * TODO This could be optimized
	 *
	 * @param value
	 * @param selectBoxElement
	 * @param selectElement
	 * @param repeatCount [optional]
	 * @private
	 */
	selectOptionByValue: function _processTypeaheadSelect (value, selectBoxElement, selectElement, repeatCount) {
		var optionElement;

		if (typeof value !== "string") {
			value = value.toString();
		}

		repeatCount = repeatCount || 1;

		optionElement = this._findOptionByLabel(value, selectBoxElement, repeatCount - 1);

		if (optionElement && optionElement.length) {
			this.selectOption(optionElement, selectBoxElement, selectElement);
		}
	},

	/**
	 * Return a jQuery object for an option that starts with a provided string.
	 *
	 * @param label
	 * @param selectBoxElement
	 * @param position
	 * @return {*}
	 * @private
	 */
	_findOptionByLabel: function _findOptionByLabel (label, selectBoxElement, position) {
		var elements;

		position = position || 0;

		elements = selectBoxElement.find(".option:caseInsensitiveStartsWith(\"" + label + "\")");

		if (elements.length) {
			return $(elements[position % elements.length]);
		} else {
			return null;
		}
	},

	/**
	 * Selecting an option should update all DOM properties, XHTML attributes, and UI accordingly.
	 *
	 * @param optionElement
	 * @param selectBoxElement
	 * @param selectElement
	 */
	selectOption: function selectOption (optionElement, selectBoxElement, selectElement) {
		var current = selectBoxElement.find(".current"),
			value = optionElement[0].getAttribute("data-value"),
			icon = optionElement.find("i")[0],
			text = optionElement.find(".text").text(),
			optionList = selectBoxElement.find(".options"),
			optionOffset;

		selectBoxElement.find(".selected").removeClass("selected");
		optionElement.addClass("selected");

		// DOM property, XHTML attribute
		selectElement.find("[value=\"" + value + "\"]").prop("selected", true).attr("selected", "selected");

		if (optionElement.hasClass("placeholder")) {
			current.addClass("placeholder");
		} else {
			current.removeClass("placeholder");
		}
		if (typeof icon === "undefined") {
			current.children("i").removeAttr("class");
		} else {
			current.children("i")[0].className = icon.className;
		}
		current.children(".text").text(text);

		// update the scroll position
		if (optionList.hasClass("scrollbar-content")) {
			optionOffset = this._calculateScrollOffset(selectBoxElement);
			optionList.tinyscrollbar_update(optionOffset);
		}
	},

	/**
	 * Lock in the selected option (i.e. after ENTER or blurring). This is separate from selectOption so the class
	 * can emulate the behavior of native select elements.
	 *
	 * @param selectElement
	 */
	setOption: function setOption (selectElement) {
		selectElement.trigger("change");
	}
};

$(function () {
	/**
	 * Automatically apply Select.create() on qualifying select elements in the document
	 */
	(function () {
		var originals = $("select").not("[multiple]").not(".css-input"),
			options = {};

		originals.each(function () {
			Select.create(this, options);
		});

		// only register events on selects that aren't opting out or using multiselect
		if (originals.length > 0) {
			SelectEventHandler.registerEvents(document);
		}
	})();
});
