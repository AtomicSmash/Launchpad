import { domReady } from "./utils";

export class FixWPAdminBarHeight {
	wpBarIsGone = false;
	debounceResizeTimeout: undefined | ReturnType<typeof setTimeout> = undefined;
	shouldSetVariable = false;
	constructor() {
		if (document.body.classList.contains("admin-bar")) {
			this._setShouldSetVariable();
			this._attachListeners();
		}
	}
	_attachListeners() {
		window.addEventListener("resize", () => {
			clearTimeout(this.debounceResizeTimeout);
			this.debounceResizeTimeout = setTimeout(() => {
				this._setShouldSetVariable();
			}, 100);
		});
	}
	_setShouldSetVariable() {
		const shouldSetVariable = window.matchMedia(
			"screen and (max-width: 600px)",
		).matches;
		this.shouldSetVariable = shouldSetVariable;
		if (!shouldSetVariable) {
			document.body.style.removeProperty("--wp-admin--admin-bar--height");
		} else {
			this._setWPAdminBarHeight(this._getWPAdminBarHeight());
			window.addEventListener("scroll", () => {
				this._setWPAdminBarHeight(this._getWPAdminBarHeight());
			});
		}
	}
	_getWPAdminBarHeight() {
		return Math.max(0, 46 - document.documentElement.scrollTop);
	}
	_setWPAdminBarHeight(height: number) {
		document.body.style.setProperty(
			"--wp-admin--admin-bar--height",
			`${height}px`,
		);
	}
}

domReady(() => {
	new FixWPAdminBarHeight();
});
