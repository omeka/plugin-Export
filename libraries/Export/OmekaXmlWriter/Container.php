<?php
/**
 * @package Export
 * @subpackage OmekaXmlWriter
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
abstract class Export_OmekaXmlWriter_Container extends Export_OmekaXmlWriter_Node
{
    /**
     * Number of records that will be fetched from the DB at once.
     */
    const RECORD_FETCH_LIMIT = 20;
    
    protected $records;
    protected $recordPage;
    
    public function __construct($writer, $records = null)
    {
        parent::__construct($writer);
        $this->records = $records;
        $this->recordPage = 1;
    }
    
    public function writeNode()
    {
        $this->startContainer();
        $this->writeContents();
        $this->endContainer();
    }
    
    protected function startContainer()
    {
        $this->writer->startElement($this->getContainerName());
    }
    
    protected function endContainer()
    {
        $this->writer->endElement();
        $this->writer->flush();
    }
    
    protected function getNextRecords($tableName)
    {
        $db = get_db();
        $table = $db->getTable($tableName);
        
        if ($this->recordPage > 0) {
            if ($records = $table->findBy(array(), self::RECORD_FETCH_LIMIT, $this->recordPage)) {
                $this->recordPage++;
                return $records;
            } else {
                $this->recordPage = 0;
            }
        }
        return null;
    }
    
    abstract protected function writeContents();
    
    abstract protected function getContainerName();
}