<?php
/**
 * @package WordPress
 * @subpackage WP Woo Glory
 * @since wd_glory
 **/

$_template_path = get_template_directory();
require_once $_template_path."/framework/abstract.php";
$theme = new WdTheme(array(
	'theme_name'	=>	"WP Woo Glory",
	'theme_slug'	=>	'wd_glory'
));
$theme->init();
require_once ('admin/index.php');

/*$wp_roles = new WP_Roles();
$wp_roles->remove_role("bbp_keymaster");
$wp_roles->remove_role("bbp_participant");
$wp_roles->remove_role("bbp_moderator");
$wp_roles->remove_role("bbp_spectator");
$wp_roles->remove_role("bbp_blocked");*/
?>