<?php

class Export_OmekaXmlWriter_Container_Repository extends Export_OmekaXmlWriter_Container
{    
    protected function getContainerName()
    {
        return 'repository';
    }
    
    protected function startContainer()
    {
        $this->writer->startElementNS(null, 'repository', self::OMEKA_XML_NAMESPACE);
        $this->writer->writeAttributeNS('xsi', 'schemaLocation', self::XSI_NAMESPACE, self::OMEKA_XML_NAMESPACE . ' ' . self::OMEKA_XML_SCHEMA_URI);
    }
    
    protected function writeContents()
    {
        $this->writeRepositoryMetadata();
        $itemContainer = new Export_OmekaXmlWriter_Container_Item($this->writer);
        $itemContainer->writeNode();
        $collectionContainer = new Export_OmekaXmlWriter_Container_Collection($this->writer);
        $collectionContainer->writeNode();
        $itemTypeContainer = new Export_OmekaXmlWriter_Container_ItemType($this->writer);
        $itemTypeContainer->writeNode();
        $elementSetContainer = new Export_OmekaXmlWriter_Container_ElementSet($this->writer);
        $elementSetContainer->writeNode();
        $tagContainer = new Export_OmekaXmlWriter_Container_Tag($this->writer);
        $tagContainer->writeNode();
        $entityContainer = new Export_OmekaXmlWriter_Container_Entity($this->writer);
        $entityContainer->writeNode();
    }
    
    /**
     * Writes the XML metadata elements that apply to the repository as a whole.
     */
    private function writeRepositoryMetadata()
    {
        if ($writer = $this->writer) {
            $writer->writeAttribute('accessDate', date('c'));
            
            $this->writeElementIfExists('title', get_option('site_title'));
            $this->writeElementIfExists('copyright', get_option('copyright'));
            $this->writeElementIfExists('author', get_option('author'));
            $this->writeElementIfExists('description', get_option('description'));
        }
    }
}
