<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Record_Item extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('item');
        $writer->writeAttribute('itemId', $record->id);
        
        if ($this->fullOutput) {
            if ($files = $record->getFiles()) {
                $filesContainer = new Export_OmekaXmlWriter_Container_File($writer, $files);
                $filesContainer->writeNode();
            }
            
            if ($collection = $record->getCollection()) {
                $collectionNode = new Export_OmekaXmlWriter_Record_Collection($writer, $collection, false);
                $collectionNode->writeNode();
            }
            
            if ($itemType = $record->getItemType()) {
                $itemTypeNode = new Export_OmekaXmlWriter_Record_ItemType($writer, $itemType, false);
                $itemTypeNode->writeNode();
            }
            
            if ($elementTextsByIds = $this->getElementTextsBySetAndElementIds($record)) {
                $writer->startElement('elementSetContainer');
                
                foreach ($elementTextsByIds as $setId => $elements) {
                    $writer->startElement('elementSet');
                    $writer->writeAttribute('elementSetId', $setId);
                    $writer->startElement('elementContainer');
                    foreach ($elements as $elementId => $elementTexts) {
                        $writer->startElement('element');
                        $writer->writeAttribute('elementId', $elementId);
                        $elementTextContainer = new Export_OmekaXmlWriter_Container_ElementText($writer, $elementTexts);
                        $elementTextContainer->writeNode();
                        $writer->endElement();
                    }
                    $writer->endElement();
                    $writer->endElement();
                }
                
                $writer->endElement();
            }
            
            if ($tags = $record->getTags()) {
                $tagsContainer = new Export_OmekaXmlWriter_Container_Tag($writer, $tags);
                $tagsContainer->writeNode();
            }
        }
        
        $writer->endElement();
    }
    
    private function getElementTextsBySetAndElementIds($record) {
        $elementTexts = array();
        foreach ($record->getAllElementsBySet() as $setName => $elements) {
            $elementSet = get_db()->getTable('ElementSet')->findByName($setName);
            foreach ($elements as $element) {
                foreach ($record->getTextsByElement($element) as $elementText) {
                    $elementTexts[$elementSet->id][$element->id][] = $elementText;
                }
            }
        }
        return $elementTexts;
    }
}