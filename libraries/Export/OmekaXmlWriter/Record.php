<?php

abstract class Export_OmekaXmlWriter_Record extends Export_OmekaXmlWriter_Node
{   
    protected $record;
    
    public function __construct($writer, $record)
    {
        parent::__construct($writer);
        $this->record = $record;
    }
}