<?php

abstract class Export_OmekaXmlWriter_Container extends Export_OmekaXmlWriter_Node
{
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
    }
    
    abstract protected function writeContents();
    
    abstract protected function getContainerName();
}