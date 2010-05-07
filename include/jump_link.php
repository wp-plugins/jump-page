<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Jump-Page [v1.4.5]
+	by Stefan Natter (http://www.gangxtaboii.com)
+   required for Jump-Page and WordPress 2.5.x or higher
+----------------------------------------------------------------+
*/

class gxtb_jump_link_lClass {
	
function jump_link_function($atts) {
	
	// gets the shortcode-information [v1.0]
	extract(shortcode_atts(array(
	'url' => $_SERVER['SERVER_NAME'],
	'title' => gxtb_jump_page_name
	), $atts));
	
	// Currently there are no sessions used @[v1.0]
	//session_start();
	//$_SESSION['gb_url'] = esc_attr($url);
	//$SessionID = session_id();

	// Get the Path of the ref-page
	$gxtb_jump_page_path = get_option('gxtb_jump_page_path');

	// creates the js-function for extern-link-handling [v1.0]
	echo '<script type="text/javascript">
	function open_jump_page() {
	location.href = "' . $gxtb_jump_page_path . '&url=' . esc_attr($url) . '";
	}
	</script>';
	
	// inserts the link (externlink-handling) [v1.0]
	if(!strstr(esc_attr($url), $_SERVER['SERVER_NAME'])) {
	return '<a href="#" onClick="javascript:open_jump_page()">' . esc_attr($title) . '</a>';
	} else { 
	// Intern-Links 
	//$url = $_SERVER['SERVER_NAME']; used until @[1.0]
	return "<a href='" . esc_attr($url)  . "'>" . esc_attr($title) . "</a>";
	}
}

function gxtb_jump_link_add_lShortcode() {
	add_shortcode('jump_link', array( &$this, 'jump_link_function' ) );
}

}
?>