<?php

class Export_OmekaXmlWriter_Record_Item extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('item');
        $writer->writeAttribute('itemId', $record->id);
        
        if ($this->fullOutput) {
            if ($collection = $record->getCollection()) {
                $collectionNode = new Export_OmekaXmlWriter_Record_Collection($writer, $collection, false);
                $collectionNode->writeNode();
            }
            
            if ($itemType = $record->getItemType()) {
                $itemTypeNode = new Export_OmekaXmlWriter_Record_ItemType($writer, $itemType, false);
                $itemTypeNode->writeNode();
            }
            
            if ($tags = $record->getTags()) {
                $tagsContainer = new Export_OmekaXmlWriter_Container_Tag($writer, $tags);
                $tagsContainer->writeNode();
            }
        }
        
        $writer->endElement();
    }
}