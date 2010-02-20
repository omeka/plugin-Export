<?php

class Export_OmekaXmlWriter_Record_Element extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('element');
        $writer->writeAttribute('elementId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('name', $record->name);
            $this->writeElementIfExists('description', $record->description);
        } else {
            
        }
        
        $writer->endElement();
    }
}