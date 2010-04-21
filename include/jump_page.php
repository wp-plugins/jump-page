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

class gxtb_jump_link_pClass {

function gb_jump_page_function() {

	// get all the options we need
	$gxtb_jump_page_text = get_option('gxtb_jump_page_text');
	$gxtb_jump_page_ads_on = get_option('gxtb_jump_page_ads_on');
	$gxtb_jump_page_ads_top = get_option('gxtb_jump_page_ads_top');
	$gxtb_jump_page_ads_bottom = get_option('gxtb_jump_page_ads_bottom');
	
	$gxtb_jump_page_req_link = $_GET['url'];

	// check if the path of the jump_page is empty
	if($gxtb_jump_page_path == "") {
		$gxtb_jump_page_path = get_bloginfo('wpurl') . "/index.php"; }
	
	// call the function with the main action
	 $this->gb_jump_head_info($gxtb_jump_page_req_link);
	
	// translate-function until [v0.9] - maybe we need it in the future
	// gxtb_jump_page_load_textdomain();
	
	// check if the text is empty
	if ($gxtb_jump_page_text != "") {
		
		// check if ads are enabled
		if($gxtb_jump_page_ads_on == "on") {
			
		$content = ' <p class="gxtb_jump_page">
' . $gxtb_jump_page_ads_top . '
<br><br>
' . $gxtb_jump_page_text . ' - if it does not REDIRECT you to the requested url then <a href="' . $gxtb_jump_page_req_link . '">click here</a>
<br><br>
' . $gxtb_jump_page_ads_bottom . '
</p>';
		}
		else {
		$content = $gxtb_jump_page_text . ' - if it does not redirect you to the requested url then <a href="' . $gxtb_jump_page_req_link . '">click here<a>'; //ANZEIGE DES LINKS GEHT NOCH NICHT EINWANDFREI
}
		
	return $content;
	} else {
		
	return 'Loading... - if it does not redirect you to the requested url then <a href="' . $gxtb_jump_page_req_link . '">click here<a>' . $gxtb_jump_page_ads_on;
	}
}

/* header-functions */
function gb_jump_head_info($gxtb_jump_page_req_link) {

	$gxtb_jump_page_time = get_option('gxtb_jump_page_time');
	$gxtb_jump_page_path = get_option('gxtb_jump_page_path');
	
	if($gxtb_jump_time == "")
		$gxtb_jump_page_time = "5";

	if($gxtb_jump_page_path == "")
		$gxtb_jump_page_path = get_bloginfo('wpurl') . "/index.php";

	if ( is_single() || is_page() ) {

  echo  '
<!-- USING ' . gxtb_jump_page_name . ' [v' . gxtb_jump_page_version . '] | by http://www.gangxtaboii.com -->

<script type="text/javascript">
var counter = ' . $gxtb_jump_page_time . ';
function countdown() {
  if (--counter > 0) {
    window.setTimeout(countdown, 1000);
  } else {
    location.href = "' . $gxtb_jump_page_req_link . '";
  }
}
function startCountdown() {
  window.setTimeout(countdown, 1000);
}
startCountdown();
</script>

<!-- USING ' . gxtb_jump_page_name . ' [v' . gxtb_jump_page_version . '] | by http://www.gangxtaboii.com -->
';

}
}

/* Will add the Code to the header of the page but currently that doesn't work @[v0.8] */
//add_action('wp_head','gb_jump_head_info'); 

function gxtb_jump_link_add_pShortcode() {
	//add_shortcode('jump_page','gb_jump_page_function'); -- until [v0.9]
	add_shortcode('jump_page', array( &$this, 'gb_jump_page_function' ) );
}

}
?>