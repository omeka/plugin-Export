<?php 
/**
 * Main plugin script
 *
 * Main script for the plugin, sets up hooks and filters to the Omeka API.
 *
 * @package Export
 * @author Center for History and New Media
 * @copyright Copyright 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

define('EXPORT_PLUGIN_DIRECTORY', dirname(__FILE__));
define('EXPORT_SAVE_DIRECTORY', get_option('export_save_directory'));

add_plugin_hook('install', 'export_install');
add_plugin_hook('uninstall', 'export_uninstall');
add_plugin_hook('config_form', 'export_config_form');
add_plugin_hook('config', 'export_config');
add_filter('admin_navigation_main', 'export_admin_navigation_main');

/**
 * Installs the plugin, setting up options and tables.
 */
function export_install()
{    
    set_option('export_save_directory', EXPORT_PLUGIN_DIRECTORY . DIRECTORY_SEPARATOR. 'snapshots');
    
    $db = get_db();
    
    /* Table: export_snapshots
    
        id: Primary key
        date: Date of snapshot
        archive: Filename of archive on server
        process: ID of associated background process
    */
    $sql = "
    CREATE TABLE IF NOT EXISTS `{$db->prefix}export_snapshots` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `archive` TEXT COLLATE utf8_unicode_ci DEFAULT NULL,
        `process` INT UNSIGNED NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    
    $db->query($sql);
}

/**
 * Uninstalls the plugin, removing all options and tables.
 */
function export_uninstall()
{
    delete_option('export_save_directory');
    
    $db = get_db();
    
    $sql = "DROP TABLE IF EXISTS `{$db->prefix}export_snapshots`;";
    $db->query($sql);
}

/**
 * Shows the configuration form.
 */
function export_config_form()
{
    $saveDirectory = get_option('export_save_directory');
    
    include 'config_form.php';
}

/**
 * Processes the configuration form.
 */
function export_config()
{
    set_option('export_save_directory', $_POST['export_save_directory']);
}

/**
 * admin_navigation_main filter
 * @param array $tabs array of admin navigation tabs
 */
function export_admin_navigation_main($tabs)
{
    $tabs['Export'] = uri('export');
    return $tabs;
}
