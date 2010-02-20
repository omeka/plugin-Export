<?php

class Export_OmekaXmlWriter_Record_ElementSet extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('elementSet');
        $writer->writeAttribute('elementSetId', $record->id);
        
        $writer->endElement();
    }
}