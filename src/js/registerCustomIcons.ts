import domReady from "@wordpress/dom-ready";
import { addFilter } from "@wordpress/hooks";
import { __ } from "@wordpress/i18n";
import { iconMetaData, type IconNames } from "./svgs.editor";

// Add custom icons to the Icon Block.
domReady(() => {
	const allThemeIcons = Object.entries(iconMetaData) as [
		IconNames,
		(typeof iconMetaData)[IconNames],
	][];

	const filteredThemeIcons = allThemeIcons.filter(([, { type }]) => {
		return type === "theme";
	});

	type IconDefinition = {
		isDefault?: boolean;
		name: string;
		title: string;
		icon: string;
		categories?: string[];
		keywords?: string[];
		hasNoIconFill: boolean;
	};

	const customThemeIcons = filteredThemeIcons.map(([icon, { title }]) => {
		return {
			isDefault: false,
			name: icon,
			title: title,
			icon: `<svg xmlns="http://www.w3.org/2000/svg" style="aspect-ratio: 1/1;"><use href="${window.location.protocol}//${window.location.host}/wp-content/themes/launchpad/dist/images/sprite.svg#${icon}"/></svg>`,
			categories: [],
			keywords: [],
			hasNoIconFill: false,
		} satisfies IconDefinition;
	});

	type CategoryDefinition = { name: string; title: string };
	const customIconCategories: CategoryDefinition[] = [];

	type IconSetDefinition = {
		isDefault?: boolean;
		type: string;
		title: string;
		icons: IconDefinition[];
		categories?: CategoryDefinition[];
	};

	function addCustomIcons(icons: IconSetDefinition[]) {
		const customIconType = [
			{
				isDefault: false,
				type: "launchpad-icons",
				title: __("Launchpad Icons", "launchpad"),
				icons: customThemeIcons,
				categories: customIconCategories,
			},
		] satisfies IconSetDefinition[];

		const allIcons: IconSetDefinition[] = [...icons, ...customIconType];

		return allIcons;
	}

	addFilter("iconBlock.icons", "launchpad/theme-icons", addCustomIcons);
});
