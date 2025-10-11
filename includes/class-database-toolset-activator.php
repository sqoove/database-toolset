<?php
/**
 * Fired during plugin activation
 *
 * @link https://neoslab.com
 * @since 1.0.0
 *
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
*/

/**
 * Class `Database_Toolset_Activator`
 * This class defines all code necessary to run during the plugin's activation
 * @since 1.0.0
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
 * @author NeosLab <contact@neoslab.com>
*/
class Database_Toolset_Activator
{
	/**
	 * Activate plugin
	 * @since 1.0.0
	*/
	public static function activate()
	{
		$option = add_option('_database_toolset', false);
	}
}

?>