<?php

class Export_OmekaXmlWriter_Record_Item extends Omeka_Output_Xml_Item {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('item');
        $writer->writeAttribute('itemId', $record->id);
        
        $writer->endElement();
    }
}