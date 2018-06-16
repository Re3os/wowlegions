class Scrollable {

	static grabThreshold = 3;

	constructor ({elem}) {
		this.elem = elem;
		this.elem.scrollable = this;
		this.isActive = false;
		this.init();
	}

	static init () {
		document.querySelectorAlways(".Scrollable", Scrollable.create);
	}

	static create (elem) {
		return new Scrollable({elem});
	}

	init () {
		this.grab = new Animation(() => { this.update(); });
		this.elem.addEventListener("touchstart", (e) => { this.ontouchstart(e); });
		this.elem.addEventListener("mousedown", (e) => { this.onmousedown(e); });
		window.addEventListener("mouseup", (e) => { this.onmouseup(e); });
		window.addEventListener("resize", (e) => { this.onresize(e); });
	}

	isDisabled () {
		return this.elem.classList.contains("Scrollable--disabled");
	}

	reset () {
		this.elem.scrollLeft = 0;
	}

	onresize () {
		setImmediate(() => {
			if (this.isDisabled()) {
				this.reset();
			}
		});
	}

	ontouchstart (event) {
		event.stopPropagation();
	}

	onmousedown (event) {
		event.preventDefault();
		this.x = mouse.x;
		this.scrollLeft = this.elem.scrollLeft;
		this.isActive = false;
		this.elem.classList.add("is-grabbing");
		this.grab.start();
	}

	onmouseup (event) {
		if (!this.grab.paused) {
			event.preventDefault();
			if (this.isActive) {
				setImmediate(() => { this.disableLinks(false); });
			}
			this.isActive = false;
			this.elem.classList.remove("is-active");
			this.elem.classList.remove("is-grabbing");
			this.grab.stop();
		}
	}

	disableLinks (enable) {
		let isDisabled = enable !== false;
		for (let link of this.elem.querySelectorAll(".Link")) {
			link.attr("disabled", isDisabled);
		}
	}

	update () {
		if (!this.isActive) {
			// waiting for enough travel distance
			let distance = Math.abs(mouse.x - this.x);
			this.isActive = distance > Scrollable.grabThreshold;
			if (this.isActive) {
				this.elem.classList.add("is-active");
				this.disableLinks();
			}
		}
		if (this.isActive) {
			// update position
			let delta = this.x - mouse.x;
			this.elem.scrollLeft = this.scrollLeft + delta;
		}
	}

}

Scrollable.init();

export default Scrollable;



// WEBPACK FOOTER //
// ./static/components/Scrollable/Scrollable.js