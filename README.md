Recent Posts with Thumbnail
===========================

This is a simple WordPress plugin that creates a recent posts widget that displays the post thumbnail and, optionally, the post title and date. You can select the number of posts to display and choose to hide or show the title and date.

Very little styling has been applied so that the theme designer, developer or use can easily customize the appearance.


Installation
------------
To install, download the plugins zip file. Within your WordPress admin, navigation to Plugins > Add New and click "Upload." Browse to the zip file and upload it, then click to activate it.

You'll then see a new widget in your Appearance > Widgets screen. Add the widget to your sidebar and configure and style as desired.


Using the Shortcode
----------------
In the editor, you can use the shortcode like this:
    [neatly_recent]

In a theme, you can use it like this:
    <?php echo do_shortcode('[neatly_recent]'); ?>

There are a few options/ attributes you can choose to modify:

*Title Text*
The default title for the recent posts block is "Recent Posts" but you can change it by defining `title_text=` within the shortcode (any string will do), e.g.:
    [neatly_recent title_text="Newest Content"]
    
*Number of Posts*
By default, the shortcode shows the 3 most recent posts. You can set a different number like so:
    [neatly_recent number_posts="5"]

*Hide Title and/or Date*
Sometimes you just want to go minimal. In that case, you can hide the title and/or the date:
    [neatly_recent hide_title="true" hide_date="true"]

*Thumbnail Size*
Finally, you can select the size of thumbnail to display. Valid values include "medium," "large," "full," and any custom images sizes registered with `add_image_size()` - "thumbnail" is also valid, but it's the default so no need to declare it. E.g.:
    [neatly_recent thumb_size="medium"]
    [neatly_recent thumb_size="custom-size"]


Changelog
------------
* 0.3 Added shortcode and thumb size options
* 0.2 Added ability to show/hide titles and dates
* 0.1 Initial build