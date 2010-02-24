<?php

class Export_OmekaXmlWriter_Record_ElementSet extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('elementSet');
        $writer->writeAttribute('elementSetId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('name', $record->name);
            $this->writeElementIfExists('description', $record->description);
            
            $elementContainer = new Export_OmekaXmlWriter_Container_Element($writer, $record->getElements());
            $elementContainer->writeNode();
        }
        
        $writer->endElement();
    }
}
