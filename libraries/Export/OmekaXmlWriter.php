<?php
ini_set('display_errors', '1');

/**
 * Creates an omeka-xml instance for the entire repository.
 */
class Export_OmekaXmlWriter
{
    const OMEKA_XML_NAMESPACE  = 'http://omeka.org/schemas/omeka-xml/v2';
    const OMEKA_XML_SCHEMA_URI = 'http://omeka.org/schemas/omeka-xml/v2/omeka-xml-2-2.xsd';
    const XSI_NAMESPACE        = 'http://www.w3.org/2001/XMLSchema-instance';
    
    const DOCUMENT_FILENAME = 'repository.xml';
    
    protected $writer;
    
    /**
     * Initializes the XML writer.
     *
     * @param string $directory Export working directory
     */
    public function __construct($directory) {
        $this->writer = new XmlWriter();
        $this->writer->openURI($directory . DIRECTORY_SEPARATOR . self::DOCUMENT_FILENAME);
    }
    
    /**
     * Creates an omeka-xml instance for the entire repository.
     */
    public function writeDocument()
    {
        if ($writer = $this->writer) {
            $writer->startDocument('1.0', 'utf-8');
            $writer->startElementNS(null, 'repository', self::OMEKA_XML_NAMESPACE);
            $writer->writeAttributeNS('xsi', 'schemaLocation', self::XSI_NAMESPACE, self::OMEKA_XML_SCHEMA_URI);
            $this->writeRepositoryMetadata();
            $this->writeItemContainer();
            $this->writeEntityContainer();
            $writer->endElement();
            $writer->endDocument();
            $writer->flush();
        }
    }
    
    /**
     * Writes the XML metadata elements that apply to the repository as a whole.
     */
    protected function writeRepositoryMetadata()
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
    
    /**
     * Writes the element containing all the items in the repository.
     */
    protected function writeItemContainer()
    {
        $itemTable = get_db()->getTable('Item');
        if ($writer = $this->writer) {
            $writer->startElement('itemContainer');
            $limit = 10;
            $page = 0;
            while (count($items = $itemTable->findBy(array(), $limit, $page)) > 0) {
                foreach ($items as $item) {
                    $itemOutput = new Export_OmekaXmlItem($item, 'item');
                    $rawItemXml = $itemOutput->getXML();
                    $writer->writeRaw($rawItemXml);
                    release_object($item);
                }
                $writer->flush();
                $page++;
            }
            $writer->endElement();
        }
    }
    
    /**
     * Writes the element containing all the entities in the repository.
     */
    protected function writeEntityContainer()
    {
        if ($writer = $this->writer) {
            $writer->startElement('entityContainer');
            $writer->endElement();
        }
    }
}
