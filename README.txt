=== Database Toolset ===
Contributors: NeosLab
Tags: clean, cleaner, cleanup, database, mysql
Requires at least: 4.9
Tested up to: 6.4.3
Stable tag: 1.8.4
License URI: https://raw.githubusercontent.com/neoslabx/database-toolset/refs/heads/main/LICENSE

Database Toolset can help you to keep your database clean by deleting all unneeded entries such as "transient", "revision", "auto draft" and more.

== Description ==

Database Toolset can help you to keep your database clean and optimized by deleting all orphaned or unneeded entries such as "transient", "revision", "auto draft", "orphan postmeta" and much more.

Furthermore Database Toolset can be used to optimize your database using the native SQL function in order to increase your website performance and can also be used to organize scheduled database backup which will be saved on your website root.

Major features in Database Toolset include:

* Remove "revision", "draft", "auto draft" from your database.
* Remove "moderated comments", "spam comments", "trash comments" from your database.
* Remove "orphan postmeta", "orphan commentmeta", "orphan relationships" and "dashboard transient feed" from your database.
* Allow user to perform an "Optimization Process" of his database using native SQL function.
* Allow user to configure an automatic backup of the database which will be save in the website root.

== Installation ==

1. Upload "database-toolset" folder to the "/wp-content/plugins/" directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Navigate the "Database Toolset" menu located in your dashboard sidebar to use or configure the plugin options.

== Screenshots ==

1. Main "cleanup" page where all redundant can be removed.
2. The "optimize" page can be used to optmize your SQL database using PHPMyAdmin build-in function.
3. From the "task" page you will be allowed to create a cron task in order to backup your database based on your requirements.
4. The "backups" page will present to you using a table all available backups ready to download.

== Changelog ==

= 1.8.4 (2024-03-23) =
* Code revision and optimization

= 1.8.3 (2024-03-23) =
* Code revision and optimization

= 1.8.2 (2023-09-08) =
* Code revision and optimization

= 1.8.1 (2023-09-06) =
* Code revision and optimization

= 1.8.0 (2023-09-06) =
* Code revision and optimization

= 1.7.9 (2023-04-29) =
* Code revision and optimization

= 1.7.8 (2023-04-16) =
* Code revision and optimization

= 1.7.7 (2023-04-08) =
* Code revision and optimization

= 1.7.6 (2023-03-01) =
* Code revision and optimization

= 1.7.5 (2023-02-21) =
* Code revision and optimization

= 1.7.4 (2023-02-21) =
* Code revision and optimization

= 1.7.3 (2023-01-24) =
* Code revision and optimization

= 1.7.2 (2023-01-21) =
* Code revision and optimization

= 1.7.1 (2022-12-24) =
* Code revision and optimization

= 1.7.0 (2022-12-12) =
* Code revision and optimization

= 1.6.9 (2022-12-11) =
* Code revision and optimization

= 1.6.8 (2022-12-11) =
* Code revision and optimization

= 1.6.7 (2022-12-11) =
* Code revision and optimization

= 1.6.6 (2022-12-10) =
* Code revision and optimization

= 1.6.5 (2022-11-27) =
* Code revision and optimization

= 1.6.4 (2022-11-18) =
* Code revision and optimization

= 1.6.3 (2022-11-08) =
* Code revision and optimization

= 1.6.2 (2022-11-04) =
* Renamed backup folder from `database-toolset` to `export`
* PHP improvement on core class
* Code revision and optimization
* CSS optimization
* JS optimization

= 1.6.1 (2022-10-24) =
* Code revision and optimization

= 1.6.0 (2022-10-22) =
* Removed 'About' section
* Removed useless PHP function
* Code revision and optimization

= 1.5.9 (2022-10-18) =
* Code revision and optimization

= 1.5.8 (2022-10-18) =
* Code revision and optimization

= 1.5.7 (2022-10-09) =
* Code revision and optimization

= 1.5.6 (2021-08-25) =
* Code revision and optimization

= 1.5.5 (2021-07-23) =
* Code revision and optimization

= 1.5.4 (2021-07-20) =
* Optimized core class
* Fixed PHP issue in the admin section
* Code revision and optimization

= 1.5.3 (2021-07-16) =
* Code revision and optimization

= 1.5.2 (2021-07-08) =
* Code revision and optimization

= 1.5.1 (2021-07-06) =
* Optimized activation class
* Optimized deactivation class
* Optimized core class
* Code revision and optimization

= 1.5.0 (2021-07-05) =
* Code revision and optimization

= 1.4.9 (2021-07-04) =
* Code revision and optimization

= 1.4.8 (2021-07-02) =
* Fixed PHP issue in the admin section

= 1.4.7 (2021-06-23) =
* Code optimization

= 1.4.6 (2021-06-23) =
* Code optimization

= 1.4.5 (2021-06-22) =
* Code optimization

= 1.4.4 (2021-06-19) =
* Code optimization

= 1.4.3 (2021-06-17) =
* Code correction

= 1.4.2 (2021-06-17) =
* Code correction

= 1.4.1 (2021-06-17) =
* Added PHP plugin identifier

= 1.4.0 (2021-06-16) =
* Rename activation class
* Rename deactivation class

= 1.3.9 (2021-06-15) =
* Fixed PHP Define duplicate

= 1.3.8 (2021-06-13) =
* Fixed PHP Define duplicate

= 1.3.7 (2021-06-13) =
* Code revision and optimization
* Updated to the latest version of FontAwesome
* Backtest compatibility with WP 5.7.2

= 1.3.6 (2019-08-18) =
* Modified "return_about_page()" function

= 1.3.5 (2019-07-10) =
* Switched "Performance Tab" Position

= 1.3.4 (2019-07-09) =
* Fixed wrong use of "get_admin_url()"
* Added a function in order to display the saved space running the "optimizer"
* Added a function in order to reset the "options" WP table
* Updated main CSS file "dashboard.css"
* Updated main CSS file "standalone.css"
* Updated core language
* Updated "spanish" language translation
* Updated "french" language translation

= 1.3.3 (2019-07-04) =
* Fixed a bug in "includes/class-database-toolset-core.php"
* Updated main CSS file "dashboard.css"
* Updated main CSS file "standalone.css"

= 1.3.2 (2019-07-01) =
* Fixed a bug in "cleanup section"

= 1.3.1 (2019-06-30) =
* Added a function in order to be able to remove "customize_changset" trashed post
* Fixed a missing translation string in "task section form"
* Fixed a missing translation string in "email content"
* Updated main CSS file "dashboard.css"
* Updated main CSS file "standalone.css"

= 1.3.0 (2019-06-25) =
* Updated main CSS file "dashboard.css"
* Updated core language
* Updated "spanish" language translation
* Updated "french" language translation

= 1.2.9 (2019-06-18) =
* Updated main CSS file "dashboard.css"
* Updated plugin form
* Updated core language
* Updated "spanish" language translation
* Updated "french" language translation

= 1.3.0 (2019-06-17) =
* Updated core language
* Updated "spanish" language translation
* Updated "french" language translation

= 1.3.0 (2019-06-17) =
* Updated core language
* Updated "spanish" language translation
* Updated "french" language translation

= 1.2.6 (2019-06-16) =
* Updated the "$load" variable name to "$data" in admin/class-custom-email-admin.php:389
* Updated the "$url" variable in admin/class-custom-email-admin.php:1240
* Fixed bug on "return_backups_page" where "$has_backup" was not defined as "false" if no backup was present yet
* Updated core language
* Updated "spanish" language translation
* Updated "french" language translation

= 1.2.5 (2019-06-14) =
* Updated CSS / JS files

= 1.2.4 (2019-06-14) =
* Updated CSS / JS files

= 1.2.3 (2019-06-14) =
* Updated core language
* Updated "spanish" language translation
* Updated "french" language translation

= 1.2.2 (2019-06-07) =
* Initial Public Release

== License ==

Good news, this plugin is free for everyone! Since it's released under the GPL, you can use it free of charge on your personal or commercial site.
