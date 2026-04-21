import type { WPFormatSettings } from "@wordpress/rich-text";
import type { ComponentProps } from "react";
import { SelectControl } from "@wordpress/components";
declare const formatAttributes: {
    class: string;
    style: string;
};
export declare const typography: {
    title: "Typography";
    tagName: "span";
    className: "has-inline-typography";
    attributes: {
        class: string;
        style: string;
    };
    interactive: false;
    edit: typeof Edit;
    name: string;
};
declare function Edit({ isActive, onChange, value, contentRef, }: Parameters<WPFormatSettings<typeof formatAttributes>["edit"]>[0]): import("react/jsx-runtime").JSX.Element;
export declare function FontFamilyControl({ value, onChange, ...props }: {
    value?: string;
    onChange?: (value: string) => void;
} & Omit<ComponentProps<typeof SelectControl>, "value" | "multiple" | "onChange">): import("react/jsx-runtime").JSX.Element | null;
export {};
//# sourceMappingURL=typography.d.ts.map