<?php

class Export_OmekaXmlWriter_Record_ItemType extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('itemType');
        $writer->writeAttribute('itemTypeId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('name', $record->name);
            $this->writeElementIfExists('description', $record->description);
            
            if ($elements = $record->Elements) {
                $writer->startElement('elementContainer');
                foreach ($elements as $element) {
                    $elementNode = new Export_OmekaXmlWriter_Record_Element($writer, $element, false);
                    $elementNode->writeNode();
                }
                $writer->endElement();
            }
        }
        
        $writer->endElement();
    }
}