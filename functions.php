<?php
/**
 * Functions file
 *
 * This is where you load all functions required by the theme.
 */

namespace Launchpad;

define( 'LAUNCHPAD_THEME_VERSION', '3.0.1' );

// Require autoloader.
require __DIR__ . '/vendor/autoload.php';

// Blocks
require_once __DIR__ . '/functions/blocks/patterns.php';
require_once __DIR__ . '/functions/blocks/styles.php';


// Components
require_once __DIR__ . '/functions/components/chip.php';

// Compatibility
require_once __DIR__ . '/functions/compatibility/wp-rocket.php';

// Other
require_once __DIR__ . '/functions/acf.php';
require_once __DIR__ . '/functions/body-class.php';
require_once __DIR__ . '/functions/content-filters.php';
require_once __DIR__ . '/functions/custom-post-types.php';
require_once __DIR__ . '/functions/enqueue-assets.php';
require_once __DIR__ . '/functions/gravity-forms.php';
require_once __DIR__ . '/functions/helpers.php';
require_once __DIR__ . '/functions/mailtrap.php';
require_once __DIR__ . '/functions/media.php';
require_once __DIR__ . '/functions/roles-and-capabilities.php';
require_once __DIR__ . '/functions/sanitisation.php';
require_once __DIR__ . '/functions/seo.php';
require_once __DIR__ . '/functions/theme-setup.php';
require_once __DIR__ . '/functions/updates.php';
