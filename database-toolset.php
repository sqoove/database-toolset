<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link https://sqoove.com
 * @since 1.0.0
 * @package Database_Toolset
 *
 * @wordpress-plugin
 * Plugin Name: Database Toolset
 * Plugin URI: https://wordpress.org/plugins/database-toolset/
 * Description: Database Toolset can help you to keep your database clean by deleting all unneeded entries such as "transient", "revision", "auto draft" and more.
 * Version: 1.8.4
 * Author: Sqoove
 * Author URI: https://sqoove.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: database-toolset
 * Domain Path: /languages
*/

/**
 * If this file is called directly, then abort
*/
if(!defined('WPINC'))
{
	die;
}

/**
 * Currently plugin version
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions
*/
define('DATABASE_TOOLSET_VERSION', '1.8.4');

/**
 * The code that runs during plugin activation
 * This action is documented in includes/class-database-toolset-activator.php
*/
function activate_database_toolset()
{
	require_once plugin_dir_path(__FILE__).'includes/class-database-toolset-activator.php';
	Database_Toolset_Activator::activate();
}

/**
 * The code that runs during plugin deactivation
 * This action is documented in includes/class-database-toolset-deactivator.php
*/
function deactivate_database_toolset()
{
	require_once plugin_dir_path(__FILE__).'includes/class-database-toolset-deactivator.php';
	Database_Toolset_Deactivator::deactivate();
}

/**
 * Activation/deactivation hook
*/
register_activation_hook(__FILE__, 'activate_database_toolset');
register_deactivation_hook(__FILE__, 'deactivate_database_toolset');

/**
 * The core plugin class that is used to define internationalization and admin-specific hooks
*/
require plugin_dir_path(__FILE__).'includes/class-database-toolset-core.php';

/**
 * Begins execution of the plugin
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle
 * @since 1.0.0
*/
function run_database_toolset()
{
	$plugin = new Database_Toolset();
	$plugin->run();
}

/**
 * Run plugin
*/
run_database_toolset();

?>