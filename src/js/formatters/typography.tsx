import type { WPFormat, WPFormatSettings } from "@wordpress/rich-text";
import type { ComponentProps } from "react";
import { RichTextToolbarButton, useSettings } from "@wordpress/block-editor";
import { Popover, Button, SelectControl } from "@wordpress/components";
import { __, _x } from "@wordpress/i18n";
import { typography as typographyIcon } from "@wordpress/icons";
import { applyFormat, removeFormat, useAnchor } from "@wordpress/rich-text";
import { useState } from "react";

const name = "launchpad/typography";
const formatAttributes = {
	class: "class",
	style: "style",
};
const settings = {
	title: "Typography",
	tagName: "span",
	className: "has-inline-typography",
	attributes: formatAttributes,
	interactive: false,
	edit: Edit,
} as const satisfies WPFormatSettings<typeof formatAttributes>;

export const typography = {
	name,
	...settings,
} satisfies WPFormat<typeof settings>;

const FONT_WEIGHTS = [
	{
		name: _x("Thin", "font weight"),
		value: "100",
	},
	{
		name: _x("Extra Light", "font weight"),
		value: "200",
	},
	{
		name: _x("Light", "font weight"),
		value: "300",
	},
	{
		name: _x("Regular", "font weight"),
		value: "400",
	},
	{
		name: _x("Medium", "font weight"),
		value: "500",
	},
	{
		name: _x("Semi Bold", "font weight"),
		value: "600",
	},
	{
		name: _x("Bold", "font weight"),
		value: "700",
	},
	{
		name: _x("Extra Bold", "font weight"),
		value: "800",
	},
	{
		name: _x("Black", "font weight"),
		value: "900",
	},
] as const;

function Edit({
	isActive,
	onChange,
	value,
	contentRef,
}: Parameters<WPFormatSettings<typeof formatAttributes>["edit"]>[0]) {
	const popoverAnchor = useAnchor<typeof formatAttributes>({
		editableContentElement: contentRef.current,
		// Adding isActive here fixes the anchor breaking when you unformat and then immediately reformat.
		settings: { ...settings, isActive },
	});
	const [isPopoverVisible, setIsPopoverVisible] = useState(false);
	const [fontFamily, setFontFamily] = useState("");
	const [fontWeight, setFontWeight] = useState<
		(typeof FONT_WEIGHTS)[number]["value"] | ""
	>("");

	return (
		<>
			<RichTextToolbarButton
				icon={typographyIcon}
				title="Typography"
				onClick={() => {
					setFontFamily(
						value.activeFormats[0]?.attributes?.class
							?.replace("has-", "")
							.replace("-font-family", "") ?? "",
					);
					setFontWeight(
						(value.activeFormats[0]?.attributes?.style?.replace(
							"font-weight:",
							"",
						) as (typeof FONT_WEIGHTS)[number]["value"] | undefined) ?? "",
					);
					setIsPopoverVisible(!isPopoverVisible);
				}}
				isActive={isActive}
			/>
			{isPopoverVisible ? (
				<Popover
					className="block-editor-format-toolbar__typography-popover"
					anchor={popoverAnchor}
					resize={true}
					onClose={() => setIsPopoverVisible(!isPopoverVisible)}
				>
					<form
						onSubmit={(event) => {
							event.preventDefault();
							if (fontFamily === "" && fontWeight === "") {
								onChange(removeFormat<typeof formatAttributes>(value, name));
							} else {
								onChange(
									applyFormat<typeof formatAttributes>(value, {
										type: name,
										attributes: {
											...(fontFamily !== ""
												? { class: `has-${fontFamily}-font-family` }
												: undefined),
											...(fontWeight !== ""
												? { style: `font-weight:${fontWeight}` }
												: undefined),
										},
									}),
								);
							}
							setIsPopoverVisible(!isPopoverVisible);
						}}
					>
						<FontFamilyControl
							value={fontFamily}
							onChange={(newFontFamily: string) => {
								setFontFamily(newFontFamily);
							}}
						/>
						<SelectControl
							label={__("Font weight")}
							labelPosition="top"
							options={[
								{ value: "", label: __("Default") },
								...FONT_WEIGHTS.map(({ name, value }) => {
									return {
										label: name,
										value,
									};
								}),
							]}
							value={fontWeight}
							onChange={(newFontWeight) => {
								if (
									undefined ===
										FONT_WEIGHTS.find(({ value }) => value === newFontWeight) &&
									"" !== newFontWeight
								) {
									console.error(
										`Unexpected font weight value "${newFontWeight}".`,
									);
									return;
								}
								setFontWeight(
									newFontWeight as (typeof FONT_WEIGHTS)[number]["value"] | "",
								);
							}}
						/>
						<Button variant="primary" type="submit" text={__("Apply")} />
					</form>
				</Popover>
			) : null}
		</>
	);
}

type FontFamilyDeclaration = {
	fontFamily: string;
	slug: string;
	name: string;
	fontFace: {
		fontFamily: string;
		fontWeight: string;
		fontStyle: string;
		fontDisplay: string;
		src: string[];
	}[];
};

export function FontFamilyControl({
	value = "",
	onChange,
	...props
}: {
	value?: string;
	onChange?: (value: string) => void;
} & Omit<
	ComponentProps<typeof SelectControl>,
	"value" | "multiple" | "onChange"
>) {
	const [blockLevelFontFamilies] = useSettings("typography.fontFamilies") as [
		{
			theme: FontFamilyDeclaration[];
		},
	];
	const fontFamilies = Object.values(blockLevelFontFamilies).flat();

	if (fontFamilies.length === 0) {
		return null;
	}

	const options = [
		{ value: "", label: __("Default") },
		...fontFamilies.map(({ slug, name }) => {
			return {
				value: slug,
				label: name || slug,
			};
		}),
	];
	return (
		<SelectControl
			label={__("Font")}
			options={options}
			value={value}
			onChange={onChange}
			labelPosition="top"
			{...props}
		/>
	);
}
