<?php

abstract class Export_OmekaXmlWriter_Record extends Export_OmekaXmlWriter_Node
{
    protected $recordClass;
    protected $id;
    protected $record;
    
    public function __construct($writer, $id)
    {
        parent::__construct($writer);
        $this->id = $id;
    }
    
    protected function fetchRecord()
    {
        
    }
}