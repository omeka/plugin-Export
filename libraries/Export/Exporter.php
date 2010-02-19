<?php

class Export_Exporter extends ProcessAbstract
{
    /**
     * Initial entry point from the background process bootstrapper.
     *
     * @param array $args Arguments for the exporter.
     */
    public function run($args) 
    {
        $directory = $this->createDirectory();
        $document = $this->createXmlDocument($directory);
        $this->createArchive(array($document));
    }
    
    /**
     * Creates a working directory in the system temporary directory with the
     * prefix "omeka_export_" and a suffix provided by tempnam().
     *
     * @return string The path of the created directory.
     */
    private function createDirectory() 
    {
        $name = tempnam(sys_get_temp_dir(), "omeka_export_");
        unlink($name);
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
        $zipBinPath = $this->getZipBinPath();
        
    }
    
    private function getZipBinPath()
    {
        $command = 'which zip 2>&0';
        $lastLineOutput = exec($command, $output, $exitCode);
        return $exitCode == 0 ? $lastLineOutput : false;
    }
    
    /**
     * Removes the temporary directory.
     */
    private function removeDirectory($directory) 
    {
        // for later
    }
}