<?php

class Export_OmekaXmlWriter_Record_File extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('file');
        $writer->writeAttribute('fileId', $record->id);
        
        $writer->endElement();
    }
}