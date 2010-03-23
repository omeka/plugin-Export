<?php
/**
 * @package Export
 * @subpackage Models
 * @copyright Copyright (c) 2009-2010 Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */
class ExportSnapshotTable extends Omeka_Db_Table {
    
    public function findByProcessId($processId)
    {
        $select = $this->getSelect()->where('process = ?', $processId);
        return $this->fetchObject($select);
    }
}