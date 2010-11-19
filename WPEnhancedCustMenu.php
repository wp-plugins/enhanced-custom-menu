<?php
/*
Plugin Name: Enhanced Custom Menu
Description: Automatically add sub-pages to Wordpress 3.0 custom menu management.
Version: 0.1.1
Author: Jesse Dyer
License: GPL2

 Copyright 2010 Jesse Dyer  (email : jessejdyer@ymail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Automatically add newly published page objects to menus with that as an option. - Modified
 *
 * @since 3.0.0
 * @access private
 *
 * @param string $new_status The new status of the post object.
 * @param string $old_status The old status of the post object.
 * @param object $post The post object being transitioned from one status to another.
 * @return void
 */
 
 
function _wp_auto_add_pages_to_menu_all_level( $new_status, $old_status, $post ) {
	global $wpdb;
	
	if ( 'publish' != $new_status /*|| 'publish' == $old_status*/ || 'page' != $post->post_type )
		return;
	$auto_add = get_option( 'nav_menu_options' );
	if ( empty( $auto_add ) || ! is_array( $auto_add ) || ! isset( $auto_add['auto_add'] ) )
		return;
	$auto_add = $auto_add['auto_add'];
	if ( empty( $auto_add ) || ! is_array( $auto_add ) )
		return;
	if ( ! empty( $post->post_parent ) )
		{
			$mi_parent = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_menu_item_object_id' AND meta_value = ". $post->post_parent .";"));
		}

	$args = array(
		'menu-item-object-id' => $post->ID,
		'menu-item-object' => $post->post_type,
		'menu-item-type' => 'post_type',
		'menu-item-status' => 'publish',
		'menu-item-parent-id' => $mi_parent
	);
	foreach ( $auto_add as $menu_id ) {
		$items = wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'publish,draft' ) );
		if ( ! is_array( $items ) )
			continue;
		foreach ( $items as $item ) {
			if ( $post->ID == $item->object_id )
				continue 2;
		}
		wp_update_nav_menu_item( $menu_id, 0, $args );
	}
}

function _wp_auto_delete_menu_item_fix( $new_status, $old_status, $post ) {
	global $wpdb;
	if ( 'publish' == $new_status || 'page' != $post->post_type )
		return;
	$children = get_pages('child_of='.$post->ID);
	if( count( $children ) != 0 ) 
    	return;    
	_wp_delete_post_menu_item($post->ID);
}


remove_action('transition_post_status','_wp_auto_add_pages_to_menu', 1, 3);
add_action('transition_post_status', '_wp_auto_add_pages_to_menu_all_level', 1, 3);
add_action('transition_post_status', '_wp_auto_delete_menu_item_fix', 10, 3)
?>