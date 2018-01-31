<?php
/*
Plugin Name: Header & footer scripts manager  
Plugin URI: http://tereshchuk.ru/en/wp-plugins/header
Description: Header & footer scripts manager plugin allows to add and update css and js files or codes in the  header and footer of your website.
Version: 1.0
Author: Denis Tereshchuk
Author URI: http://tereshchuk.ru
*/
/*  Copyright 2018  Denis Tereshchuk  (email: d.tereshchuk@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Menu_option
function den_hfsm_menu_option() {
    // Adding menu page
    add_menu_page('Header & footer', 'Header & footer', 'manage_options', 'den_hfsm_updating', 'den_hfsm_updating', plugins_url( 'header_footer_scripts_manager/images/icon16.png' ), 200);
}
add_action('admin_menu', 'den_hfsm_menu_option');

// Adding and updating data in admin panel
function den_hfsm_updating() {

    // Action after submiting form
    if (array_key_exists('submit', $_POST)) {

		$field1 = stripslashes($_POST['field1']);
		$field2 = stripslashes($_POST['field2']);

        // Update database with data
        update_option('field1', $field1);
        update_option('field2', $field2);

        // Success message
        echo "<div style='padding:5px; background-color:#4ccf59; color:#fff;'><strong>Setting have been saved!</strong></div>";
    }

    // Get data from database
    $field1 = get_option('field1', 'none');
    $field2 = get_option('field2', 'none');

    echo "<div>";
    echo "<h1>Header & footer scripts manager</h1>";
    echo "</div>";

    echo "<form method='post' action=''>";
        echo "<h2>Header section</h2>";
        echo "<textarea name='field1' class='large-text' style='height:350px;'>".$field1."</textarea>";

        echo "<h2>Footer section</h2>";
        echo "<textarea name='field2' class='large-text' style='height:350px;'>".$field2."</textarea>";

        echo "<input type='submit' name='submit' value='Update' class='button button-primary'>";

    echo "</form>";
}

// Display field1
function display_simple_text_adding1() {
    $field1 = get_option('field1', 'none');
    print $field1;
}
// Hook for wp_head that's triggered within the <head></head>
add_action('wp_head', 'display_simple_text_adding1');

// Display field2
function display_simple_text_adding2() {
    $field2 = get_option('field2', 'none');
    print $field2;
}
// Hook for wp_head that's triggered before </body> tag
add_action('wp_footer', 'display_simple_text_adding2');