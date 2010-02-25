<?php

class ExportSnapshotTable extends Omeka_Db_Table {
    
    public function findByProcessId($processId)
    {
        $select = $this->getSelect()->where('process = ?', $processId);
        return $this->fetchObject($select);
    }
}