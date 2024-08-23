# Static assets

This folder contains static assets. They are unlikely to change so they can be cached for a long time.

To enable the ability to cache bust a set of files, each folder is version controlled with a version number. If you need to modify a file, you should instead add a new copy in the latest version folder, or create a new version if the file already exists in that folder.

Example:
When changing the contents of font.woff2
If the folder structure is like this:

v1 > font.woff2, image.png

Make a new folder like so:

v1 > image.png

v2 > font.woff2

If you then wanted to update image.png, you can just move it to v2 folder as it doesn't yet exist there:

v2 > font.woff2, image.png

Be sure to update all file references when changing the version number.
