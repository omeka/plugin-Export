<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
abstract class Export_OmekaXmlWriter_Record extends Export_OmekaXmlWriter_Node
{   
    protected $record;
    protected $fullOutput;
    
    public function __construct($writer, $record, $fullOutput = true)
    {
        parent::__construct($writer);
        $this->record = $record;
        $this->fullOutput = $fullOutput;
    }
}