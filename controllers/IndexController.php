<?php
/**
 * @package Export
 * @subpackage Controllers
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
/**
 * Index controller
 *
 * @package Reports
 * @subpackage Controllers
 */
class Export_IndexController extends Omeka_Controller_Action
{
    /**
     * Default (index) action method.
     */
    public function indexAction()
    {
        $this->isDirectoryWritable();
        $snapshots = get_db()->getTable('ExportSnapshot')->findAll();
        $this->view->snapshots = $snapshots;
    }
    
    /**
     * Action for creating a new snapshot.
     */
    public function snapshotAction()
    {
        if($this->isDirectoryWritable()) {
            $snapshot = new ExportSnapshot;
            $snapshot->process = 0;
            $snapshot->save();
            $process = ProcessDispatcher::startProcess('Export_Exporter', null, array('snapshotId' => $snapshot->id));
        
            $snapshot->process = $process->id;
            $snapshot->save();
        }
        $this->redirect->goto('index');
    }
    
    /**
     * Action for downloading a snapshot.
     */
    public function downloadAction()
    {
        $id = $_GET['id'];
        $snapshot = get_db()->getTable('ExportSnapshot')->find($id);
        
        if($snapshot) {
            $this->view->snapshot = $snapshot;
        } else {
            $this->redirect->goto('index');
        }
    }
    
    /**
     * Checks if the configured save directory is writable.
     *
     * @return bool True if export_save_directory is server-writable, false otherwise.
     */
    private function isDirectoryWritable()
    {
        $directory = get_option('export_save_directory');
        if(!is_writable($directory)) {
            $this->flashError( "The Export save directory, \"$directory\", is not writable by the server. "
                        . "You will be unable to create any new snapshots. "
                        . "Either change the permissions on the directory or choose another directory "
                        . "in the plugin configuration page.");
            return false;
        }
        return true;
    }
    
}
