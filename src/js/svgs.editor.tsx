import type { IconMetaData } from "@plugin/blocks/svgs.editor";
import { __ } from "@wordpress/i18n";

/**
 * When adding new icons, it's highly recommended to run the markup through
 * SVGO GUI to reduce the size before being committed. Be sure to enable
 * "Prefer viewBox to width/height" in the settings.
 * Online GUI: https://jakearchibald.github.io/svgomg/
 */
export const iconMetaData = {
	"yellow-arrow": {
		title: __("Yellow arrow", "launchpad"),
		makeAvailableToUser: true,
	},
} as const satisfies IconMetaData;
export type IconNames = keyof typeof iconMetaData;
