# @atomicsmash/launchpad

## 1.0.0-beta.28

### Minor Changes

- a1cee02: Update footer logos part to use logo banner block

### Patch Changes

- 39b5ad0: Remove postcss context requirement

## 1.0.0-beta.27

### Minor Changes

- 50efaf9: Use no results template part to allow overriding

## 1.0.0-beta.26

### Minor Changes

- 91786d7: Add class to placeholder image

## 1.0.0-beta.25

### Patch Changes

- eeb4c6e: Bugfix styling for old API versions

## 1.0.0-beta.24

### Minor Changes

- be693c5: Add 404 page with CMS editable template
- 391f94a: Adding archives for home and default archive

### Patch Changes

- d605549: Fix issues with not having a WP loop in index template

## 1.0.0-beta.23

### Patch Changes

- 847f6b7: Use same alias name as child projects
- 70bec22: Fix padding in the editor view so blocks aren't on the edge of the screen

## 1.0.0-beta.22

### Patch Changes

- 28896cb: Fix default header bug related to subMenuId

## 1.0.0-beta.21

### Patch Changes

- d0980da: Fix reset styles attempt 2
- 9d1fd2c: Fix broken icon svgs

## 1.0.0-beta.20

### Major Changes

- 4336dd7: Update colour variables to avoid conflict and improve presentation
- fe0eb54: Move sanitisation to blocks plugin

### Patch Changes

- 80f54fe: Add cursor pointer style to button reset styles

## 1.0.0-beta.19

### Minor Changes

- 4861e9f: Add default radius variables
- 4ec82fe: Add theme screenshot
- 4861e9f: Add helper function for getting the featured image with a placeholder image
- 4861e9f: Add default colours to theme.json
- 4861e9f: Add search results template

### Patch Changes

- 4ec82fe: Fixes to the header related to the new navigation block
- 4861e9f: Merge and rename theme options

## 1.0.0-beta.18

### Minor Changes

- 20d242c: Add button reset class

## 1.0.0-beta.17

### Minor Changes

- dfc70e4: Use Launchpad icon set
- 2bf5958: Added site name and override to footer

### Patch Changes

- 4e4bf62: Fix reset styles

## 1.0.0-beta.16

### Major Changes

- 7c98989: Remove icon block plugin

### Minor Changes

- 7c98989: Add icon block and register icon libraries
- 1d1af99: Add PHP icon function

### Patch Changes

- 1d1af99: Fix reset styles for classic theme

## 1.0.0-beta.15

### Major Changes

- 53d1f54: Convert from block theme to classic theme

### Minor Changes

- 72c5a95: Add classic theme header and footer

## 1.0.0-beta.14

### Patch Changes

- 4c7fde8: Add WP Rocket compatibility

## 1.0.0-beta.13

### Major Changes

- 64934fd: Fix spacers and set wp-site-blocks blockgap to zero

## 1.0.0-beta.12

### Patch Changes

- 4816a9c: Add spacers css code correctly

## 1.0.0-beta.11

### Patch Changes

- de4aa26: Minor Launchpad fixes

  1. Adds text based resets like inheriting font styles for elements
  2. Add blog home template
  3. Add default padding to CTA pattern
  4. Update negative spacer meta data to fix the slug and name, and add a different spacer class to it so it can be styled differently.
  5. Copy CSS styles for page spacer from Cloudcall and write styles for negative page spacer.
  6. Set default block gap (space between blocks) to spacing var 2
  7. Fix body background colour conflict with global styles

## 1.0.0-beta.10

### Major Changes

- e5f3a09: Fix launchpad enqueues

### Minor Changes

- 47dc87e: Add get asset from child theme only method

## 1.0.0-beta.9

### Patch Changes

- 7df832e: Update WordPress headers and schemas

## 1.0.0-beta.8

### Patch Changes

- 3d6aac2: Upgrades from Wordpress 6.6 to Wordpress 6.7

## 1.0.0-beta.7

### Major Changes

- 7712165: Remove footer content
- 33986bf: Add new default spacing sizes to theme.json

### Patch Changes

- 74c8644: Minor linting updates

## 1.0.0-beta.6

### Major Changes

- 011fe74: Remove part-card and part-testimonial patterns

### Patch Changes

- 011fe74: Add launchpad category to post card pattern
- 011fe74: Add the ability for the child theme to read parent theme ACF fields

## 1.0.0-beta.5

### Patch Changes

- 3c7de8e: Optimise dependencies in releases

## 1.0.0-beta.4

### Patch Changes

- ee290b4: Fix 3

## 1.0.0-beta.3

### Patch Changes

- 2e37f1c: Fix 2

## 1.0.0-beta.2

### Patch Changes

- 319a5e4: Attempt to fix release process

## 1.0.0-beta.1

### Major Changes

- 16c4cf1: Change assets to return array of information instead of src string
- 16c4cf1: Remove dom ready util, convert to use wp-dom-ready directly
- 16c4cf1: Set the correct CSS manipulation steps for the theme and plugin.
- 1c75e65: Made changes to reset styles
- d92aec6: Update WordPress minimum version
- defd6eb: Remove styles and fonts from theme.json
- 12f0623: Added PSR4 autoloading

### Minor Changes

- be1941e: Added launchpad and spacers block pattern categories
- 37c0ed2: Add typography formatter
- 12f0623: Added ACF lite constant
  Added mailtrap on staging/ local
  Added wp sanitisation allow list
- de263c0: Added global banner block
  Added global banner output block
  Added global banner custom post type
  Added ACF Pro plugin
  Added ACF options for global banner
- 57b4dd2: Added search base template
- 16c4cf1: Add theme icons to icon block library
- 721288d: Split editor-styles.scss into two separate scss files, editor-content and editor-controls
  Adjusted enqueue-assets.php to enqueue these files appropriately
  Adjusted webpack.mix.cjs to correctly compile these files
- 0539613: Added spacer pattern
  Added negative spacer pattern
- dee57b5: Added 404 base template
  Added hidden-404 pattern
- b45dddf: Added archive base template
- 3cbae73: Added fluid typographies
  Updated visual comparison screenshots
- bca069e: Added CTA pattern

### Patch Changes

- 73c8926: Organise functions file into subfiles

## 1.0.0-beta.0

### Major Changes

- d71aa9d: Initial beta release
