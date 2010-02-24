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
        $elementSetContainer = new Export_OmekaXmlWriter_Container_ElementSet($this->writer);
        $elementSetContainer->writeNode();
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
            
            if ($title = get_option('site_title')) {
                $writer->writeElement('title', $title);
            }
            if ($copyright = get_option('copyright')) {
                $writer->writeElement('copyright', $copyright);
            }
            if ($author = get_option('author')) {
                $writer->writeElement('author', $author);
            }
            if ($description = get_option('description')) {
                $writer->writeElement('description', $description);
            }
        }
    }
}
