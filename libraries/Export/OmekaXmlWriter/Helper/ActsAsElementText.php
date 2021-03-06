<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Helper_ActsAsElementText
{   
    static public function writeElementTexts($writer, $record) {
        if ($elementTextsByIds = self::getElementTextsBySetAndElementIds($record)) {
            $writer->startElement('elementSetContainer');

            foreach ($elementTextsByIds as $setId => $elements) {
                $writer->startElement('elementSet');
                $writer->writeAttribute('elementSetId', $setId);
                $writer->startElement('elementContainer');
                foreach ($elements as $elementId => $elementTexts) {
                    $writer->startElement('element');
                    $writer->writeAttribute('elementId', $elementId);
                    $elementTextContainer = new Export_OmekaXmlWriter_Container_ElementText($writer, $elementTexts);
                    $elementTextContainer->writeNode();
                    $writer->endElement();
                }
                $writer->endElement();
                $writer->endElement();
            }

            $writer->endElement();
        }
    }

    static private function getElementTextsBySetAndElementIds($record) {
        $elementTexts = array();
        foreach ($record->getAllElementsBySet() as $setName => $elements) {
            $elementSet = get_db()->getTable('ElementSet')->findByName($setName);
            foreach ($elements as $element) {
                foreach ($record->getTextsByElement($element) as $elementText) {
                    $elementTexts[$elementSet->id][$element->id][] = $elementText;
                }
            }
        }
        return $elementTexts;
    }
}
