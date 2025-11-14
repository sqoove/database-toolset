<?php
/**
 * The admin-specific functionality of the plugin
 *
 * @link https://sqoove.com
 * @since 1.0.0
 * @package Database_Toolset
 * @subpackage Database_Toolset/admin
*/

/**
 * Class `Database_Toolset_Admin`
 * @package Database_Toolset
 * @subpackage Database_Toolset/admin
 * @author Sqoove <support@sqoove.com>
*/
class Database_Toolset_Admin
{
	/**
	 * The ID of this plugin
	 * @since 1.0.0
	 * @access private
	 * @var string $pluginName the ID of this plugin
	*/
	private $pluginName;

	/**
	 * The version of this plugin
	 * @since 1.0.0
	 * @access private
	 * @var string $version the current version of this plugin
	*/
	private $version;

	/**
	 * Initialize the class and set its properties
	 * @since 1.0.0
	 * @param string $pluginName the name of this plugin
	 * @param string $version the version of this plugin
	*/
	public function __construct($pluginName, $version)
	{
		$this->pluginName = $pluginName;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area
	 * @since 1.0.0
	*/
	public function enqueue_styles()
	{
		wp_register_style($this->pluginName.'-fontawesome', plugin_dir_url(__FILE__).'assets/styles/fontawesome.min.css', array(), $this->version, 'all');
		wp_register_style($this->pluginName.'-datatables', plugin_dir_url(__FILE__).'assets/styles/datatables.min.css', array(), $this->version, 'all');
		wp_register_style($this->pluginName.'-dashboard', plugin_dir_url(__FILE__).'assets/styles/database-toolset-admin.min.css', array(), $this->version, 'all');
		wp_enqueue_style($this->pluginName.'-fontawesome');
		wp_enqueue_style($this->pluginName.'-datatables');
		wp_enqueue_style($this->pluginName.'-dashboard');
	}

	/**
	 * Register the JavaScript for the admin area
	 * @since 1.0.0
	*/
	public function enqueue_scripts()
	{
		wp_register_script($this->pluginName.'-datatables', plugin_dir_url(__FILE__).'assets/javascripts/datatables.min.js', array('jquery'), $this->version, false);
		wp_register_script($this->pluginName.'-script', plugin_dir_url(__FILE__).'assets/javascripts/database-toolset-admin.min.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->pluginName.'-datatables');
		wp_enqueue_script($this->pluginName.'-script');
	}

	/**
	 * Return the plugin header
	*/
	public function return_plugin_header()
	{
		$html = '<div class="wpdx-header-plugin"><span class="header-icon"><i class="fas fa-sliders-h"></i></span> <span class="header-text">'.__('Database Toolset', 'database-toolset').'</span></div>';
		return $html;
	}

	/**
	 * Return the tabs menu
	*/
	public function return_tabs_menu($tab)
	{
		$link = admin_url('admin.php');
		$list = array
		(
			array('tab1', 'database-toolset-cleanup', 'fa-broom', __('Clean-Up', 'database-toolset')),
			array('tab2', 'database-toolset-optimize', 'fa-database', __('Optimizer', 'database-toolset')),
			array('tab3', 'database-toolset-schedule', 'fa-clock', __('Tasks', 'database-toolset')),
			array('tab4', 'database-toolset-table', 'fa-hdd', __('Backups', 'database-toolset')),
			array('tab5', 'database-toolset-speedup', 'fa-chart-line', __('Performance', 'database-toolset'))
		);

		$menu = null;
		foreach($list as $item => $value)
		{
			$html = array('div' => array('class' => array()), 'a' => array('href' => array()), 'i' => array('class' => array()), 'p' => array(), 'span' => array());
			$menu ='<div class="tab-label '.$value[0].' '.(($tab === $value[0]) ? 'active' : '').'"><a href="'.$link.'?page='.$value[1].'"><p><i class="fas '.$value[2].'"></i><span>'.$value[3].'</span></p></a></div>';
			echo wp_kses($menu, $html);
		}
	}

	/**
	 * Remove specific backup
	*/
	public function remove_specific_backup()
	{
		if((isset($_GET['action'])) && ($_GET['action'] === 'remove'))
		{
			if(isset($_GET['backup']))
			{
				$loadpath = wp_upload_dir();
				$filepath = $loadpath["basedir"].'/export/database/'.$_GET['backup'];

				if(file_exists($filepath))
				{
					unlink($filepath);
					header('location:'.admin_url('admin.php?page=database-toolset-table').'&action=deleted');
					die();
				}
			}
		}
	}

	/**
	 * Create Cron Schedules
	*/
	public function create_cron_schedules($schedules)
	{
	    if(!isset($schedules["5min"]))
	    {
	        $schedules["5min"] = array
	        (
	            'interval' => 5*60,
	            'display' => __('Once every 5 minutes', 'database-toolset')
	        );
	    }

	    if(!isset($schedules["15min"]))
	    {
	        $schedules["15min"] = array
	        (
	            'interval' => 15*60,
	            'display' => __('Once every 15 minutes', 'database-toolset')
	        );
	    }

	    if(!isset($schedules["30min"]))
	    {
	        $schedules["30min"] = array
	        (
	            'interval' => 30*60,
	            'display' => __('Once every 30 minutes', 'database-toolset')
	        );
	    }

	    if(!isset($schedules["60min"]))
	    {
	        $schedules["60min"] = array
	        (
	            'interval' => 60*60,
	            'display' => __('Once every 60 minutes', 'database-toolset')
	        );
	    }

	    if(!isset($schedules["6h"]))
	    {
	        $schedules["6h"] = array
	        (
	            'interval' => 60*60*6,
	            'display' => __('Once every 6 hours', 'database-toolset')
	        );
	    }

	    if(!isset($schedules["12h"]))
	    {
	        $schedules["12h"] = array
	        (
	            'interval' => 60*60*12,
	            'display' => __('Once every 12 hours', 'database-toolset')
	        );
	    }

	    if(!isset($schedules["24h"]))
	    {
	        $schedules["24h"] = array
	        (
	            'interval' => 60*60*24,
	            'display' => __('Once every 24 hours', 'database-toolset')
	        );
	    }

	    if(!isset($schedules["7d"]))
	    {
	        $schedules["7d"] = array
	        (
	            'interval' => 60*60*24*7,
	            'display' => __('Once weekly', 'database-toolset')
	        );
	    }

	    return $schedules;
	}

	/**
	 * Create Cron Event
	*/
	public function create_cron_schedule()
	{
		$opts = get_option('_database_toolset');
		if(!wp_next_scheduled('database_toolset_backup'))
		{
			if(((isset($opts['status'])) && ($opts['status'] === 'on')) && ((isset($opts['crontab'])) && (!empty($opts['crontab'])) && ($opts['crontab'] !== 'never')))
			{
				wp_schedule_event(time(), $opts['crontab'], 'database_toolset_backup');
			}
		}
		else
		{
			$cronjob = wp_get_schedule('database_toolset_backup');
			$allowed = array('never', '5min', '15min', '30min', '60min', '6h', '12h', '24h', '7d');
			if((isset($cronjob)) && (in_array($cronjob, $allowed)))
			{
				if((!empty($opts['status'])) && ($opts['status'] === 'off'))
				{
					wp_clear_scheduled_hook('database_toolset_backup');
				}
				elseif((!empty($opts['crontab'])) && ($opts['crontab'] === 'never'))
				{
					wp_clear_scheduled_hook('database_toolset_backup');
				}
				elseif($cronjob !== $opts['crontab'])
				{
					wp_clear_scheduled_hook('database_toolset_backup');
					wp_schedule_event(time(), $opts['crontab'], 'database_toolset_backup');
				}
			}
		}
	}

	/**
	 * Create Backup Folders
	*/
	public function create_backup_folders()
	{
		$loadpath = wp_upload_dir();
		$filepath = $loadpath["basedir"].'/export/database/';
		if(!file_exists($filepath))
		{
			mkdir($filepath, 0755, true);
		}
	}

	/**
	 * Create index files to protect each created folder
	*/
	public function create_backup_indexes()
	{
		$loadpath = wp_upload_dir();
		$filepath = $loadpath["basedir"].'/export/index.php';
		if(!file_exists($filepath))
		{
			$fh = fopen($filepath, 'w') or die("can't open file");
			fwrite($fh, '<?php // Silence is golden ?>');
			fclose($fh);
			chmod($filepath, 0600);
		}

		$filepath = $loadpath["basedir"].'/export/database/index.php';
		if(!file_exists($filepath))
		{
			$fh = fopen($filepath, 'w') or die("can't open file");
			fwrite($fh, '<?php // Silence is golden ?>');
			fclose($fh);
			chmod($filepath, 0600);
		}
	}

	/**
	 * Convert File size unit
	*/
    public function return_formatted_size($bytes)
    {
        if($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2).' GB';
        }
        elseif($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2).' MB';
        }
        elseif($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2).' KB';
        }
        elseif($bytes > 1)
        {
            $bytes = $bytes.' bytes';
        }
        elseif($bytes === 1)
        {
            $bytes = $bytes.' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}

	/**
	 * Send notification to website owner
	*/
	public function send_user_notice($site, $link)
    {
        $opts = get_option('_database_toolset');

		$get_upload = wp_upload_dir();
		if((isset($opts['gzip'])) && ($opts['gzip'] === 'on'))
		{
			$get_backup = $get_upload['baseurl'].'/export/database/'.$link.'.gz';
		}
		else
		{
			$get_backup = $get_upload['baseurl'].'/export/database/'.$link;
		}

		$backupDate = date('d/m/Y');
		$backupTime = date('H:i:s');

        $message = __('Hi,', 'database-toolset')."\r\n\r\n";
        $message.= sprintf(__('This email was sent from your website %s by the Database Toolset plugin to inform you that a new backup of your database was successfully created on %s at %s.', 'database-toolset'), $site, $backupDate, $backupTime)."\r\n\r\n";
        $message.= sprintf(__('You can download a copy of this backup at anytime by clicking the following link : %s', 'database-toolset'), $get_backup)."\r\n\r\n";
        $message.= __('Email generated by', 'database-toolset')."\r\n";
        $message.= __('Database Toolset', 'database-toolset')."\r\n";

        $subject = '['.get_site_url().'] - '.__('New Database Backup Available', 'database-toolset');
        wp_mail($opts['email'], $subject, $message);
    }

	/**
	 * Create database backup
	*/
	public function create_backup_database()
	{
		$opts = get_option('_database_toolset');
		$gzip = false;

		$loadpath = wp_upload_dir();
		$filepath = $loadpath["basedir"].'/export/database/';

		if((isset($opts['gzip'])) && ($opts['gzip'] === 'on'))
		{
			$gzip = true;
		}

		$folders = $this->create_backup_folders();
		$indexes = $this->create_backup_indexes();

		/**
		 * Define the constants
		*/
		define("DBT_BACKUP_PATH", $filepath);		// The full path of the directory where to save the backup
		define("DBT_BACKUP_TABLES", '*');			// By default all tables will be save "*", but it can be also a list of tables such as "define("DBT_BACKUP_TABLES", 'table1, table2, table3');"
		define("DBT_BACKUP_GZIP", $gzip);			// Set to false if you want plain SQL backup files (not gzipped)
		define("DBT_BACKUP_KEY_CHECKS", true);		// Set to true if you are having foreign key constraint fails
		define("DBT_BACKUP_BATCH_SIZE", 1000);		// Batch size when selecting rows from database in order to not exhaust system memory

		/**
		 * The class responsible for orchestrating the backup of the database
		*/
		require_once plugin_dir_path(dirname(__FILE__)).'admin/class-database-toolset-backup.php';
		$sqlBackup = new Database_Toolset_Backup(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET);
		$sqlResult = $sqlBackup->backupTables(DBT_BACKUP_TABLES, DBT_BACKUP_PATH);

		if(((isset($opts['notify'])) && ($opts['notify'] === 'on')) && ((isset($opts['email'])) && (!empty($opts['email']))) && ($sqlResult !== false))
		{
			$this->send_user_notice(get_bloginfo('name'), $sqlResult);
		}
	}

	/**
	 * Update `Options` on form submit
	*/
	public function return_update_options()
	{
		if((isset($_POST['dbt-update-option'])) && ($_POST['dbt-update-option'] === 'true')
		&& check_admin_referer('dbt-referer-form', 'query-option'))
		{
			$opts = array('status' => 'off', 'gzip' => 'off', 'notify' => 'off', 'email' => 'none', 'crontab' => 'never');
			if((isset($_POST['_database_toolset']['email']))
			&& (isset($_POST['_database_toolset']['crontab'])))
			{
				if(isset($_POST['_database_toolset']['status']))
				{
					$opts['status'] = 'on';
				}

				if(isset($_POST['_database_toolset']['gzip']))
				{
					$opts['gzip'] = 'on';
				}

				if(isset($_POST['_database_toolset']['notify']))
				{
					$opts['notify'] = 'on';
				}

				if((isset($_POST['_database_toolset']['email'])) && ((isset($_POST['_database_toolset']['notify'])) && ($_POST['_database_toolset']['notify'] === 'on')))
				{
					$opts['email'] = sanitize_email($_POST['_database_toolset']['email']);
					if(is_email($opts['email']) === false)
					{
						header('location:'.admin_url('admin.php?page=database-toolset-schedule').'&status=error&type=email');
						die();
					}
				}

				$allowed = array('never', '5min', '15min', '30min', '60min', '6h', '12h', '24h', '7d');
				if((isset($_POST['_database_toolset']['crontab'])) && (in_array($_POST['_database_toolset']['crontab'], $allowed)))
				{
					$opts['crontab'] = sanitize_text_field($_POST['_database_toolset']['crontab']);
				}

				$data = update_option('_database_toolset', $opts);
				header('location:'.admin_url('admin.php?page=database-toolset-schedule').'&status=updated');
				die();
			}
			else
			{
				header('location:'.admin_url('admin.php?page=database-toolset-schedule').'&status=error&type=unknown');
				die();
			}
		}
	}

	/**
	 * Return Database Speed-Up
	*/
	public function return_query_speedup($options)
	{
		global $wpdb;

		if($options === true)
		{
			/**
			 * Reset Options Increment
			*/
			$query = "ALTER TABLE `".$wpdb->options."` DROP `option_id`;";
			$fetch = $wpdb->query($query);

			$query = "ALTER TABLE `".$wpdb->options."` ADD `option_id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
			$fetch = $wpdb->query($query);
		}
	}

	/**
	 * Delete entries from database
	 * @param $type the type of post_type, post_status or comment_approved to search for
	*/
	public function return_query_cleanup($type)
	{
		global $wpdb;

		switch($type)
		{
			case "posts-revision":
			$query = "DELETE FROM `".$wpdb->posts."` WHERE `post_type` = 'revision'";
			$fetch = $wpdb->query($query);
			break;

			case "posts-draft":
			$query = "DELETE FROM `".$wpdb->posts."` WHERE `post_status` = 'draft'";
			$fetch = $wpdb->query($query);
			break;

			case "posts-autodraft":
			$query = "DELETE FROM `".$wpdb->posts."` WHERE `post_status` = 'auto-draft'";
			$fetch = $wpdb->query($query);
			break;

			case "posts-changeset":
			$query = "SELECT `ID` FROM `".$wpdb->posts."` WHERE `post_type` = 'customize_changeset' AND `post_status` = 'trash'";
			$fetch = $wpdb->get_results($query, OBJECT);

			foreach($fetch as $object)
			{
				$query = "DELETE FROM `".$wpdb->posts."` WHERE `ID` = '".$object->ID."'";
				$fetch = $wpdb->query($query);

				$query = "DELETE FROM `".$wpdb->postmeta."` WHERE `post_id` = '".$object->ID."'";
				$fetch = $wpdb->query($query);
			}
			break;

			case "comments-moderated":
			$query = "DELETE FROM `".$wpdb->comments."` WHERE `comment_approved` = '0'";
			$fetch = $wpdb->query($query);
			break;

			case "comments-spam":
			$query = "DELETE FROM `".$wpdb->comments."` WHERE `comment_approved` = 'spam'";
			$fetch = $wpdb->query($query);
			break;

			case "comments-trash":
			$query = "DELETE FROM `".$wpdb->comments."` WHERE `comment_approved` = 'trash'";
			$fetch = $wpdb->query($query);
			break;

			case "orphan-postmeta":
			$query = "DELETE `pm` FROM `".$wpdb->postmeta."` pm LEFT JOIN `".$wpdb->posts."` wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL";
			$fetch = $wpdb->query($query);
			break;

			case "orphan-commentmeta":
			$query = "DELETE FROM `".$wpdb->commentmeta."` WHERE `comment_id` NOT IN (SELECT comment_id FROM ".$wpdb->comments.")";
			$fetch = $wpdb->query($query);
			break;

			case "orphan-relationships":
			$query = "DELETE FROM `".$wpdb->term_relationships."` WHERE `term_taxonomy_id` = 1 AND `object_id` NOT IN (SELECT id FROM ".$wpdb->posts.")";
			$fetch = $wpdb->query($query);
			break;

			case "orphan-transient-feed":
			$query = "DELETE FROM `".$wpdb->options."` WHERE `option_name` LIKE '_site_transient_browser_%' OR option_name LIKE '_site_transient_timeout_browser_%' OR option_name LIKE '_transient_feed_%' OR option_name LIKE '_transient_timeout_feed_%'";
			$fetch = $wpdb->query($query);
			break;
		}
	}

	/**
	 * Count entries from database
	 * @param $type the type of post_type, post_status or comment_approved to search for
	*/
	public function return_query_count($type)
	{
		global $wpdb;

		switch($type)
		{
			case "posts-revision":
			$query = "SELECT COUNT(*) FROM `".$wpdb->posts."` WHERE `post_type` = 'revision'";
			$fetch = $wpdb->get_var($query);
			break;

			case "posts-draft":
			$query = "SELECT COUNT(*) FROM `".$wpdb->posts."` WHERE `post_status` = 'draft'";
			$fetch = $wpdb->get_var($query);
			break;

			case "posts-autodraft":
			$query = "SELECT COUNT(*) FROM `".$wpdb->posts."` WHERE `post_status` = 'auto-draft'";
			$fetch = $wpdb->get_var($query);
			break;

			case "posts-changeset":
			$query = "SELECT COUNT(*) FROM `".$wpdb->posts."` WHERE `post_type` = 'customize_changeset' AND `post_status` = 'trash'";
			$fetch = $wpdb->get_var($query);
			break;

			case "comments-moderated":
			$query = "SELECT COUNT(*) FROM `".$wpdb->comments."` WHERE `comment_approved` = '0'";
			$fetch = $wpdb->get_var($query);
			break;

			case "comments-spam":
			$query = "SELECT COUNT(*) FROM `".$wpdb->comments."` WHERE `comment_approved` = 'spam'";
			$fetch = $wpdb->get_var($query);
			break;

			case "comments-trash":
			$query = "SELECT COUNT(*) FROM `".$wpdb->comments."` WHERE `comment_approved` = 'trash'";
			$fetch = $wpdb->get_var($query);
			break;

			case "orphan-postmeta":
			$query = "SELECT COUNT(*) FROM `".$wpdb->postmeta."` pm LEFT JOIN `".$wpdb->posts."` wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL";
			$fetch = $wpdb->get_var($query);
			break;

			case "orphan-commentmeta":
			$query = "SELECT COUNT(*) FROM `".$wpdb->commentmeta."` WHERE `comment_id` NOT IN (SELECT comment_id FROM ".$wpdb->comments.")";
			$fetch = $wpdb->get_var($query);
			break;

			case "orphan-relationships":
			$query = "SELECT COUNT(*) FROM `".$wpdb->term_relationships."` WHERE `term_taxonomy_id` = 1 AND `object_id` NOT IN (SELECT id FROM ".$wpdb->posts.")";
			$fetch = $wpdb->get_var($query);
			break;

			case "orphan-transient-feed":
			$query = "SELECT COUNT(*) FROM `".$wpdb->options."` WHERE `option_name` LIKE '_site_transient_browser_%' OR option_name LIKE '_site_transient_timeout_browser_%' OR option_name LIKE '_transient_feed_%' OR option_name LIKE '_transient_timeout_feed_%'";
			$fetch = $wpdb->get_var($query);
			break;
		}

		$count = $fetch;
		return $count;
	}

	/**
	 * Return Database Optimization
	*/
	public function return_query_optimize()
	{
		global $wpdb;

		$query = 'SHOW TABLE STATUS FROM `'.DB_NAME.'`';
		$fetch = $wpdb->get_results($query);

		foreach($fetch as $row)
		{
			$mysql = 'OPTIMIZE TABLE '.$row->Name;
			$wpdb->query($mysql);
		}
	}

	/**
	 * Return the `Clean-Up` page
	*/
	public function return_cleanup_page()
	{
		global $wpdb, $table_prefix;
		require_once plugin_dir_path(__FILE__).'partials/database-toolset-admin-cleanup.php';
	}

	/**
	 * Return the `Optimizer` page
	*/
	public function return_optimizer_page()
	{
		global $wpdb, $table_prefix;
		require_once plugin_dir_path(__FILE__).'partials/database-toolset-admin-optimize.php';
	}

	/**
	 * Return the `Schedule` page
	*/
	public function return_schedule_page()
	{
		$opts = get_option('_database_toolset');
		require_once plugin_dir_path(__FILE__).'partials/database-toolset-admin-schedule.php';
	}

	/**
	 * Return the `Table` page
	*/
	public function return_table_page()
	{
		require_once plugin_dir_path(__FILE__).'partials/database-toolset-admin-table.php';
	}

	/**
	 * Return the `Speedup` page
	*/
	public function return_speedup_page()
	{
		require_once plugin_dir_path(__FILE__).'partials/database-toolset-admin-speedup.php';
	}

	/**
	 * Return Backend Menu
	*/
	public function return_admin_menu()
	{
		add_menu_page('Database Toolset', 'Database Toolset', 'administrator', 'database-toolset-admin', array($this, 'return_cleanup_page'), 'dashicons-feedback');
		add_submenu_page('database-toolset-admin', 'Clean-Up', 'Clean-Up', 'administrator', 'database-toolset-cleanup', array($this, 'return_cleanup_page'));
		add_submenu_page('database-toolset-admin', 'Optimizer', 'Optimizer', 'administrator', 'database-toolset-optimize', array($this, 'return_optimizer_page'));
		add_submenu_page('database-toolset-admin', 'Tasks', 'Tasks', 'administrator', 'database-toolset-schedule', array($this, 'return_schedule_page'));
		add_submenu_page('database-toolset-admin', 'Backups', 'Backups', 'administrator', 'database-toolset-table', array($this, 'return_table_page'));
		add_submenu_page('database-toolset-admin', 'Performance', 'Performance', 'administrator', 'database-toolset-speedup', array($this, 'return_speedup_page'));
		remove_submenu_page('database-toolset-admin', 'database-toolset-admin');
	}
}

?>