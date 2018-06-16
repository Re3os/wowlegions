function Expand (elem) {
	this.elem = elem;
	this.elem.expand = this;
	this.name = elem.attr("name");
	this.isAnimated = false;
	this.animation = null;
	this.contentContainer = null;
	this.init();
}

Object.assign(Expand, {
	elems: [],
	activeClass: "is-active",
	attr: "data-expand",
	groupAttr: "data-expand-group",
	animationClasses: ["Expand--fade", "Expand--grow"],
	contentContainerClass: "Expand-content",
	defaultOpenClass: "Expand--openByDefault",
	init: function() {
		document.querySelectorAlways(".Expand", Expand.create);
	},
	create: function(elem) {
		return new Expand(elem);
	},
	link: function (link, name) {
		var expand = Expand.find(name);
		if (expand) { expand.link(link); }
	},
	find: function (name) {
		var elem = Expand.elems.find(function (elem) {
			return elem.expand.name == name;
		});
		return elem.expand;
	},
	isActive: function(elem) {
		return elem.classList.contains(Expand.activeClass);
	},
	addActive: function(elem) {
		elem.classList.add(Expand.activeClass);
	},
	removeActive: function(elem) {
		elem.classList.remove(Expand.activeClass);
	},
	select: function (elem) {
		var groupName = elem.attr(Expand.groupAttr);

		if (groupName) {
			Expand.findAllInGroup(elem).map(function(e) { e.expand.toggle() });
		} else {
			elem.expand.toggle();
		}
	},
	findAllInGroup: function (elem) {
		var query = ".Expand" + elem.attributeSelector(Expand.groupAttr);
		return NodeList.prototype.matches.call(Expand.elems, query);
	},
	isAnimated: function(elem) {
		for(var c in Expand.animationClasses) {
			if(elem.classList.contains(Expand.animationClasses[c])) {
				return true;
			}
		}
		return false;
	}
});

Expand.prototype = {
	init: function () {
		Expand.elems.push(this.elem);
		this.isAnimated = Expand.isAnimated(this.elem);
		if(this.isAnimated) {
			if(this.elem.classList.contains("Expand--fade")) {
				this.animation = new ExpandAnimationFade(this);
			} else if(this.elem.classList.contains("Expand--grow")) {
				this.animation = new ExpandAnimationGrow(this);
			}
		}
		this.contentContainer = this.elem.querySelector("." + Expand.contentContainerClass);

		var isOpenByDefault = this.elem.classList.contains(Expand.defaultOpenClass);
		if(isOpenByDefault) {
			this.select();
		}
	},
	link: function (link) {
		link.addEventListener("click", this.select.bind(this));
	},
	select: function() {
		Expand.select(this.elem);
	},
	toggle: function() {
		if(this.isAnimated && this.animation) {
			this.animation.animate();
		} else {
			if (!Expand.isActive(this.elem)) {
				Expand.addActive(this.elem);
			} else {
				Expand.removeActive(this.elem);
			}
		}
	}
};

function ExpandAnimationFade (expand) {
	this.expand = expand;
	this.expand.elem.addEventListener("animationend", ExpandAnimationFade.endAnimation, false);
}

Object.assign(ExpandAnimationFade, {
	inClass: "is-fading-in",
	outClass: "is-fading-out",
	AnimationKeyFrameIn: "Expand-Animation-Fade-In",
	AnimationKeyFrameOut: "Expand-Animation-Fade-Out",
	in: function (elem) {
		Expand.addActive(elem);
		ExpandAnimationFade.removeOutClass(elem);
		ExpandAnimationFade.addInClass(elem);
	},
	out: function (elem) {
		ExpandAnimationFade.removeInClass(elem);
		ExpandAnimationFade.addOutClass(elem);
	},
	addInClass: function (elem) {
		elem.classList.add(this.inClass);
	},
	addOutClass: function (elem) {
		elem.classList.add(this.outClass);
	},
	removeInClass: function (elem) {
		elem.classList.remove(this.inClass);
	},
	removeOutClass: function (elem) {
		elem.classList.remove(this.outClass);
	},
	endAnimation: function (e) {
		var animationName = e.animationName;
		var elem = e.target;
		if(animationName == ExpandAnimationFade.AnimationKeyFrameIn) {
			Expand.addActive(elem);
		} else if(animationName == ExpandAnimationFade.AnimationKeyFrameOut) {
			Expand.removeActive(elem);
		}
	}
});

ExpandAnimationFade.prototype = {
	animate: function () {
		if(!Expand.isActive(this.expand.elem)) {
			ExpandAnimationFade.in(this.expand.elem);
		} else {
			ExpandAnimationFade.out(this.expand.elem);
		}
	}
};

function ExpandAnimationGrow (expand) {
	this.expand = expand;
	this.expand.elem.addEventListener("transitionend", ExpandAnimationGrow.endTransition, false);
	this.init();
}

Object.assign(ExpandAnimationGrow, {
	inClass: "is-growing-in",
	outClass: "is-growing-out",
	expands: [],
	init: function () {

	},
	addInClass: function(elem) {
		elem.classList.add(this.inClass);
	},
	addOutClass: function(elem) {
		elem.classList.add(this.outClass);
	},
	removeInClass: function(elem) {
		elem.classList.remove(this.inClass);
	},
	removeOutClass: function(elem) {
		elem.classList.remove(this.outClass);
	},
	// For the "grow animation" we have to manually set the heights of the container around the children to a fixed value.
	// This height is used by the transition to transition too and from 0.
	setHeight: function(elem, value) {
		if(value === undefined) {
			elem.style.height = elem.expand.contentContainer.clientHeight + "px";
		} else if(value === null) {
			elem.style.removeProperty('height');
		} else {
			var isNumber = !isNaN(value); 
			if(isNumber) {
				elem.style.height = value + "px";
			} else {
				elem.style.height = value;
			}
		}
	},
	endTransition: function(e) {
		var elem = e.target;
		if(Expand.isActive(elem)) {
			// After the transition finishes, we want to set the height to auto so that the height is responsive. 
			// Transitions can not transition from or to auto, only fixed values. 
			ExpandAnimationGrow.setHeight(elem, "auto");
		}
		ExpandAnimationGrow.removeInClass(elem);
		ExpandAnimationGrow.removeOutClass(elem);
	}
});

ExpandAnimationGrow.prototype = {
	init: function() {
		ExpandAnimationGrow.expands.push(this.expand);
	},
	animate: function() {
		var elem = this.expand.elem;
		if(!Expand.isActive(this.expand.elem)) {
			Expand.addActive(elem);
			ExpandAnimationGrow.removeOutClass(elem);
			ExpandAnimationGrow.addInClass(elem);
			ExpandAnimationGrow.setHeight(elem);
		} else {
			ExpandAnimationGrow.removeInClass(elem);
			ExpandAnimationGrow.addOutClass(elem);
			ExpandAnimationGrow.setHeight(elem);
			requestAnimationFrame(function(){
				ExpandAnimationGrow.setHeight(elem, 0);
				Expand.removeActive(elem);
			});
		}
	}
};

Expand.init();

module.exports = Expand;


// WEBPACK FOOTER //
// ./static/components/Expand/Expand.js