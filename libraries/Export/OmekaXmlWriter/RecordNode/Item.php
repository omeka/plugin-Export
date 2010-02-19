<?php

class Export_OmekaXmlWriter_Node_Item extends Omeka_Output_Xml_Item {
    protected function _setRootElement($rootElement) {
        return $rootElement;
    }
    
    public function getXML() {
        $doc = $this->getDoc();
        $root = $doc->documentElement;
        return $doc->saveXML($root);
    }
}