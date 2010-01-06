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
//add_plugin_hook('config_form', 'export_config_form');
//add_plugin_hook('config', 'export_config');
add_filter('admin_navigation_main', 'export_admin_navigation_main');

/**
 * Installs the plugin, setting up options and tables.
 */
function export_install()
{    
    set_option('export_save_directory', REPORTS_PLUGIN_DIRECTORY.
                                         DIRECTORY_SEPARATOR.
                                         'exports');
}

/**
 * Uninstalls the plugin, removing all options and tables.
 */
function export_uninstall()
{
    delete_option('export_save_directory');
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
