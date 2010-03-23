<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Document
{
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
        $this->writer->setIndent(true);
    }
    
    /**
     * Creates an omeka-xml instance for the entire repository.
     */
    public function writeDocument()
    {
        if ($writer = $this->writer) {
            $writer->startDocument('1.0', 'utf-8');
            $repository = new Export_OmekaXmlWriter_Container_Repository($writer);
            $repository->writeNode();
            $writer->endDocument();
            $writer->flush();
        }
        return self::DOCUMENT_FILENAME;
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
