<?php

class Export_OmekaXmlWriter_Record_Collection extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('collection');
        
        $writer->writeAttribute('collectionId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('name', $record->name);
            $this->writeElementIfExists('description', $record->description);
            $writer->startElement('collectorContainer');
            foreach ($record->getCollectors() as $collector) {
                $collectorNode = new Export_OmekaXmlWriter_Record_Entity($writer, $collector, false);
                $collectorNode->writeNode();
            }
            $writer->endElement();
        }
        
        $writer->endElement();
    }
}