<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_details' ); ?>

	<div id="bbp-single-user-details">
		<div id="bbp-user-avatar">

			<span class='vcard'>
				<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
					<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
				</a>
			</span>

		</div><!-- #author-avatar -->
		<div id="bbp-user-details">
			<div class="author">
				<h3 class="bbp-user-name"><?php echo bbp_get_displayed_user_field( 'display_name' );?></h3>
				<p class="bbp-user-forum-role"><?php echo bbp_get_user_display_role(); ?></p>
			</div>
			<div class="bbp-user-meta">
				<p class="bbp-user-join-date"><?php printf(__('Join Date: %s', 'wpdance'), date("M Y", strtotime(get_userdata(bbp_get_reply_author_id())->user_registered)));?></p>
				<p class="bbp-user-posts"><?php _e('Posts: ', 'wpdance'); bbp_user_post_count();?></p>
				<p class="bbp-user-posts"><?php _e('Blog Entries: ', 'wpdance'); bbp_user_topic_count();?></p>
			</div>
		</div>
	</div><!-- #bbp-single-user-details -->

	<?php do_action( 'bbp_template_after_user_details' ); ?>

<?php
function wd_bbp_user_profile_nav_func(){
	?>
	<div id="bbp-user-navigation" class="tabbable">
		<ul class="wd_tabs nav nav-tabs">
			<li class="<?php if ( bbp_is_single_user_profile() ) :?>active<?php endif; ?>">
				
					<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( esc_attr__( "%s's Profile", 'wpdance' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>" rel="me"><span class="vcard bbp-user-profile-link"><?php _e( 'Profile', 'wpdance' ); ?></span></a>
				
			</li>
			<li class="<?php if ( bbp_is_single_user_topics() ) :?>active<?php endif; ?>">
				
					<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Topics Started", 'wpdance' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class='bbp-user-topics-created-link'><?php _e( 'Topics Started', 'wpdance' ); ?></span></a>
				
			</li>
			<li class="<?php if ( bbp_is_single_user_replies() ) :?>active<?php endif; ?>">
				
					<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Replies Created", 'wpdance' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class='bbp-user-replies-created-link'><?php _e( 'Replies Created', 'wpdance' ); ?></span></a>
				
			</li>

		<?php if ( bbp_is_favorites_active() ) : ?>
			<li class="<?php if ( bbp_is_favorites() ) :?>active<?php endif; ?>">
				
					<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Favorites", 'wpdance' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class="bbp-user-favorites-link"><?php _e( 'Favorites', 'wpdance' ); ?></span></a>
				
			</li>
		<?php endif; ?>

		<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

			<?php if ( bbp_is_subscriptions_active() ) : ?>
			<li class="<?php if ( bbp_is_subscriptions() ) :?>active<?php endif; ?>">
				
					<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Subscriptions", 'wpdance' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class="bbp-user-subscriptions-link"><?php _e( 'Subscriptions', 'wpdance' ); ?></span></a>
				
			</li>
			<?php endif; ?>

			<li class="<?php if ( bbp_is_single_user_edit() ) :?>active<?php endif; ?>">
				
					<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( esc_attr__( "Edit %s's Profile", 'wpdance' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class="bbp-user-edit-link"><?php _e( 'Edit', 'wpdance' ); ?></span></a>
				
			</li>

		<?php endif; ?>

		</ul>
	</div><!-- #bbp-user-navigation -->
	<?php
}

add_action('wd_bbp_user_profile_nav', 'wd_bbp_user_profile_nav_func', 10);
?>