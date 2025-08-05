import domReady from "@wordpress/dom-ready";

export class TransparentHeaderScroll {
	header: HTMLElement | null;
	constructor(transparentNav: HTMLDivElement) {
		this.header = transparentNav.closest("header");
		if (this.header) {
			this._attachListeners();
			this._onScroll(); // Set initial state
		}
	}
	_attachListeners() {
		window.addEventListener("scroll", () => this._onScroll());
	}
	_onScroll() {
		if (!this.header) return;
		if (window.scrollY > 0) {
			this.header.setAttribute("data-is-scrolled", "true");
		} else {
			this.header.removeAttribute("data-is-scrolled");
		}
	}
}

function enableTransparentHeaderFunctionality() {
	const transparentNav = document.querySelector<HTMLDivElement>(
		".transparent-header",
	);

	if (!transparentNav) {
		return;
	}

	new TransparentHeaderScroll(transparentNav);
}

domReady(() => {
	enableTransparentHeaderFunctionality();
});
