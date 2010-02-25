<?php

class Export_OmekaXmlWriter_Record_File extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('file');
        $writer->writeAttribute('fileId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('src', $record->archive_filename);
            $this->writeElementIfExists('authentication', $record->authentication);
            
            if ($elementTextsByIds = $this->getElementTextsBySetAndElementIds($record)) {
                $writer->startElement('elementSetContainer');
                
                foreach ($elementTextsByIds as $setId => $elements) {
                    $writer->startElement('elementSet');
                    $writer->writeAttribute('elementSetId', $setId);
                    $writer->startElement('elementContainer');
                    foreach ($elements as $elementId => $elementTexts) {
                        $writer->startElement('element');
                        $writer->writeAttribute('elementId', $elementId);
                        foreach ($elementTexts as $elementText) {
                            $writer->startElement('elementText');
                            $writer->writeAttribute('elementTextId', $elementText->id);
                            $writer->writeElement('text', $elementText->text);
                            $writer->endElement();
                        }
                        $writer->endElement();
                    }
                    $writer->endElement();
                    $writer->endElement();
                }
                
                $writer->endElement();
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