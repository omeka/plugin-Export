<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Record_File extends Export_OmekaXmlWriter_Record {
    
    public function writeNode() {
        $writer = $this->writer;
        $record = $this->record;
        
        $writer->startElement('file');
        $writer->writeAttribute('fileId', $record->id);
        
        if ($this->fullOutput) {
            $this->writeElementIfExists('src', $record->archive_filename);
            $this->writeElementIfExists('authentication', $record->authentication);
            
            Export_OmekaXmlWriter_Helper_ActsAsElementText::writeElementTexts($writer, $record);
        }
        
        $writer->endElement();
    }
}