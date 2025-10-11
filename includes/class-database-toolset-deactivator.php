<?php
/**
 * Fired during plugin deactivation
 *
 * @link https://neoslab.com
 * @since 1.0.0
 *
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
*/

/**
 * Class `Database_Toolset_Deactivator`
 * This class defines all code necessary to run during the plugin's deactivation
 * @since 1.0.0
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
 * @author NeosLab <contact@neoslab.com>
*/
class Database_Toolset_Deactivator
{
	/**
	 * Deactivate plugin
	 * @since 1.0.0
	*/
	public static function deactivate()
	{
		$option = delete_option('_database_toolset');
		if(wp_next_scheduled('database_toolset_backup'))
		{
			wp_clear_scheduled_hook('database_toolset_backup');
		}
	}
}

?>