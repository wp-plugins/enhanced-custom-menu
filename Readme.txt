=== Enhanced Custom Menu ===
Contributors: Jessejd
Donate link: http://www.jessejdyer.com/donate
Tags: WP 3.0, 3.0, Custom Menu, Sub-menu, Submenu, Subpage, Sub-page, Delete Menu Item, 3.0 Fix Delete, Trash Page, Nav Menu, wp_list_pages, Hierarchy, Auto, Automatically.
Requires at least: 3.0
Tested up to: 3.0.1
Stable tag: 0.1.1

This plugin alters the custom menu auto-add function allowing subpages and delete menu item after un-publishing a page.

== Description ==

Enhanced Custom Menu replaces the 'Automatically add new top-level pages' feature of wordpress 3.0 with an enhanced version automatically adding subpages to their respective place in your custom menu's hierarchy. This plug-in allows custom menus in wordpress 3.0 to work like wp_list_pages with the ability to edit the menu from the admin menu editing interface.
This is perfect for those who would like to automatically add subpages to their navigation menu on publish without editing core wordpress files.
Enhanced Custom Menu also updates the delete menu item feature, when a page is changed from publish to draft, review, or moved to the trash, the respective menu item is removed. If the page is later added re-published the menu item will come back.

In 0.1.1 pages that have sub-pages are not removed from the menu if they are changed from published status. This retains the structure of the menu.

Note: You must have custom menus enabled, running wordpress 3.0, and turn on 'Automatically add new top-level pages.'


== Installation ==

1. Upload `WPEnhancedCustMenu.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In the Menus administration page check "Automatically add new top-level pages"

== Frequently Asked Questions ==

= What version of wordpress is required? =

3.0 or later.

== Changelog ==

= 0.1.1 =
* Pages with sub-pages are not removed from menu retaining the menu structure.

= 0.1 =
* Initial Release