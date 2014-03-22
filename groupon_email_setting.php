<?php
/*
Plugin Name: Groupon Email Settings
Plugin URI: #
Description: Groupon email content editor
Version: 1.0
Author: Rahul kamble , Nishant Vaity , Dominic Fernandes
Author URI: #
License: GPL2
*/

add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_menu_page( 'Groupon Redumption Email Settings', 'Groupon Redumption', 'manage_options', 'groupon-email-settings', 'my_plugin_options' , plugins_url( 'groupon_email_setting/groupon.png' ));
}

function my_plugin_options() {
	if (!current_user_can( 'manage_options'))  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$hidden_field_name = 'mt_submit_hidden';
	$opt_email_senders_name = 'groupon_email_senders_name';
	$opt_email_senders_email = 'groupon_email_senders_email';
	$opt_email_subject = 'groupon_email_subject';
	$opt_email_body = 'groupon_email_body';
	if(get_option($opt_email_senders_name) == NULL)
	{
		add_option( $opt_email_senders_name, '' );
	}
	if(get_option($opt_email_senders_email) == NULL)
	{
		add_option( $opt_email_senders_email, '' );
	}
	if(get_option($opt_email_subject) == NULL)
	{
		add_option( $opt_email_subject, '' );
	}
	if(get_option($opt_email_body) == NULL)
	{
		add_option( $opt_email_body, '' );
	}
    if( isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y' )
	{
		$frm_email_senders_name = $_POST['frm_email_senders_name'];
		$frm_email_senders_email = $_POST['frm_email_senders_email'];
		$frm_email_subject = $_POST['frm_email_subject'];
		$frm_email_body = $_POST['frm_email_body'];
		update_option( $opt_email_senders_name, $frm_email_senders_name );
		update_option( $opt_email_senders_email, $frm_email_senders_email );
		update_option( $opt_email_subject, $frm_email_subject );
		update_option( $opt_email_body, $frm_email_body );

	?>
	<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>
<?php
	}

	$val_email_senders_name = get_option($opt_email_senders_name);
	$val_email_senders_email = get_option($opt_email_senders_email);
	$val_email_subject = get_option($opt_email_subject);
	$val_email_body = get_option($opt_email_body);	

    echo '<div class="wrap">';
    echo "<h2>" . __( '<img src="'. plugins_url( 'groupon_email_setting/groupon-logo.png' ) . '" width="50" height="50" style="float:left;">Groupon Redumption - Email Settings', 'groupon-settings' ) . "</h2><div style='clear:both;'></div>";
    ?>
	<form name="form1" method="post" action="">
	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
	<hr />
	
	<p>
	<?php _e("Sender Name:", 'email-sender-name' ); ?> 
	<br />
	<input type="text" name="frm_email_senders_name" value="<?php echo $val_email_senders_name; ?>" size="20">
	</p>
	
	<p>
	<?php _e("Sender Email:", 'email-sender-email' ); ?> 
	<br />
	<input type="text" name="frm_email_senders_email" value="<?php echo $val_email_senders_email; ?>" size="20">
	</p>
	
	<p>
	<?php _e("Subject:", 'email-subject' ); ?> 
	<br />
	<input type="text" name="frm_email_subject" value="<?php echo $val_email_subject; ?>" size="20">
	</p>
	
	<p>
	<?php _e("Subject:", 'email-subject' ); ?> 
	<br />
	<textarea name="frm_email_body" id="register_email_body" cols="200" rows="20"><?php echo stripslashes_deep($val_email_body); ?></textarea>
	</p>
	
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
	</p>
	</form>
	</div>
<?php
	}
?>
