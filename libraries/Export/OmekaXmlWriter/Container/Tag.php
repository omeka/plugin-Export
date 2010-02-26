<?php

class Export_OmekaXmlWriter_Container_Tag extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'tagContainer';
    }
    
    protected function writeContents()
    {
        if ($records = $this->records) {
            foreach ($records as $record) {
                $recordNode = new Export_OmekaXmlWriter_Record_Tag($this->writer, $record, false);
                $recordNode->writeNode();
                release_object($record);
            }
        } else {
            while ($records = $this->getNextRecords('Tag') ) {
                foreach ($records as $record) {
                    $recordNode = new Export_OmekaXmlWriter_Record_Tag($this->writer, $record);
                    $recordNode->writeNode();
                    release_object($record);
                }
                $this->writer->flush();
            }
        }
    }
}
