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
    }
    
    /**
     * 
     */
    public function exportAction()
    {
        ProcessDispatcher::startProcess('Export_Exporter');
        $this->redirect->goto('index');
    }
}
