<?php

class Export_Exporter extends ProcessAbstract
{
    private $baseDir;
    
    /**
     * Initial entry point from the background process bootstrapper.
     *
     * @param array $args Arguments for the exporter.
     */
    public function run($args) 
    {
        $this->baseDir = get_option('export_save_directory');
        $directory = $this->createDirectory();
        $document = $this->createXmlDocument($directory);
        $archiveName = $this->createArchive(array($document));
        
        unlink($document);
        rmdir($directory);
        
        $snapshot = get_db()->getTable('ExportSnapshot')->find($args['snapshotId']);
        $snapshot->archive = $archiveName;
        $snapshot->save();
    }
    
    /**
     * Creates a working directory in the system temporary directory with the
     * prefix "work_" and a suffix provided by tempnam().
     *
     * @return string The path of the created directory.
     */
    private function createDirectory() 
    {
        $filter = new Omeka_Filter_Filename();
        $name = $this->baseDir . DIRECTORY_SEPARATOR . $filter->renameFileForArchive('work');
        mkdir($name);
        return $name;
    }
    
    /**
     * Creates an XML document containing all the metadata for the entire 
     * repository.
     */
    private function createXmlDocument($directory) 
    {
        $xmlWriter = new Export_OmekaXmlWriter_Document($directory);
        return $directory . DIRECTORY_SEPARATOR . $xmlWriter->writeDocument();
    }
    
    private function createArchive($paths)
    {
        $filter = new Omeka_Filter_Filename();
        $zipName = $this->baseDir . DIRECTORY_SEPARATOR . $filter->renameFileForArchive('snapshot.zip');
        $filesToCompress = implode(' ', $paths);
        
        $zipBinPath = $this->getZipBinPath();
        chdir(ARCHIVE_DIR);
        $command = "$zipBinPath $zipName -r files -x \"*index.html\" -x \"*.svn*\"";
        exec($command);
        $command = "$zipBinPath $zipName -j $filesToCompress";
        exec($command);
        
        return $zipName;  
    }
    
    private function getZipBinPath()
    {
        $command = 'which zip 2>&0';
        $lastLineOutput = exec($command, $output, $exitCode);
        return $exitCode == 0 ? $lastLineOutput : false;
    }
}