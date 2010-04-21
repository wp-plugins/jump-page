<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php

wp_nonce_field('update-options');

class gxtb_jump_page_optionen_class
{
	var $jump_page_intern_options = array (
	
		array(	"name" => "Jump-Page-Options",
				"type" => "title"),
				
		array(	"type" => "open"),
		
		array(  "name" => "only EXTERNAL Links?",
				"desc" => "ENABLE or DISABLE this if you want to use this plugin only for external or not.",
				"id" => "gxtb_jump_page_only_ex_li",
				"std" => "false",
				"type" => "checkbox"),
	
		array(	"name" => "Text of your Jump-Page",
				"desc" => "Text for your Jump-Page.",
				"id" => "gxtb_jump_page_text",
				"std" => "",
				"type" => "textarea"),
	
		array(	"type" => "close")
		
	);

function gxtb_jump_page_add_menu() {

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($this->jump_page_intern_options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($this->jump_page_intern_options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($this->jump_page_intern_options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }
}

function gxtb_jump_page_settings() {

	add_action('admin_menu', 'gxtb_jump_page_add_menu');

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'. gxtb_jump_page_name .' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'. gxtb_jump_page_name .' settings reset.</strong></p></div>';
    
?>

<div class="wrap">
  <h2><?php echo gxtb_jump_page_name; ?> Settings - Version <?php echo gxtb_jump_page_version; ?></h2>
  <br clear="all" />

<form method="post">
<div id="poststuff" class="metabox-holder">

<?php foreach ($this->jump_page_intern_options as $value) { 
	switch ($value['type'] ) {
	
		case "open":
		?>
		<div class="inside">
        <table class="form-table" style="width: auto" border="0">
		<?php break;
		
		case "close":
		?>
		
        </table>
		</div>
		</div>
		<br />
        
		<?php break;
		
		case "title":
		?>
		
		<div class="stuffbox">
        <h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3>
		<?php break;

		case 'text':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>
        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr>
		

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:75px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea>
			</td>
            
        </tr>
        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr>		

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr>
	  

		<?php
        break;
            
		case "checkbox":
		?>
			<tr>
			<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
				<td width="80%"><?php if(get_settings($value['id'])){ $checked = "checked"; }else{ $checked = ""; } ?>
						<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" <?php echo $checked; ?> />
						</td>
			</tr>

  
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr>
            
        <?php break;
	
	
		case 'info':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea disabled="disabled" name="<?php echo $value['id']; ?>" style="width:100%; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea>
			</td>
            
        </tr>
        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr>	
		<?php 
		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" / class="button-primary"> 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<input name="reset" type="submit" value="Reset" class="button-primary" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div>
<?php
}
}
?>