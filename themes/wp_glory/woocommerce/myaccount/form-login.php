<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="col-sm-18">

<?php wc_print_notices(); do_action('woocommerce_before_customer_login_form'); ?>
<?php 
if (get_option('woocommerce_enable_myaccount_registration')=== 'yes')
	$action = isset($_REQUEST['action'])? $_REQUEST['action']: 'false';
else $action = 'false';

$register_show = 'col-2';
$login_show = 'col-1';
switch($action) {
	case 'login':
			$login_show = '';
			$register_show = "hide";
			break;
	case 'register':
			$login_show = "hide";
			$register_show = "";
			break;
}
?>
<?php if (get_option('woocommerce_enable_myaccount_registration')=== 'yes') : ?>

<div class="col2-set" id="customer_login">

	<div class="<?php echo esc_attr($login_show);?>">

<?php endif; ?>

		<h2><?php _e( 'Login', 'wpdance' ); ?></h2>
		
		<form method="post" class="login">
			
			<?php do_action( 'woocommerce_login_form_start' ); ?>
			
			<p class="form-row form-row-first">
				<label for="username"><?php _e( 'User or Email', 'wpdance' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php _e( 'Password', 'wpdance' ); ?> <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>
			
			<?php do_action( 'woocommerce_login_form' ); ?>
			
			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'wpdance' ); ?>" />
				<label for="rememberme" class="inline">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'wpdance' ); ?>
				</label>
			</p>
			<p class="lost_password">
				<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'wpdance' ); ?></a>
			</p>
			
			<?php do_action( 'woocommerce_login_form_end' ); ?>
			
		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="<?php echo esc_attr($register_show);?>">

		<h2><?php _e( 'register', 'wpdance' ); ?></h2>
		
		<form method="post" class="register">
			
			<?php do_action( 'woocommerce_register_form_start' ); ?>
			
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php _e( 'username', 'wpdance' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p>

				<p class="form-row form-row-last">

			<?php else : ?>

				<p class="form-row form-row-wide">

			<?php endif; ?>

				<label for="reg_email"><?php _e( 'email', 'wpdance' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</p>		

			<p class="form-row form-row-wide">
				<label for="reg_password"><?php _e( 'password', 'wpdance' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) esc_attr_e( $_POST['password'] ); ?>" />
			</p>

			<div class="clear"></div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'wpdance' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>
			
			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-register' ); ?>
				<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'wpdance' ); ?>" />
			</p>
			
			<?php do_action( 'woocommerce_register_form_end' ); ?>
			
		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>
</div>

<div class="col-sm-6">
	<?php wd_myaccount_menu_custom();?>
</div>