<?php

class Export_OmekaXmlWriter_Record_ItemType extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('itemType');
        $writer->writeAttribute('itemTypeId', $record->id);
        
        $writer->endElement();
    }
}