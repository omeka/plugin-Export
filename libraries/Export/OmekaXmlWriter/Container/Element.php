<?php

class Export_OmekaXmlWriter_Container_Element extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'elementContainer';
    }
    
    protected function writeContents()
    {
        foreach($this->records as $element) {
            $elementNode = new Export_OmekaXmlWriter_Record_Element($this->writer, $element);
            $elementNode->writeNode();
        }
    }
}
