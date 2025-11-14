<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across the admin area
 *
 * @link https://sqoove.com
 * @since 1.0.0
 *
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
*/

/**
 * class `Database_Toolset`
 * @since 1.0.0
 * @package Database_Toolset
 * @subpackage Database_Toolset/includes
 * @author Sqoove <support@sqoove.com>
*/
class Database_Toolset
{
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power the plugin
	 * @since 1.0.0
	 * @access protected
	 * @var Database_Toolset_Loader $loader maintains and registers all hooks for the plugin
	*/
	protected $loader;

	/**
	 * The unique identifier of this plugin
	 * @since 1.0.0
	 * @access protected
	 * @var string $pluginName the string used to uniquely identify this plugin
	*/
	protected $pluginName;

	/**
	 * The current version of the plugin
	 * @since 1.0.0
	 * @access protected
	 * @var string $version the current version of the plugin
	*/
	protected $version;

	/**
	 * Define the core functionality of the plugin
	 * @since 1.0.0
	*/
	public function __construct()
	{
		if(defined('DATABASE_TOOLSET_VERSION'))
		{
			$this->version = DATABASE_TOOLSET_VERSION;
		}
		else
		{
			$this->version = '1.0.0';
		}

		$this->pluginName = 'database-toolset';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
	}

	/**
	 * Load the required dependencies for this plugin
	 * @since 1.0.0
	 * @access private
	*/
	private function load_dependencies()
	{
		/**
		 * The class responsible for orchestrating the actions and filters of the core plugin
		*/
		require_once plugin_dir_path(dirname(__FILE__)).'includes/class-database-toolset-loader.php';

		/**
		 * The class responsible for defining internationalization functionality of the plugin
		*/
		require_once plugin_dir_path(dirname(__FILE__)).'includes/class-database-toolset-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area
		*/
		require_once plugin_dir_path(dirname(__FILE__)).'admin/class-database-toolset-admin.php';

		/**
		 * Loader
		*/
		$this->loader = new Database_Toolset_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization
	 * @since 1.0.0
	 * @access private
	*/
	private function set_locale()
	{
		$pluginI18n = new Database_Toolset_i18n();
		$this->loader->add_action('plugins_loaded', $pluginI18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality of the plugin
	 * @since 1.0.0
	 * @access private
	*/
	private function define_admin_hooks()
	{
		$pluginAdmin = new Database_Toolset_Admin($this->get_pluginName(), $this->get_version());
		$allowed = array('database-toolset-admin', 'database-toolset-cleanup', 'database-toolset-speedup', 'database-toolset-optimize', 'database-toolset-schedule', 'database-toolset-table');
		if((isset($_GET['page'])) && (in_array($_GET['page'], $allowed)))
		{
			$this->loader->add_action('admin_enqueue_scripts', $pluginAdmin, 'enqueue_styles');
			$this->loader->add_action('admin_enqueue_scripts', $pluginAdmin, 'enqueue_scripts');
		}

		$this->loader->add_action('admin_menu', $pluginAdmin, 'return_admin_menu');
		$this->loader->add_action('init', $pluginAdmin, 'return_update_options');
		$this->loader->add_action('init', $pluginAdmin, 'create_cron_schedule');
		$this->loader->add_action('init', $pluginAdmin, 'remove_specific_backup');
		$this->loader->add_action('database_toolset_backup', $pluginAdmin, 'create_backup_database');
		$this->loader->add_filter('cron_schedules', $pluginAdmin, 'create_cron_schedules');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress
	 * @since 1.0.0
	*/
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 * @since 1.0.0
	 * @return string the name of the plugin
	*/
	public function get_pluginName()
	{
		return $this->pluginName;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin
	 * @since 1.0.0
	 * @return Database_Toolset_Loader orchestrates the hooks of the plugin
	*/
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin
	 * @since 1.0.0
	 * @return string the version number of the plugin
	*/
	public function get_version()
	{
		return $this->version;
	}
}

?>