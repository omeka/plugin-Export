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
        $db = get_db();
        $snapshotsTable = $db->getTable('ExportSnapshot')->getTableName();
        $processesTable = $db->getTable('Process')->getTableName();
        // Get status of each export by joining with processes table
        $query = "SELECT s.*, p.status FROM `$snapshotsTable` AS s JOIN `$processesTable` AS p ON s.process = p.id ORDER BY s.date DESC";
        $statement = $db->query($query);
        $snapshotData = $statement->fetchAll(Zend_Db::FETCH_ASSOC);
        $entries = array();
        foreach ($snapshotData as $entry) {
            $entry['displayDate'] = date('F d, Y G:i:s', strtotime($entry['date']));
            $entry['displayStatus'] = ucwords($entry['status']);
            if ($entry['status'] == 'completed') { 
                $entry['displaySize'] = $this->formatBytes(filesize($entry['archive']));
            }
            $entries[] = $entry;
        }
        $this->view->entries = $entries;
    }
    
    /**
     * Action for creating a new snapshot.
     */
    public function snapshotAction()
    {
        if ($this->isDirectoryWritable()) {
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
        
        if ($snapshot) {
            $this->view->snapshot = $snapshot;
        } else {
            $this->redirect->goto('index');
        }
    }
    
    /**
     * Action for deleting a created snapshot.
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        $db = get_db();
        $snapshot = $db->getTable('ExportSnapshot')->find($id);
        if ($snapshot) {
            $archive = $snapshot->archive;
            $snapshot->delete();
            if (!unlink($archive)) {
                $this->flash("Error attempting to delete snapshot archive \"$archive\"");
            }
        } else {
            $this->flashError('Unable to find specified snapshot or no snapshot specified.');
        }
        $this->redirect->goto('index');
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
    
    /**
     * Returns a size formatted in a human-readable format.
     *
     * @param mixed $bytes Size in bytes
     * @param int $precision Decimal places to display
     * @return string Formatted size
     */
    private function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
           
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
                          
        $bytes /= pow(1024, $pow); 
                                 
        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }
}
