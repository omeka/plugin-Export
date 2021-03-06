<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Record_ElementText extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('elementText');
        $writer->writeAttribute('elementTextId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('text', $record->text);
        }
        
        $writer->endElement();
    }
}