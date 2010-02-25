<?php
/**
 * @package Reports
 * @subpackage Controllers
 * @copyright Copyright (c) 2009 Center for History and New Media
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
        $snapshots = get_db()->getTable('ExportSnapshot')->findAll();
        $this->view->snapshots = $snapshots;
    }
    
    /**
     * 
     */
    public function snapshotAction()
    {
        $snapshot = new ExportSnapshot;
        $snapshot->process = 0;
        $snapshot->save();
        $process = ProcessDispatcher::startProcess('Export_Exporter', null, array('snapshotId' => $snapshot->id));
        
        $snapshot->process = $process->id;
        $snapshot->save();
        
        $this->redirect->goto('index');
    }
    
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
}
