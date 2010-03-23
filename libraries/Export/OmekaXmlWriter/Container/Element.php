<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Container_Element extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'elementContainer';
    }
    
    protected function writeContents()
    {
        foreach($this->records as $element) {
            $elementNode = new Export_OmekaXmlWriter_Record_Element($this->writer, $element);
            $elementNode->writeNode();
            release_object($record);
        }
    }
}
