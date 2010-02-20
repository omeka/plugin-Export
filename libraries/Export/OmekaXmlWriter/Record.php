<?php

abstract class Export_OmekaXmlWriter_Record extends Export_OmekaXmlWriter_Node
{   
    protected $record;
    protected $fullOutput;
    
    public function __construct($writer, $record, $fullOutput = true)
    {
        parent::__construct($writer);
        $this->record = $record;
        $this->fullOutput = $fullOutput;
    }
    
    protected function writeElementIfExists($elementName, $elementContents)
    {
        if ($elementContents) {
            $this->writer->writeElement($elementName, $elementContents);
        }
    }
}