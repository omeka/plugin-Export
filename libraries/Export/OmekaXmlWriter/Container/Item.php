<?php

class Export_OmekaXmlWriter_Container_Item extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'itemContainer';
    }
    
    protected function writeContents()
    {
        while ($records = $this->getNextRecords('Item') ) {
            foreach ($records as $record) {
                $recordNode = new Export_OmekaXmlWriter_Record_Item($this->writer, $record);
                $recordNode->writeNode();
                release_object($record);
            }
            $this->writer->flush();
        }
    }
}
