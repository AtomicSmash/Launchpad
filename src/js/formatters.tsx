import { registerFormatType } from "@wordpress/rich-text";

import { typography } from "./formatters/typography";

const formats = [typography];

formats.forEach(({ name, ...settings }) => {
	registerFormatType(name, settings);
});
