<?php

class Export_OmekaXmlWriter_Record_Entity extends Export_OmekaXmlWriter_Record
{   
    public function writeNode()
    {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('entity');
        
        $writer->writeAttribute('entityId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('firstName', $record->first_name);
            $this->writeElementIfExists('middleName', $record->middle_name);
            $this->writeElementIfExists('lastName', $record->last_name);
            $this->writeElementIfExists('email', $record->email);
            $this->writeElementIfExists('institution', $record->institution);
        }
        
        $writer->endElement();
    }
}