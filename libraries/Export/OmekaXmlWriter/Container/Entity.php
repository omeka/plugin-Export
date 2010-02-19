<?php

class Export_OmekaXmlWriter_Container_Entity extends Export_OmekaXmlWriter_Container
{
    protected function getContainerName()
    {
        return 'entityContainer';
    }
    
    protected function writeContents()
    {   
        $db = get_db();
        $table = $db->getTable('Entity');
        
        $entities = $table->findAll();
        foreach($entities as $entity) {
            $entityNode = new Export_OmekaXmlWriter_Record_Entity($this->writer, $entity);
            echo 'an entity';
            $entityNode->writeNode();
        }
    }
}