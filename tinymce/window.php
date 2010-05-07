<?php
/*
+----------------------------------------------------------------+
+	Jump-Page - Tinymce-Button [v1.4.5]
+	by Stefan Natter (http://www.gangxtaboii.com)
+   required for Jump-Page and WordPress 2.5.x or higher
+----------------------------------------------------------------+
*/

// look up for the path
require_once( dirname( dirname(__FILE__) ) .'/gb_jump-page-config.php');

global $wpdb;

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here", 'gp-jump-page'));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>JUMP-PAGE-LINK</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript">
	function init() {
		tinyMCEPopup.resizeToInnerSize();
	}
	
	function insert_gbLinks() {
		
		var tagtext;
		var rss = document.getElementById('rss_panel');
		
		// who is active ?
		if (rss.className.indexOf('current') != -1) {
			var gb_url_txt = document.getElementById('gb_url').value;
			var gb_title_txt = document.getElementById('gb_title').value;
				
			if (gb_url_txt != '' && gb_title_txt != '')
				tagtext = "[jump_link url=" + gb_url_txt + " title=" + gb_title_txt + "]";
			else
				tinyMCEPopup.close();
		}
	
		
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
			//Peforms a clean up of the current editor HTML. 
			//tinyMCEPopup.editor.execCommand('mceCleanup');
			//Repaints the editor. Sometimes the browser has graphic glitches. 
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
	<base target="_self" />
    
<?php gxtb_jump_page_load_textdomain(); ?>
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('rsstag').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="gb_jump_page_form" action="#">
	<div class="tabs">
		<ul>
			<li id="rss_tab" class="current"><span><a href="javascript:mcTabs.displayTab('rss_tab','rss_panel');" onmousedown="return false;"><?php _e("URL-Settings", 'gb-jump-page'); ?></a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper">
		<!-- rss panel -->
		<div id="rss_panel" class="panel current">
		<br />
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="rsstag"><?php _e("Enter the url here:", 'gb-jump-page'); ?></label></td>
            <td><input type="text" id="gb_url" name="gb_url" style="width: 190px" /></td>
          </tr>
		  </tr>
            <td nowrap="nowrap"><label for="rsstag"><?php _e("Enter the title here:", 'gb-jump-page'); ?></label></td>
            <td><input type="text" id="gb_title" name="gb_title" style="width: 190px" /></td>
          </tr>
		  </tr>
            <td nowrap="nowrap" colspan="3"><label for="rsstag"><?php _e("Example", 'gb-jump-page'); ?>:<br /><?php _e("url = http://www.example.com", 'gb-jump-page'); ?><br /><?php _e("title = Example-Link", 'gb-jump-page'); ?></label></td>
          </tr>
        </table>
		</div>
		<!-- end rss panel -->
		
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'gb-jump-page'); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'gb-jump-page'); ?>" onclick="insert_gbLinks();" />
		</div>
	</div>
</form>
</body>
</html>
<?php

?>
