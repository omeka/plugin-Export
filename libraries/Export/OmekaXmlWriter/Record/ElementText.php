<?php

class Export_OmekaXmlWriter_Record_ElementText extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('elementText');
        $writer->writeAttribute('elementTextId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('text', $record->text);
        }
        
        $writer->endElement();
    }
}