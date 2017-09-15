<?php

/*
Plugin Name: Client Protection
Plugin URI: https://caporalmktdigital.com.br/plataformas/plugin-client-protection/
Description: Protect the main configuration of your website, keep it simple for clients. One click of effectiveness! 
Version: 1.5
Author: Alexandre Caporal
Author URI: https://caporalmktdigital.com.br/
*/

add_action( 'init', 'cp_updater' );
function cp_updater() {
	include_once 'updater.php';
	define( 'WP_GITHUB_FORCE_UPDATE', true );

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
	$config = array(
		'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
		'proper_folder_name' => 'plugin-name', // this is the name of the folder your plugin lives in
		'api_url' => 'https://api.github.com/repos/caporalmktdigital/client-protection', // the GitHub API url of your GitHub repo
		'raw_url' => 'https://raw.github.com/caporalmktdigital/client-protection/master', // the GitHub raw url of your GitHub repo
		'github_url' => 'https://github.com/caporalmktdigital/client-protection', // the GitHub url of your GitHub repo
		'zip_url' => 'https://github.com/caporalmktdigital/client-protection/zipball/master', // the zip url of the GitHub repo
		'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
		'requires' => '3.0', // which version of WordPress does your plugin require?
		'tested' => '3.3', // which version of WordPress is your plugin tested up to?
		'readme' => 'README.md', // which file to use as the readme for the version number
		'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
	);
	new WP_GitHub_Updater($config);
}

}

/* --------- Remove themes, plugins and WordPress updates ----------- */

function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

/* --------- Remove custom and dangerous plugins menu tabs ----------- */
function agcap_remove_menus () {
    remove_menu_page('plugins.php'); // Plugins
    remove_menu_page('options-general.php'); // Settings
    remove_menu_page('DiviModuleEditor'); // Divi Module Editor
    remove_menu_page('tools.php'); // Tools
    remove_menu_page('et_extra_options'); // Extra Theme Options  
    remove_menu_page('et_divi_options'); // Divi Theme Options   
    remove_menu_page('Plugin_Organizer'); // Plugin Organizer
    remove_menu_page('instant-articles-wizard'); // Facebook Instant Articles
    remove_menu_page('amp-analytics-options'); // AMP analytics
    remove_menu_page('haw-mautic-integration'); // Mautic Integration
    remove_menu_page('wpcf7'); // Contact Form 7
    remove_menu_page('cptui_manage_post_types'); // Custom Post Type
    remove_menu_page('w3tc_dashboard'); // W3 Total Cache
    remove_menu_page('Wordfence'); // Wordfence
    remove_menu_page('loginpress-settings'); // Loginpress
    remove_menu_page('itsec'); // Itheme Security
    remove_menu_page('genesis'); // Genesis Framework
    remove_submenu_page('themes.php', 'themes.php'); // Themes
    remove_submenu_page('themes.php', 'widgets.php'); // Widgets
    remove_submenu_page('plugins.php', 'plugin-editor.php' ); // Editor
    remove_submenu_page('index.php', 'update-core.php' ); // Update
    remove_menu_page( 'WP-Optimize' ); // Wp Optimize
    remove_menu_page( 'wp-seo-schema' ); // Wp Structured Data
    remove_menu_page( 'et_bloom_options' ); // Bloom
    remove_menu_page( 'et_divi_100_options' ); // Divi 100
    remove_menu_page( 'gf_edit_forms' ); // Gravity Forms
    remove_menu_page( 'wpseo_dashboard' ); // Yoast
    remove_menu_page( 'sucuriscan' ); // Sucuri
    remove_menu_page( 'revslider' ); // Revolution Slider
    remove_menu_page( 'amp-analytics-options' ); // Amp Analytics Config
    remove_menu_page( 'wysija_campaigns' ); // Mailpoet config
        remove_submenu_page( 'wysija_config' ); // Mailpoet config
        remove_submenu_page( 'wysija_premium' ); // Mailpoet premium
        remove_submenu_page( 'wysija_mp3' ); // Mailpoet Anuncio
    remove_menu_page('edit.php?post_type=popup'); // Popup Maker
	remove_submenu_page('wc-settings'); // Configurações Woocommerce
    remove_menu_page('caldera-forms'); // Caldera Forms
       global $submenu;
        // Appearance Menu
        unset($submenu['themes.php'][6]); // Customize
}
add_action('admin_menu', 'agcap_remove_menus', 9999);

/*-------- Remove Editor Tab -------*/
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'remove_editor_menu', 1);

?>
