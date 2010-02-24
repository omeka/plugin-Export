<?php

class Export_OmekaXmlWriter_Container_ElementSet extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'elementSetContainer';
    }
    
    protected function writeContents()
    {
        $db = get_db();
        $table = $db->getTable('ElementSet');
        //echo var_dump($table);
        
        $elementSets = $table->findAll();
        foreach($elementSets as $elementSet) {
            $elementSetNode = new Export_OmekaXmlWriter_Record_ElementSet($this->writer, $elementSet);
            $elementSetNode->writeNode();
        }
    }
}
