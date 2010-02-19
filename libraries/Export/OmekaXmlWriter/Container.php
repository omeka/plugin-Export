<?php

abstract class Export_OmekaXmlWriter_Container extends Export_OmekaXmlWriter_Node
{
    public function writeContainer()
    {
        $this->startContainer();
        $this->writeContents();
        $this->endContainer();
    }
    
    abstract protected function startContainer();
    
    abstract protected function endContainer();
    
    abstract protected function writeContents();
}