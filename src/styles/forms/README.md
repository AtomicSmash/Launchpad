# Form styling

Form styling in Launchpad is handled by making the common SCSS file a public API, rather than compiling stylesheets like other styles. This allows you to use the placeholder selectors to style other unsupported form providers more easily. We also do compile stylesheets for our supported form providers which can be used out of the box.

## Supported form providers

1. Gravity forms

Currently we only support Gravity Forms in Launchpad, but this may be extended later.

To get the styling for a supported form provider in your project, simply enqueue the compiled stylesheet in your child theme.

```php
$launchpad_assets = new \Launchpad\Assets();
$gravity_forms_styles = $launchpad_assets->get_cached_asset( '/styles/forms/gravity-forms.scss' );
if ( is_wp_error( $gravity_forms_styles ) ) {
	/**
	 * $gravity_forms_styles is WP_Error
	 *
	 * @var WP_Error $gravity_forms_styles
	 */
	throw new Error( wp_kses_post( $gravity_forms_styles->get_error_message() ) );
}
wp_enqueue_style( 'launchpad-editor-content', $gravity_forms_styles['source'], $gravity_forms_styles['dependencies'], $gravity_forms_styles['version'] );
```

## Adding styles for an unsupported form provider

To add styles to another form provider, you would need to `@use` the 'common' form stylesheet.

TBD Add example and instructions for using scss alias system to load common form styles.

Once you've used this stylesheet, you can then extend any of the placeholder selectors in your own stylesheet

```scss
.text-input {
	@extend %single-line-input;

	&.error {
		@extend %invalid;
	}
}
```

Any placeholder selectors you don't use will be stripped from the output CSS automatically.
