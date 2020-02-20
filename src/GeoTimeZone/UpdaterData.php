<?php

namespace GeoTimeZone;

use ZipArchive;
use ErrorException;
use GuzzleHttp\Client;
use GeoTimeZone\Quadrant\Indexer;


class UpdaterData
{
    const DOWNLOAD_DIR = "downloads/";
    const TIMEZONE_FILE_NAME = "timezones";
    const REPO_HOST = "https://api.github.com";
    const REPO_USER = "node-geo-tz";
    const REPO_PATH = "/repos/evansiroky/timezone-boundary-builder/releases/latest";
    const GEO_JSON_DEFAULT_URL = "none";
    const GEO_JSON_DEFAULT_NAME = "geojson";
<<<<<<< HEAD

    protected $mainDir = null;
    protected $downloadDir = null;
    protected $timezonesSourcePath = null;

=======
    
    protected $mainDir = null;
    protected $downloadDir = null;
    protected $timezonesSourcePath = null;
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * UpdaterData constructor.
     * @param $dataDirectory
     * @throws ErrorException
     */
    public function __construct($dataDirectory = null)
    {
        if ($dataDirectory == null) {
<<<<<<< HEAD
            throw new ErrorException("ERROR: Ivalid data directory.");
        } else {
=======
            throw new ErrorException("ERROR: Invalid data directory.");
        }else{
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
            $this->mainDir = $dataDirectory;
            $this->downloadDir = $dataDirectory . "/" . self::DOWNLOAD_DIR;
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Get complete json response from repo
     * @param $url
     * @return mixed
     */
    protected function getResponse($url)
    {
        $client = new Client();
        $response = $client->request('GET', $url);
        return $response->getBody()->getContents();
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Download zip file
     * @param $url
     * @param string $destinationPath
     */
    protected function getZipResponse($url, $destinationPath = "none")
    {
        exec("wget {$url} --output-document={$destinationPath}");
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Get timezones json url
     * @param $data
     * @return string
     */
    protected function getGeoJsonUrl($data)
    {
        $jsonResp = json_decode($data, true);
        $geoJsonUrl = self::GEO_JSON_DEFAULT_URL;
        foreach ($jsonResp['assets'] as $asset) {
            if (strpos($asset['name'], self::GEO_JSON_DEFAULT_NAME)) {
                $geoJsonUrl = $asset['browser_download_url'];
                break;
            }
        }
        return $geoJsonUrl;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Download last version reference repo
     */
    protected function downloadLastVersion()
    {
        $response = $this->getResponse(self::REPO_HOST . self::REPO_PATH);
        $geoJsonUrl = $this->getGeoJsonUrl($response);
        if ($geoJsonUrl != self::GEO_JSON_DEFAULT_URL) {
            if (!is_dir($this->mainDir)) {
<<<<<<< HEAD
                mkdir($this->mainDir, 0777, true);
            }
            if (!is_dir($this->downloadDir)) {
                mkdir($this->downloadDir, 0777, true);
=======
                mkdir($this->mainDir);
            }
            if (!is_dir($this->downloadDir)) {
                mkdir($this->downloadDir);
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
            }
            $this->getZipResponse($geoJsonUrl, $this->downloadDir . self::TIMEZONE_FILE_NAME . ".zip");
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Unzip data
     * @param $filePath
     * @return bool
     */
    protected function unzipData($filePath)
    {
        $zip = new ZipArchive();
        $controlFlag = false;
        if ($zip->open($filePath) === TRUE) {
            $zipName = basename($filePath, ".zip");
            if (!is_dir($this->downloadDir . $zipName)) {
                mkdir($this->downloadDir . $zipName);
            }
            echo $this->downloadDir . $zipName . "\n";
            $zip->extractTo($this->downloadDir . $zipName);
            $zip->close();
            $controlFlag = true;
            unlink($filePath);
        }
        return $controlFlag;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Rename downloaded timezones json file
     * @return bool
     */
    protected function renameTimezoneJson()
    {
<<<<<<< HEAD
        $path = realpath($this->downloadDir . self::TIMEZONE_FILE_NAME . "\\");
=======
        $path = realpath($this->downloadDir . self::TIMEZONE_FILE_NAME . "/");
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        $jsonPath = "";
        foreach ($files as $pathFile => $file) {
            if (strpos($pathFile, ".json")) {
                $jsonPath = $pathFile;
                break;
            }
        }
<<<<<<< HEAD
        $this->timezonesSourcePath = dirname($jsonPath) . "\\" . self::TIMEZONE_FILE_NAME . ".json";
        echo $this->timezonesSourcePath . "\n";
        return rename($jsonPath, $this->timezonesSourcePath);
    }

=======
        $this->timezonesSourcePath = dirname($jsonPath) . "/" . self::TIMEZONE_FILE_NAME . ".json";
        echo $this->timezonesSourcePath . "\n";
        return rename($jsonPath, $this->timezonesSourcePath);
    }
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Remove all directories tree in a particular data folder
     * @param $path
     * @param $validDir
     */
    protected function removeData($path, $validDir = null)
    {
        $removeAll = !$validDir ? true : false;
<<<<<<< HEAD

=======
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        if (is_dir($path)) {
            $objects = scandir($path);
            foreach ($objects as $object) {
                $objectPath = $path . "/" . $object;
                if ($object != "." && $object != "..") {
                    if (is_dir($objectPath)) {
                        if (in_array(basename($object), $validDir) || $removeAll) {
                            $this->removeData($objectPath, $validDir);
                        }
<<<<<<< HEAD
                    } else if ($objectPath) {
=======
                    } else {
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
                        unlink($objectPath);
                    }
                }
            }
            if (in_array(basename($path), $validDir) || $removeAll) {
                rmdir($path);
            }
        }
        return;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Remove data tree
     */
    protected function removeDataTree()
    {
        $validDir = [
            Indexer::LEVEL_A,
            Indexer::LEVEL_B,
            Indexer::LEVEL_C,
            Indexer::LEVEL_D
        ];
        $this->removeData($this->mainDir . "/", $validDir);
    }
<<<<<<< HEAD


=======
    
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Remove downloaded data
     */
    protected function removeDownloadedData()
    {
        $validDir = array("downloads", "timezones", "dist");
        $this->removeData($this->downloadDir, $validDir);
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Add folder to zip file
     * @param $mainDir
     * @param $zip
     * @param $exclusiveLength
     */
    protected function folderToZip($mainDir, &$zip, $exclusiveLength)
    {
        $handle = opendir($mainDir);
        while (false !== $f = readdir($handle)) {
            if ($f != '.' && $f != '..') {
                $filePath = "$mainDir/$f";
                $localPath = substr($filePath, $exclusiveLength);
                if (is_file($filePath)) {
                    $zip->addFile($filePath, $localPath);
                } elseif (is_dir($filePath)) {
                    $zip->addEmptyDir($localPath);
                    $this->folderToZip($filePath, $zip, $exclusiveLength);
                }
            }
        }
        closedir($handle);
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Compress directory
     * @param $sourcePath
     * @param $outZipPath
     */
    protected function zipDir($sourcePath, $outZipPath)
    {
        $pathInfo = pathInfo($sourcePath);
        $parentPath = $pathInfo['dirname'];
        $dirName = $pathInfo['basename'];
<<<<<<< HEAD

=======
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        $z = new ZipArchive();
        $z->open($outZipPath, ZIPARCHIVE::CREATE);
        $z->addEmptyDir($dirName);
        $this->folderToZip($sourcePath, $z, strlen("$parentPath/"));
        $z->close();
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Main function that runs all updating process
     */
    public function updateData()
    {
        echo "Downloading data...\n";
        $this->downloadLastVersion();
        echo "Unzip data...\n";
        $this->unzipData($this->downloadDir . self::TIMEZONE_FILE_NAME . ".zip");
        echo "Rename timezones json...\n";
        $this->renameTimezoneJson();
        echo "Remove previous data...\n";
        $this->removeDataTree();
        echo "Creating quadrant tree data...\n";
        $geoIndexer = new Indexer($this->mainDir, $this->timezonesSourcePath);
        $geoIndexer->createQuadrantTreeData();
        echo "Remove downloaded data...\n";
        $this->removeDownloadedData();
        echo "Zipping quadrant tree data...";
        $this->zipDir($this->mainDir, $this->mainDir . ".zip");
    }
}
<<<<<<< HEAD
=======

>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
