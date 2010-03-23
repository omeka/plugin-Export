<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
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