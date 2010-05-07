<?php
/*
	Plugin Name: Jump-Page
	Plugin URI: http://www.gangxtaboii.com/jump-page/
	Description: Adds a Shortcode [jump_link] which directs all external links to a Jump-Page [jump_page] where you can put adds, news, banner, informatin and other things before your visitors will be directed to their requested page.
	Version: 1.4.5
	Author: Stefan Natter
	Author URI: http://www.gangxtaboii.com
	Update Server: http://wordpress.org/extend/plugins/jump-page
	Min WP Version: 2.5.x
	Max WP Version: 2.9.x
*/

/* Copyright (C) 2010 Stefan Natter (http://www.gangxtaboii.com)

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

<http://www.gnu.org/licenses/>.
http://www.gnu.org/licenses/gpl.txt
*/


/* -NOTICE- Some things are still in GERMAN -NOTICE-

-gangxtaboii.com-DEV-NOTICE-
all our functions are available at all levels in wp - except they are in classes. other plugins could possibly use your functions. but we recommend to do not
use them because all of them were just written for our own several plugins and they will properly do not work as they should work
if you use it in combination with your own plugins/themes.
-gangxtaboii.com-DEV-NOTICE-


some important pages for you guys:
http://sudarmuthu.com/wordpress/wp-readme
http://wordpress.org/extend/plugins/about/validator/
*/

// GB-News-BOX \\
$gxtb_jump_page_active = "on";
// GB-News-BOX \\

$gxtb_jump_page_shortcode = "gxtb_jump_page";

// version definition
define( $gxtb_jump_page_shortcode . '_version', "1.4.5" );
define( $gxtb_jump_page_shortcode . '_name', "Jump-Page" );
define( $gxtb_jump_page_shortcode . '_shortcode', "gxtb" );

// settings-page:
add_action('admin_menu', 'gxtb_jump_page_menu');
function gxtb_jump_page_menu() {
  add_options_page(__( 'Jump-Page', 'jump-page-settings' ), 'Jump-Page', 10, 'jump-page-settings', 'gxtb_jump_page_options');
}

// lang-definiton:  
function gxtb_jump_page_load_textdomain() {
		
	// Load up the localization file if we're using WordPress in a different language
	// Place it in this plugin's "lang" folder and name it "gb-jump-page-[value in wp-config].mo"
	load_plugin_textdomain( 'gb-jump-page', FALSE, plugin_basename( dirname(__FILE__) ).'/lang' );
	
	/* Notice from the gb-dev-team:
	Examples for language-translating:
	(German):  http://www.texto.de/wordpress-theme-lokalisieren-sprachdatei-erstellen-schritt-fuer-schritt-anleitung-553/
	(English): http://weblogtoolscollection.com/archives/2007/08/27/localizing-a-wordpress-plugin-using-poedit/
	(English): http://www.lost-in-code.com/platforms/wordpress/wordpress-translate-a-plugin/	*/
}


// settings-page-content:
function gxtb_jump_page_options() {

	gxtb_jump_page_load_textdomain();

  	echo '<div class="wrap">';
  	require_once( 'html/setting-page.php' );
  
	/* working with classes since version [v1.0] - setting-page_v2.php is still broken and not up-to-date. @[v1.0] */
	$gxtb_jump_page_spClass = new gxtb_jump_page_spClass();
	//call function
	$gxtb_jump_page_spClass -> gxtb_jump_page_sPage();
}

// Plugin-Button:
function gxtb_jump_page_filter_plugin_meta($links, $file) {

    /* create link */
    if ( $file == FB_BASENAME ) {
        array_unshift(
            $links,
            sprintf( '<a href="options-general.php?page=%s">%s</a>', FB_FILENAME, __('Settings') )
        );
    }

    return $links;
}

add_filter( 'plugin_action_links', 'gxtb_jump_page_filter_plugin_meta', 10, 2 );

//Plugin-Action:
require_once( 'include/jump_link.php' );
require_once( 'include/jump_page.php' );

/* working with classes since version [v1.0]
call the action-classes: */
$gxtb_jump_link_lClass = new gxtb_jump_link_lClass();
$gxtb_jump_link_lClass -> gxtb_jump_link_add_lShortcode();

$gxtb_jump_link_pClass = new gxtb_jump_link_pClass();
$gxtb_jump_link_pClass -> gxtb_jump_link_add_pShortcode();


// Editor-Button
class gxtb_jump_page_button {

	function gxtb_jump_page_button() {
		global $wp_version;
		
		// Check for WP2.5 installation
		if (!defined ('IS_WP25'))
			define('IS_WP25', version_compare($wp_version, '2.5', '>=') );
		
		//This works only in WP2.5 or higher
		if ( IS_WP25 == FALSE) {
			add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . __('Sorry, Jump-Page works only under WordPress 2.5 or higher',"gb-jump-page") . '</strong></p></div>\';'));
			return;
		}
		
		// define URL
		define('gb_jump_page_ABSPATH', WP_PLUGIN_DIR.'/'.plugin_basename( dirname(__FILE__) ).'/' );
		define('gb_jump_page_URLPATH', WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' );
		
		include_once (dirname (__FILE__)."/tinymce/tinymce.php");
	}

}
// Start this plugin once all other plugins are fully loaded
add_action( 'plugins_loaded', create_function( '', 'global $gxtb_jump_page_button; $gxtb_jump_page_button = new gxtb_jump_page_button();' ) );


/*
Examples and Tutorial-Pages

I found some Tutorial-Pages and I hope they will help you as they did to me.

http://tinymce.moxiecode.com/examples/example_18.php 
http://deannaschneider.wordpress.com/2008/10/05/tinymce-custom-buttons-shortcode-example/
http://www.lancelhoff.com/customizing-the-wordpress-wysiwyg-tinymce-visual-editor/
http://www.zartgesotten.de/add-custom-button-to-tinymce-editor/?lang=en

yours,
GangXtaBoii
*/
?>