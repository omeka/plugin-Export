<?php

class Export_OmekaXmlWriter_Container_ItemType extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'itemTypeContainer';
    }
    
    protected function writeContents()
    {   
        while ($records = $this->getNextRecords('ItemType') ) {
            foreach ($records as $record) {
                $recordNode = new Export_OmekaXmlWriter_Record_ItemType($this->writer, $record);
                $recordNode->writeNode();
            }
        }
    }
}