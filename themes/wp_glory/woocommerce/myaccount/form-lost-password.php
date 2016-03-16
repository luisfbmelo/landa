<?php
/**
 * Lost password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

?>
<div class="col-sm-18">
<?php wc_print_notices();?>
<div class="wd_lost_password">
	<h2 class="wd_lostpw_title"><?php _e('lost password','wpdance');?></h2>
	<form method="post" class="lost_reset_password">

		<?php	if( 'lost_password' == $args['form'] ) : ?>

		<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'wpdance' ) ); ?></p>

		<p class="form-row form-row-first"><label for="user_login"><?php _e( 'Username or email', 'wpdance' ); ?></label> <input class="input-text" type="text" name="user_login" id="user_login" /></p>

		<?php else : ?>

		<p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'wpdance') ); ?></p>

		<p class="form-row form-row-first">
			<label for="password_1"><?php _e( 'New password', 'wpdance' ); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_1" id="password_1" />
		</p>
		<p class="form-row form-row-last">
			<label for="password_2"><?php _e( 'Re-enter new password', 'wpdance' ); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_2" id="password_2" />
		</p>

		<input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
		<input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />
		
		<?php endif; ?>

		<div class="clear"></div>

		<p class="form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<input type="submit" class="button" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'wpdance' ) : __( 'Save', 'wpdance' ); ?>" />
		</p>
		
		<?php wp_nonce_field( $args['form'] ); ?>

	</form>
</div>

</div>

<div class="col-sm-6">
	<?php wd_myaccount_menu_custom();?>
</div>