<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link https://neoslab.com
 * @since 1.0.0
 *
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
*/

/**
 * Class `Database_Toolset_i18n`
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 * @since 1.0.0
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
 * @author NeosLab <contact@neoslab.com>
*/
class Database_Toolset_i18n
{
	/**
	 * Load the plugin text domain for translation
	 * @since 1.0.0
	*/
	public function load_plugin_textdomain()
	{
		load_plugin_textdomain('database-toolset', false, dirname(dirname(plugin_basename(__FILE__))).'/languages/');
	}
}

?>