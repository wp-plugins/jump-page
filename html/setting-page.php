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

class gxtb_jump_page_spClass {

function gxtb_jump_page_sPage() {
?>

<form method="post" action="options.php">
<div id="poststuff" class="metabox-holder">
<?php 
	//$shortcode = "gxtb"; until [v0.9]
	wp_nonce_field('update-options');
	
	// Check for GB-JP-Version installation with version [1.5]
	define('IS_GB_JP_V15', version_compare(gxtb_jump_page_version, '1.5', '>=') );

	/* We are currently working on another way to save the options like this since version [v0.9] - by gangxtaboii.com*/

	/* Intern */
	$gxtb_jump_page_path = get_option('gxtb_jump_page_path');
	$gxtb_jump_page_text = get_option('gxtb_jump_page_text');
	$gxtb_jump_page_time = get_option('gxtb_jump_page_time');
	$gxtb_jump_page_exli = get_option('gxtb_jump_page_exli');
	$gxtb_jump_page_ads_top = get_option('gxtb_jump_page_ads_top');
	$gxtb_jump_page_ads_bottom = get_option('gxtb_jump_page_ads_bottom');
	
	/* Extern - forthcoming with version [v1.5] -- defined at @[v0.9]*/
	//This works only in GB-JP-Version 1.5 or higher
	if ( IS_GB_JP_V15 == TRUE) {
		$gxtb_jump_page_ext_on = get_option('gxtb_jump_page_ext_on');
		$gxtb_jump_page_ext_path = get_option('gxtb_jump_page_ext_path');
		$gxtb_jump_page_ext_var = get_option('gxtb_jump_page_ext_var');
	}
	
?>  

<div class="wrap">
  <h2><?php echo gxtb_jump_page_name; ?> - Version <?php echo gxtb_jump_page_version; ?></h2>
  
<form method="post">
<div id="poststuff" class="metabox-holder" style="width: 100%;">

		<div class="stuffbox">
        <h3 style="font-family: Georgia,'Times New Roman',Times,serif;"><?php if ( IS_GB_JP_V15 == TRUE) { echo "INTERN - "; } ?><?php _e('Plugin-Settings', 'gb-jump-page') ?> | <a href=#faq><?php _e('Plugin-FAQ', 'gb-jump-page') ?></a> | <a href=#support><?php _e('Support', 'gb_iphone_webapp') ?></a> | <a href=#news>GB-News</a></h3>
        
				<div class="inside">

        <table class="form-table" style="width: 70%;" border="0">
		        <tbody>
           
                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong><?php _e('Path to your Jump-Page', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input type="text" name="gxtb_jump_page_path" value="<?php if (isset($gxtb_jump_page_path)) {echo $gxtb_jump_page_path;} else {echo "";} ?>" size="60"/>
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('Example', 'gb-jump-page') ?>: <?php _e('http://www.yourdomain.com/jump-page/', 'gb-jump-page') ?> <?php _e('or', 'gb-jump-page') ?> <?php _e('http://www.yourblog.com/?page_id=67', 'gb-jump-page') ?><br />
						<b><?php _e('Recommendation', 'gb-jump-page') ?></b>: <?php _e('We recommend to use it like this', 'gb-jump-page') ?> --> <?php _e('http://www.yourblog.com/?page_id=67', 'gb-jump-page') ?></small></td>
                   </tr>

                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong><?php _e('Text of your Jump-Page', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<textarea name="gxtb_jump_page_text" rows="10"/ style="width:100%"><?php if (isset($gxtb_jump_page_text)) {echo $gxtb_jump_page_text;} else {echo "";} ?></textarea>
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('Text for your Jump-Page. It will appear until the visitor is redirected to the requested url.', 'gb-jump-page') ?></small></td>
                   </tr>
				   
                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong><?php _e('Time until the Plugin redirects your Visitors (sec)', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input type="text" name="gxtb_jump_page_time" value="<?php if (isset($gxtb_jump_page_time)) {echo $gxtb_jump_page_time;} else {echo "";} ?>" size="2" maxlength="2"/>
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('Example', 'gb-jump-page') ?>: 5 - <?php _e('they will be redirected within', 'gb-jump-page') ?> 5 <?php _e('seconds', 'gb-jump-page') ?></small></td>
                   </tr>

                    <tr>
                    	<td width="20" rowspan="2" valign="middle"><strong><?php _e('only EXTERNAL Links', 'gb-jump-page') ?>
						<?php if (!IS_GB_JP_V15)
							_e('Available at', 'gb-jump-page') ?> [v1.5]</strong></td>
                        <td width="80%" valign="bottom">
                        	<input <?php if (!IS_GB_JP_V15) { ?>disabled="disabled" <?php } ?> type="checkbox" class="checkbox" name="gxtb_jump_page_exli" <?php if (isset($gxtb_jump_page_exli) && $gxtb_jump_page_exli == "on") echo("checked"); ?> />
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('ENABLE or DISABLE this if you want to use this plugin only for external links or not.', 'gb-jump-page') ?></small></td>
                   </tr>

                    <tr>
                    	<td width="20" rowspan="2" valign="middle"><strong><?php _e('Enable Ads/Information', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input type="checkbox" class="checkbox" name="gxtb_jump_page_ads_on" <?php
                            if (get_option('gxtb_jump_page_ads_on')) echo("checked");?> />
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('ENABLE or DISABLE this if you want to show Ads or other Information on your jump-page', 'gb-jump-page') ?></small></td>
                   </tr>

                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong><?php _e('Top-Information', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<textarea name="gxtb_jump_page_ads_top" rows="10" style="width:100%"/><?php if (isset($gxtb_jump_page_ads_top)) {echo $gxtb_jump_page_ads_top;} else {echo "";} ?></textarea>
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('Information at the top of the page', 'gb-jump-page') ?> - <?php _e('Example', 'gb-jump-page') ?>: <?php _e('Google-Ads', 'gb-jump-page') ?></small></td>
                   </tr>

                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong><?php _e('Bottom-Information', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<textarea name="gxtb_jump_page_ads_bottom" rows="10" style="width:100%"/><?php if (isset($gxtb_jump_page_ads_bottom)) {echo $gxtb_jump_page_ads_bottom;} else {echo "";} ?></textarea>
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('Information at the bottom of the page', 'gb-jump-page') ?> - <?php _e('Example', 'gb-jump-page') ?>: <?php _e('Google-Ads', 'gb-jump-page') ?></small></td>
                   </tr>		
        		</tbody>
		</table>
				</div>

		</div>
<?php		
		//This works only in GB-JP-Version 1.5 or higher
		if ( IS_GB_JP_V15 == TRUE) {
?>
<div class="stuffbox">
        <h3 style="font-family: Georgia,'Times New Roman',Times,serif;">EXTERN - <?php _e('Plugin-Settings', 'gb-jump-page') ?> - <?php _e('working since version', 'gb-jump-page') ?> [v1.5]</h3>
        
				<div class="inside">

        <table class="form-table" style="width: 100%;" border="0">
		        <tbody>
           
                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong>EXTERNAL Jump-Page</strong></td>
                        <td width="80%" valign="bottom">
                        	<input disabled="disabled" type="checkbox" class="checkbox" name="gxtb_jump_page_ext_on" <?php if (isset($gxtb_jump_page_ext_on) && $gxtb_jump_page_ext_on == "on") echo("checked"); ?> />
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('Enable/Disable this if you want to create and design your own external-jump-page.', 'gb-jump-page') ?></small></td>
                   </tr>

                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong><?php _e('external Jump-Page-Url', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input disabled="disabled" type="text" name="gxtb_jump_page_ext_path" value="<?php if (isset($gxtb_jump_page_ext_path)) {echo $gxtb_jump_page_ext_path;} else {echo "";} ?>" size="45" maxlength="60"/>
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('The URl to your Jump-Page.', 'gb-jump-page') ?></small></td>
                   </tr>

                    <tr>
                    	<td width="20%" rowspan="2" valign="middle"><strong><?php _e('URL-Variable (PHP)', 'gb-jump-page') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input disabled="disabled" type="text" name="gxtb_jump_page_ext_var" value="<?php if (isset($gxtb_jump_page_ext_var)) {echo $gxtb_jump_page_ext_var;} else {echo "";} ?>" size="3" maxlength="3"/>
                         </td>
                    </tr>
                    <tr>
                        <td><small><?php _e('You must put the variable in this box for your external page. this variable will send the url for the requested page', 'gb-jump-page') ?></small></td>
                   </tr>
		
        		</tbody>
		</table>
				</div>

</div>
<?php } ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="gxtb_jump_page_path, gxtb_jump_page_text, gxtb_jump_page_time, gxtb_jump_page_exli, gxtb_jump_page_ads_on, gxtb_jump_page_ads_top, gxtb_jump_page_ads_bottom<?php //, gxtb_jump_page_ext_on, gxtb_jump_page_ext_path, gxtb_jump_page_ext_var ?>" />
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>

<div class="stuffbox" style="width: 100%;">
        <h3 style="font-family: Georgia,'Times New Roman',Times,serif;"><a name=faq></a><?php _e('Plugin-FAQ', 'gb-jump-page') ?> [v<?php echo gxtb_jump_page_version; ?>]</h3>
        
			<div class="inside">
					<middle>
                    
					<ol>
					<li><strong><?php _e('Install the Plugin', 'gb-jump-page') ?></strong></li>
					<br>
					<li><strong><?php _e('Go to the Settings-Page and complete all the required information', 'gb-jump-page') ?></strong></li>
					<br>
					<li><strong><?php _e('Now you have to create a Jump-Page for the plugin', 'gb-jump-page') ?></strong></li>
						<ul type="circle">
							<li><?php _e('Create a page and add the following shortcode', 'gb-jump-page') ?>: [jump_page]</li>
						</ul>
					<br>
					<li><strong><?php _e('after that you can use the plugin like this (in posts/pages, etc.)', 'gb-jump-page') ?></strong></li>
						<ul type="circle">
	                        <li><?php _e('Create a new Page/Post and click on the new button in the wysiwyg-editor and then add the required information.', 'gb-jump-page') ?></li>
							<li><?php _e('it will copy sth. like this into your textbox', 'gb-jump-page') ?>: [jump_page url=<?php _e('http://www.example.com', 'gb-jump-page') ?> title=<?php _e('Example-Link', 'gb-jump-page') ?>]</li>
							<li><?php _e('this will show up like this', 'gb-jump-page') ?>: &lt;a href="<?php _e('http://www.example.com', 'gb-jump-page') ?>"&gt;<?php _e('Example-Link', 'gb-jump-page') ?>"&lt;/a&gt;</li>
						</ul>
					<br>
					<li><strong><?php _e('Design', 'gb-jump-page') ?>:</strong>
						<ul type="circle">
							<li><?php _e('You can design your jump-page on your own by adding the following css-class in your css-file', 'gb-jump-page') ?>: css-class="gxtb_jump_page"</li>
						</ul>
					<br>
					<li><strong><?php _e('Notice', 'gb-jump-page') ?>:</strong></li>
						<ul type="circle">
	                        <li><b><?php _e('in order to hide your jump-page properly install the following plugin', 'gb-jump-page') ?></b></li>
							<li><a href="http://wordpress.org/extend/plugins/exclude-pages/" target="_blank">Exclude Pages</a> [Version: 1.8 or higher] by <a href="http://wordpress.org/extend/plugins/profile/simonwheatley" target="_blank">Simon Wheatley</a> | <a href="http://downloads.wordpress.org/plugin/exclude-pages.1.8.zip">Download</a></li>
<?php		
		//This works only in GB-JP-Version 1.5 or higher
		if (!IS_GB_JP_V15) {
?>
	                        <li><?php _e('Intern-Link-Handling and the ability to use and create your own Jump-Page will be available at version', 'gb-jump-page') ?> [v1.5]</li>
<?php } ?>
						</ul>
					</ol>

				</middle>
			</div>
</div>
		
<?php // GB-Newsbox [v1.5.1] -- by gangxtaboii.com

	// GB-NEWS-BOX \\
	global $gxtb_jump_page_active;
	// GB-NEWS-BOX \\

	require_once('gb_newsbox.php');
	$gxtb_NewsClass_iArray = array("name" => gxtb_jump_page_name, "version" => gxtb_jump_page_version);
	$gxtb_NewsClass = new gxtb_NewsClass($gxtb_jump_page_active, 'gb-jump-page', $gxtb_NewsClass_iArray, 'Plugin');
?>
</div></div></div>

<?php
}
}
?>