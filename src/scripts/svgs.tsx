import type { IconNames } from "./svgs.editor";
import type { SVGProps } from "react";

type IconProps = SVGProps<SVGSVGElement> & {
	iconName: IconNames;
	size?: string;
	isEditorMode?: boolean;
};

export function Icon(props: IconProps) {
	const { iconName, size, isEditorMode = false, ...svgProps } = props;
	return (
		<svg
			xmlns="http://www.w3.org/2000/svg"
			width={size}
			height={size}
			{...svgProps}
		>
			{/* Full URL is required to make SVGs load in iframed block editor. */}
			<use
				href={`${isEditorMode ? `${window.location.protocol}//${window.location.host}` : ""}/wp-content/themes/launchpad/dist/icons/sprite.svg#${iconName}`}
			/>
		</svg>
	);
}
