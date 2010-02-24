<?php

abstract class Export_OmekaXmlWriter_Container extends Export_OmekaXmlWriter_Node
{
    protected $records;
    
    public function __construct($writer, $records = null)
    {
        parent::__construct($writer);
        $this->records = $records;
    }
    
    public function writeNode()
    {
        $this->startContainer();
        $this->writeContents();
        $this->endContainer();
    }
    
    protected function startContainer()
    {
        $this->writer->startElement($this->getContainerName());
    }
    
    protected function endContainer()
    {
        $this->writer->endElement();
        $this->writer->flush();
    }
    
    abstract protected function writeContents();
    
    abstract protected function getContainerName();
}