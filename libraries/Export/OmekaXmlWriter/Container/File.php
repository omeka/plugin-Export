<?php

class Export_OmekaXmlWriter_Container_File extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'fileContainer';
    }
    
    protected function writeContents()
    {
        foreach($this->records as $record) {
            $recordNode = new Export_OmekaXmlWriter_Record_File($this->writer, $record);
            $recordNode->writeNode();
            release_object($record);
        }
    }
}
