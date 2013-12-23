=== Recent Posts with Thumbnail ===
Contributors: zoerooney
Tags: categories, widget
Requires at least: 3.0
Tested up to: 3.5.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a select number of recent posts with thumbnail and, optionally, post title and date via widget or shortcode. Optionally restrict the posts displayed to a particular category.

== Description ==

This is a simple WordPress plugin that creates a recent posts widget that displays the post thumbnail and, optionally, the post title and date, and "read more" text. You can select the number of posts to display and choose to hide or show the title and date.

Very little styling has been applied so that the theme designer, developer or use can easily customize the appearance.

== Installation ==

1. Download the plugins zip file
1. Within your WordPress admin, navigate to Plugins > Add New and click "Upload."
1. Browse to the zip file and upload it, then click to activate it.

OR

1. Install by searching for the plugin in the repository

You'll then see a new widget in your Appearance > Widgets screen. Add the widget to your sidebar and configure and style as desired.

= Shortcode Implementation =

In the editor, you can use the shortcode like this:

    `[neatly_recent]`

In a theme, you can use it like this:

    `<?php echo do_shortcode('[neatly_recent]'); ?>`

There are a few options/ attributes you can choose to modify:

**Title Text**

The default title for the recent posts block is "Recent Posts" but you can change it by defining `title_text=` within the shortcode (any string will do), e.g.:

    `[neatly_recent title_text="Newest Content"]`
    
**Number of Posts**

By default, the shortcode shows the 3 most recent posts. You can set a different number like so:

    `[neatly_recent number_posts="5"]`

**Hide Title and/or Date**

Sometimes you just want to go minimal. In that case, you can hide the title and/or the date:

    `[neatly_recent hide_title="true" hide_date="true"]`

**Hide Read More Text**

You also have the option of hiding the "read more" text that accompanies each post.

    [neatly_recent hide_read_more="true"]

**Thumbnail Size**

Finally, you can select the size of thumbnail to display. Valid values include "medium," "large," "full," and any custom images sizes registered with `add_image_size()` - "thumbnail" is also valid, but it's the default so no need to declare it. E.g.:

    `[neatly_recent thumb_size="medium"]`


== Frequently Asked Questions ==

= How can I display the recent posts in a page or post? =

Using the shortcode [neatly_recent] - see the Installation tab for detailed instructions/ options.

= What about using it in a template? =

You can do that with the shortcode, too, like so: `<?php echo do_shortcode('[neatly_recent]'); ?>`

== Screenshots ==

1. The widget options display
2. With a bit of styling, it could look like this on the front end

== Changelog ==

= 0.6 =
* Added ability to filter by category

= 0.5 =
* Added read more text option

= 0.4 =
* Fixed syntax error (hat tip [@clintonwilmott](http://twitter.com/clintonwilmott))

= 0.3 =
* Added shortcode and thumb size options

= 0.2 =
* Added ability to show/hide titles and dates

= 0.1 =
* Initial build

== Upgrade Notice ==

No upgrades needed.