<?php

class Export_OmekaXmlWriter_Container_ElementSet extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'elementSetContainer';
    }
    
    protected function writeContents()
    {
        while ($records = $this->getNextRecords('ElementSet') ) {
            foreach ($records as $record) {
                $recordNode = new Export_OmekaXmlWriter_Record_ElementSet($this->writer, $record);
                $recordNode->writeNode();
                release_object($record);
            }
        }
    }
}
