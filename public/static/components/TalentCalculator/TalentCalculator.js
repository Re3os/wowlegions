
// TalentCalculator
function TalentCalculator (elem) {
	this.elem = elem;
	this.elem.talentCalculator = this;
	this.classes  = elem.querySelectorAll(".TalentCalculator-class");
	this.specs    = elem.querySelectorAll(".TalentCalculator-spec");
	this.shares   = elem.querySelectorAll(".TalentCalculator-share");
	this.resets   = elem.querySelectorAll(".TalentCalculator-reset");
	this.tiers    = elem.querySelectorAll(".TalentCalculator-tier");
	this.talents  = this.tiers.map(function (tier) {
		return tier.querySelectorAll(".TalentCalculator-talent")
	});
	this.petSpecOptions = elem.querySelectorAll(".TalentCalculator-petSpecOption");
	this.petSpecs = elem.querySelectorAll(".TalentCalculator-petSpecAbilities");
	this.init();
}

Object.assign(TalentCalculator, {
	init: function () {
		document.querySelectorAlways(".TalentCalculator", TalentCalculator.create);
	},
	create: function (elem) {
		return new TalentCalculator(elem);
	}
});

TalentCalculator.prototype = {
	init: function () {
		this.shares.map(this.listen.bind(this, this.share));
		this.resets.map(this.listen.bind(this, this.reset));
		this.tiers.map(this.listenTier.bind(this));
		this.classes.map(this.listenClass.bind(this));
		this.classes.map(this.listen.bind(this, this.save));
		this.specs.map(this.listen.bind(this, this.save));
		this.petSpecOptions.map(this.linkPetSpecs.bind(this));
		this.petSpecs.map(this.listenPetSpec.bind(this));
		this.load();
	},
	hideIntro: function() {
		this.elem.querySelectorAll(".TalentCalculator-intro").map(function(element) {
			element.classList.add("hide");
		});
	},
	setSubtitle: function(text) {
		this.elem.querySelector(".TalentCalculator-subtitle").textContent = text;
	},
	listen: function (fn, elem) {
		elem.addEventListener("click", fn.bind(this, elem));
	},
	listenClass: function (_class) {
		var specContainer = this.elem.querySelector(`.Tab[name="${_class.data("tab")}"] .TalentCalculator-specs`);
		_class.addEventListener("click", this.handleClassClick.bind(this, specContainer, true));
	},
	listenTier: function (tier, index) {
		var self = this;
		var talents = this.talents[index];
		talents.map(function (talent) {
			talent.addEventListener("click", self.toggleTier.bind(self, tier, talents)); // also fired when the buttons are clicked due to event bubbling
			talent.querySelector(".TalentCalculator-select").addEventListener("click", self.select.bind(self, tier, talents, talent));
			talent.querySelector(".TalentCalculator-unselect").addEventListener("click", self.unselect.bind(self, tier, talents, talent));
			talent.querySelector(".Talent-checkboxInput").addEventListener("click", self.handleTalentCheckboxClick.bind(self, tier, talents, talent));
		});
	},
	listenPetSpec: function(elem) {
		elem.querySelector(".TalentCalculator-select").addEventListener("click", this.selectPetSpec.bind(this, elem));
		elem.querySelector(".TalentCalculator-unselect").addEventListener("click", this.unselectPetSpec.bind(this, elem));
		elem.querySelector(".TalentCalculator-petSpecAbilitiesClose").addEventListener("click", function(e) {
			elem.petSpecTabLink.click();
		});
	},
	linkPetSpecs: function(elem) {
		var tabLink = elem.querySelector(".TalentCalculator-petSpecLink");
		var tab = document.querySelector(".TalentCalculator-petSpecAbilities" + tabLink.attributeSelector("data-tab"));
		elem.petSpecTab = tab;
		tab.petSpecTabLink = tabLink;
		tabLink.petSpecOption = elem;
	},
	share: function (link) {
		this.save(); //sanity check
		window.prompt("Shareable Permalink", location.href);
	},
	reset: function (link) {
		//TODO: reset only the current active spec
		var remove = this.removeSelection.bind(this);
		function removeTalent (tier) { tier.map(remove); }
		this.talents.map(removeTalent);
		this.tiers.map(remove);
		this.petSpecs.map(this.unselectPetSpec.bind(this));
		this.save();
	},
	handleTalentCheckboxClick: function(tier, talents, talent, e) {
		e.stopPropagation();
		if(e.currentTarget.checked) {
			this.selectTalent(tier, talents, talent);
		} else {
			this.unselectTalent(tier, talents, talent);
		}
	},
	handleClassClick: function(specContainerElem, show, event) {
		var subtitle = event.currentTarget.data("subtitle");
		this.setSubtitle(subtitle);
		this.hideIntro();
		this.syncHeightUpdate(specContainerElem, show);
	},
	syncHeightUpdate: function (elem, show) {
		var SyncHeight = elem.syncHeight;
		if (SyncHeight) {
			if (show) {
				setTimeout(SyncHeight.update.bind(SyncHeight), 1); //delay to let layout update first
			} else {
				SyncHeight.reset();
			}
		}
	},
	toggleTier: function (tier, talents) {
		tier.classList.toggle("TalentCalculator-tier--active");
		this.syncHeightUpdate(tier, tier.classList.contains("TalentCalculator-tier--active"));
		talents.map(this.toggleTalent.bind(this));
	},
	collapseTier: function(tier, talents) {
		tier.classList.remove("TalentCalculator-tier--active");
		this.syncHeightUpdate(tier, tier.classList.contains("TalentCalculator-tier--active"));
		talents.map(function(talent){ talent.Talent.collapse() });
	},
	toggleTalent: function (talent) {
		if(talent.Talent.isCollapsed) {
			talent.Talent.expand();
		} else {
			talent.Talent.collapse();
		}
	},
	selectTalent: function(tier, talents, talent) {
		this.select(tier, talents, talent);
	},
	select: function (tier, talents, talent) {
		talents.map(this.removeSelection.bind(this));
		this.addSelection(talent);
		this.addSelection(tier);
		this.save();
	},
	// @param showPetSpec
	// allows us to decide if we also want to show the abilities for the petSpec when we make a selection.
	selectPetSpec: function(elem, showPetSpec) {
		this.petSpecOptions.map(function(petSpecOptionElem) {
			petSpecOptionElem.classList.remove("is-active");
			petSpecOptionElem.petSpecTab.classList.remove("is-active");
		});
		elem.classList.add("is-active");
		elem.petSpecTabLink.petSpecOption.classList.add("is-active");
		this.save();
	},
	addSelection: function (selection) {
		if(selection.Talent) {
			selection.Talent.select();
		} else {
			selection.classList.add("is-selected");
		}
	},
	unselectTalent: function(tier, talents, talent) {
		this.unselect(tier, talents, talent);
	},
	unselect: function (tier, talents) {
		talents.map(this.removeSelection.bind(this));
		this.removeSelection(tier);
		this.save();
	},
	unselectPetSpec: function(elem) {
		elem.classList.remove("is-active");
		elem.petSpecTabLink.petSpecOption.classList.remove("is-active");
		this.save();
	},
	removeSelection: function (selection) {
		if(selection.Talent) {
			selection.Talent.unselect();
		}
		selection.classList.remove("is-selected");
	},
	save: function () {
		var self = this;
		setTimeout(function() { // let the dom update before we try to parse it
			var hash = "#" + self.export();
			location.replace( location.href.replace(/(#.*)?$/, hash) );
		}, 100);
	},
	load: function () {
		var self = this;
		setTimeout(function() { // let the dom update before we try to parse it
			self.import( location.hash.substr(1) );
		}, 100);
	},
	export: function () {
		// encoding scheme #druid/feral/talents=113201/pet=hunter-beast-mastery-pet-cunning
		var _class, classElem, spec, specElem, _spec, talents, petSpec, petSpecOptionElem, petSpecOptionTabLinkElem;
		var hash = [];
		var tiers = [];
		classElem = this.classes.match(".is-selected");
		if (classElem) {
			_class = classElem.data("tab");
			specElem = this.specs.match("[data-tab^=\"" + _class + "/\"].is-selected");
			if (specElem) {
				spec = specElem.data("tab");
				_spec = this.elem.querySelector(`.Tab[name="${spec}"]`);
				hash.push(spec);
			} else {
				hash.push(_class);
			}
		}
		if (_spec) {
			tiers = _spec.querySelectorAll(".TalentCalculator-tier");
			function tierNumber (tier) {
				var talents = tier.querySelectorAll(".TalentCalculator-talent");
				var number = 0;
				function saveTalent (talent, index) {
					if (talent.classList.contains("is-selected")) {
						number = index + 1;
					}
				}
				talents.map(saveTalent);
				return number;
			}
			talents = tiers.map(tierNumber).join("").replace(/0+$/,"");
			if (talents) {
				hash.push("talents=" + talents);
			}
		}
		petSpecOptionElem = this.petSpecOptions.match(".is-active");
		if(petSpecOptionElem) {
			petSpecOptionTabLinkElem = petSpecOptionElem.querySelector(".TalentCalculator-petSpecLink");
			petSpec = petSpecOptionTabLinkElem.data("tab");
			hash.push("pet=" + petSpec);
		}
		return hash.join("/");
	},
	import: function (hash) {
		var self = this;
		var classElem, specElem, _spec, petSpecElem, tiers, arg, type, value, values;
		var args    = hash.split("/");
		var _class   = args.shift();
		var spec    = args.shift();
		if (_class) {
			classElem = this.classes.match("[data-tab=\"" + _class + "\"]");
			if (classElem) {
				classElem.click();
			}
		}
		if (spec) {
			specElem = this.specs.match("[data-tab=\"" + _class + "/" + spec + "\"]");
			if (specElem) {
				specElem.click();
				_spec = this.elem.querySelector(`.Tab[name="${specElem.data("tab")}"]`);
			}
		}
		if (_spec) {
			tiers = _spec.querySelectorAll(".TalentCalculator-tier");
			while (arg = args.shift()) {
				type = arg.split("=").shift().toLowerCase();
				value = arg.split("=").slice(1).join("=");
				if (!type || !value) { continue; } //play nice with manually entered urls
				switch (type) {
					case "talents":
						values = value.replace(/\D/g,"").split("");
						values.map(function importTalent (value, index) {
							var num = ~~value;
							var tier = tiers[index];
							if (num > 0 && tier) {
								var talents = tier.querySelectorAll(".TalentCalculator-talent");
								var talent = talents[num - 1];
								if (talent) {
									self.select(tier, talents, talent);
								} else {
									self.syncHeightUpdate(tier);
								}
							}
						});
						break;
					case "pet":
						petSpecElem = this.petSpecs.match("[data-tab=\"" + value + "\"]");
						if (petSpecElem) {
							// select the petSpec, but don't show its abilities.
							self.selectPetSpec(petSpecElem, false);
						}
						break;
					case "glyphs":
						break;
				}
			}
			this.save();
		}
	}
};

TalentCalculator.init();

module.exports = TalentCalculator;



// WEBPACK FOOTER //
// ./static/components/TalentCalculator/TalentCalculator.js