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
        $process = ProcessDispatcher::startProcess('Export_Exporter');
        $snapshot = new ExportSnapshot;
        $snapshot->process = $process->id;
        $snapshot->save();
        
        $this->redirect->goto('index');
    }
}
