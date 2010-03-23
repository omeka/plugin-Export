<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
abstract class Export_OmekaXmlWriter_Node
{
    const OMEKA_XML_NAMESPACE  = 'http://omeka.org/schemas/omeka-xml/v3';
    const OMEKA_XML_SCHEMA_URI = 'http://omeka.org/schemas/omeka-xml/v3/omeka-xml-3-0.xsd';
    const XSI_NAMESPACE        = 'http://www.w3.org/2001/XMLSchema-instance';
    
    protected $writer;
    
    public function __construct($writer) 
    {
        $this->writer = $writer;
    }
    
    protected function writeElementIfExists($elementName, $elementContents)
    {
        if ($elementContents) {
            $this->writer->writeElement($elementName, $elementContents);
        }
    }
    
    abstract public function writeNode();
}