<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Export_OmekaXmlWriter_Helper_PublicFeatured
{
    static public function addAttributes($writer, $record) {
        if ($record->isPublic()) {
            $publicValue = 'true';
        } else {
            $publicValue = 'false';
        }
        $writer->writeAttribute('public', $publicValue);

        if ($record->isFeatured()) {
            $featuredValue = 'true';
        } else {
            $featuredValue = 'false';
        }
        $writer->writeAttribute('featured', $featuredValue);
    }
}
