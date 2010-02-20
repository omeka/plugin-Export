<?php

class Export_OmekaXmlWriter_Record_Tag extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('tag');
        $writer->writeAttribute('tagId', $record->id);
        
        $writer->endElement();
    }
}