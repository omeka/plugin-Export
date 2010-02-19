<?php

class Export_OmekaXmlWriter_Record_Item extends Omeka_Output_Xml_Item {
    // This is all out of date.
    protected function _setRootElement($rootElement) {
        return $rootElement;
    }
    
    public function getXML() {
        $doc = $this->getDoc();
        $root = $doc->documentElement;
        return $doc->saveXML($root);
    }
}