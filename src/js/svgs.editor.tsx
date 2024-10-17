import { __ } from "@wordpress/i18n";

/**
 * When adding new icons, it's highly recommended to run the markup through
 * SVGO GUI to reduce the size before being committed. Be sure to enable
 * "Prefer viewBox to width/height" in the settings.
 * Online GUI: https://jakearchibald.github.io/svgomg/
 */
export const iconMetaData = {
	"yellow-arrow": {
		type: "theme",
		title: __("Yellow arrow", "launchpad"),
	},
} as const satisfies Record<
	string,
	{ title: string; type: "theme" | "blockIcon" | "ui" }
>;
export type IconNames = keyof typeof iconMetaData;
