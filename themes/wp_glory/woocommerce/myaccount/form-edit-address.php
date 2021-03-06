<?php
/**
 * Edit address form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $current_user;

$page_title = ( $load_address == 'billing' ) ? __( 'Billing Address', 'wpdance' ) : __( 'Shipping Address', 'wpdance' );

get_currentuserinfo();
?>
<div class="col-sm-18">

<?php wc_print_notices();?>

<?php if (!$load_address) : ?>

	<?php wc_get_template('myaccount/my-address.php'); ?>

<?php else : ?>
	<div class="wd_edit_address">
		<h2 class="wd_address_title"><?php _e('edit address','wpdance'); ?></h2>
		<form method="post">

			<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>

			<?php foreach ( $address as $key => $field ) : ?>

				<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

			<?php endforeach; ?>

			<p>
				<input type="submit" class="button" name="save_address" value="<?php _e( 'Save Address', 'wpdance' ); ?>" />
				<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>

		</form>
	</div>
<?php endif; ?>

</div>

<div class="col-sm-6">
	<?php wd_myaccount_menu_custom();?>
</div>