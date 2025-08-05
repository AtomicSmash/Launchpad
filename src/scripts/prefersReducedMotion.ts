import domReady from "@wordpress/dom-ready";

export class PrefersReducedMotion {
	userPrefersReducedMotion = true;
	constructor() {
		this._setUserPrefersReducedMotion(this._getUserPrefersReducedMotion());
		this._attachListeners();
	}
	_attachListeners() {
		window
			.matchMedia("(prefers-reduced-motion: reduce)")
			.addEventListener("change", () => {
				this._setUserPrefersReducedMotion(this._getUserPrefersReducedMotion());
			});
	}
	_getUserPrefersReducedMotion() {
		return window.matchMedia("(prefers-reduced-motion: reduce)").matches;
	}
	_setUserPrefersReducedMotion(userPrefersReducedMotion: boolean) {
		this.userPrefersReducedMotion = userPrefersReducedMotion;
		this._actionSideEffects();
	}
	_actionSideEffects() {
		void Promise.allSettled([
			// Put any methods here to be triggered when the users prefers reduced motion value changes.
			this._preventVideoAutoplay(),
		]);
	}
	async _preventVideoAutoplay() {
		const videos = document.getElementsByTagName("video");
		for (const video of videos) {
			if ("defaultAutoplayValue" in video.dataset === false) {
				video.dataset.defaultAutoplayValue = video.autoplay ? "true" : "false";
			}
			if (this.userPrefersReducedMotion) {
				video.autoplay = false;
				video.pause();
			} else {
				const shouldAutoplay = video.dataset.defaultAutoplayValue === "true";
				video.autoplay = shouldAutoplay;
				if (shouldAutoplay) {
					await video.play();
				}
			}
		}
	}
}

domReady(() => {
	new PrefersReducedMotion();
});
