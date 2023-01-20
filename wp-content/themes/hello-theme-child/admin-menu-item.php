<?php

function add_admin_menu_link($items, $args) {

	if(is_user_logged_in() && has_nav_menu('menu-1')) {

		$new_link = array();

		$item = array( // Create a nav_menu_item object to hold the link
			'title'            => 'Admin',
			'menu_item_parent' => 0,
			'ID'               => 'admin_url',
			'db_id'            => '',
			'url'              => admin_url(),
			'xfn'			   => '',
			'target'		   => '',
			'current'		   => ''
		);

		$new_link[] = (object) $item;  // Add the new menu item to the array
		unset($item);
		$index = count($items) - 1;  // Insert before the last item
		array_splice($items, $index, 0, $new_link); // Insert the new link at the appropriate place

	}

    return $items;
}
add_filter('wp_nav_menu_objects', 'add_admin_menu_link', 10, 2);