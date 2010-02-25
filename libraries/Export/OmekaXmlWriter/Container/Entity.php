<?php

class Export_OmekaXmlWriter_Container_Entity extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'entityContainer';
    }
    
    protected function writeContents()
    {   
        while ($records = $this->getNextRecords('Entity') ) {
            foreach ($records as $record) {
                $recordNode = new Export_OmekaXmlWriter_Record_Entity($this->writer, $record);
                $recordNode->writeNode();
            }
        }
    }
}