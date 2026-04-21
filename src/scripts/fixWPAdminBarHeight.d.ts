export declare class FixWPAdminBarHeight {
    wpBarIsGone: boolean;
    debounceResizeTimeout: undefined | ReturnType<typeof setTimeout>;
    shouldSetVariable: boolean;
    constructor();
    _attachListeners(): void;
    _setShouldSetVariable(): void;
    _getWPAdminBarHeight(): number;
    _setWPAdminBarHeight(height: number): void;
}
//# sourceMappingURL=fixWPAdminBarHeight.d.ts.map