<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Container_Collection extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'collectionContainer';
    }
    
    protected function writeContents()
    {        
        while ($records = $this->getNextRecords('Collection') ) {
            foreach ($records as $record) {
                $recordNode = new Export_OmekaXmlWriter_Record_Collection($this->writer, $record);
                $recordNode->writeNode();
                release_object($record);
            }
        }
    }
}
