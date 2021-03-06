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
        Export_OmekaXmlWriter_Helper_PublicFeatured::writeAttributes($writer, $record);
        
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

            Export_OmekaXmlWriter_Helper_ActsAsElementText::writeElementTexts($writer, $record);
            
            if ($tags = $record->getTags()) {
                $tagsContainer = new Export_OmekaXmlWriter_Container_Tag($writer, $tags);
                $tagsContainer->writeNode();
            }
        }
        
        $writer->endElement();
    }
}