<?php

class Export_OmekaXmlWriter_Record_Entity extends Export_OmekaXmlWriter_Record
{   
    public function writeNode()
    {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('entity');
        
        $writer->writeAttribute('entityId', $record->id);
        if($firstName = $record->first_name) {
            $writer->writeElement('firstName', $firstName);
        }
        if($middleName = $record->middle_name) {
            $writer->writeElement('middleName', $middleName);
        }
        if($lastName = $record->last_name) {
            $writer->writeElement('lastName', $lastName);
        }
        if($email = $record->email) {
            $writer->writeElement('email', $email);
        }
        if($institution = $record->institution) {
            $writer->writeElement('institution', $institution);
        }
        
        $writer->endElement();
    }
}