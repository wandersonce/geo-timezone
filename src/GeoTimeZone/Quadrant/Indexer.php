<?php

namespace GeoTimeZone\Quadrant;

use ErrorException;

class Indexer extends Tree
{
    const TARGET_INDEX_PERCENT = 0.96;
    const DEFAULT_ZONE_RESULT = -1;
    const LEVEL_DELIMITER_SYMBOL = ".";
    const TOTAL_LEVELS = 4;
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    protected $dataSourcePath = null;
    protected $dataSource;
    protected $timezones = array();
    protected $lookup = array();
    protected $currentQuadrants = array();
<<<<<<< HEAD


=======
    
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    public function __construct($dataDirectory = null, $dataSourcePath = null)
    {
        parent::__construct($dataDirectory);
        $this->setGeoDataSource($dataSourcePath);
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Initialize the current quadrants attribute for the first indexing iteration
     */
    protected function initCurrentQuadrants()
    {
        $this->currentQuadrants = array(
            array(
                "id" => Tree::LEVEL_A,
                "bounds" => array(0, 0, Tree::ABS_LONGITUDE_LIMIT, Tree::ABS_LATITUDE_LIMIT)
            ),
            array(
                "id" => Tree::LEVEL_B,
                "bounds" => array(-Tree::ABS_LONGITUDE_LIMIT, 0, 0, Tree::ABS_LATITUDE_LIMIT)
            ),
            array(
                "id" => Tree::LEVEL_C,
                "bounds" => array(-Tree::ABS_LONGITUDE_LIMIT, -Tree::ABS_LATITUDE_LIMIT, 0, 0)
            ),
            array(
                "id" => Tree::LEVEL_D,
                "bounds" => array(0, -Tree::ABS_LATITUDE_LIMIT, Tree::ABS_LONGITUDE_LIMIT, 0)
            )
        );
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Read the new timezones json to be indexed
     */
    protected function readDataSource()
    {
        if (isset($this->dataSourcePath) && is_file($this->dataSourcePath)) {
<<<<<<< HEAD
            ini_set('memory_limit', '-1'); //Remember to check your memory status.
            $jsonData = file_get_contents($this->dataSourcePath);
            $this->dataSource = json_decode($jsonData, true);
        } else {
            throw new ErrorException("ERROR: Data source path not found.");
        }
    }

=======
            $jsonData = file_get_contents($this->dataSourcePath);
            $this->dataSource = json_decode($jsonData, true);
        }else{
            throw new ErrorException("ERROR: Data source path not found.");
        }
    }
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Save timezones values from the reference file (timezones json) to timezones array attribute
     */
    protected function setTimezonesArray()
    {
        foreach ($this->dataSource['features'] as $feature) {
            $this->timezones[] = $feature['properties']['tzid'];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Find the timezones that intersect with or are within the quadrant polygon
     * @param $timezonesToInspect
     * @param $quadrantBounds
     * @return array
     */
    protected function whichTimeZonesIntersect($timezonesToInspect, $quadrantBounds)
    {
        $intersectedZones = [];
        $foundExactMatch = false;
        for ($inspectIdx = count($timezonesToInspect) - 1; $inspectIdx >= 0; $inspectIdx--) {
            $zoneIdx = $timezonesToInspect[$inspectIdx];
            echo $zoneIdx . "; ";
            $zoneJson = $this->dataSource['features'][$zoneIdx]['geometry'];
            if ($this->utils->intersectsPolygons($zoneJson, $quadrantBounds)) {
                if ($this->utils->withinPolygon($quadrantBounds, $zoneJson)) {
                    echo "Found match!\n";
                    $intersectedZones = $zoneIdx;
                    $foundExactMatch = true;
                    break;
                } else {
                    $intersectedZones[] = $zoneIdx;
                }
            }
        }
        return array(
            'foundExactMatch' => $foundExactMatch,
            'intersectedZones' => $intersectedZones
        );
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Create new level of quadrants from the previous bounds, the intersected found timezones and the previous zone ID
     * @param $zoneId
     * @param $intersectedZones
     * @param $quadrantBounds
     * @return array
     */
    protected function getNextQuadrants($zoneId, $intersectedZones, $quadrantBounds)
    {
        $topRight = array(
            'id' => $zoneId . '.a',
            'timezones' => $intersectedZones,
            'bounds' => [
<<<<<<< HEAD
                (float) ($quadrantBounds[0] + $quadrantBounds[2]) / 2,
                (float) ($quadrantBounds[1] + $quadrantBounds[3]) / 2,
=======
                (float)($quadrantBounds[0] + $quadrantBounds[2]) / 2,
                (float)($quadrantBounds[1] + $quadrantBounds[3]) / 2,
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
                $quadrantBounds[2],
                $quadrantBounds[3]
            ]
        );
<<<<<<< HEAD

=======
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        $topLeft = array(
            'id' => $zoneId . '.b',
            'timezones' => $intersectedZones,
            'bounds' => [
                $quadrantBounds[0],
<<<<<<< HEAD
                (float) ($quadrantBounds[1] + $quadrantBounds[3]) / 2.0,
                (float) ($quadrantBounds[0] + $quadrantBounds[2]) / 2.0,
                $quadrantBounds[3]
            ]
        );

=======
                (float)($quadrantBounds[1] + $quadrantBounds[3]) / 2.0,
                (float)($quadrantBounds[0] + $quadrantBounds[2]) / 2.0,
                $quadrantBounds[3]
            ]
        );
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        $bottomLeft = array(
            'id' => $zoneId . '.c',
            'timezones' => $intersectedZones,
            'bounds' => [
                $quadrantBounds[0],
                $quadrantBounds[1],
<<<<<<< HEAD
                (float) ($quadrantBounds[0] + $quadrantBounds[2]) / 2.0,
                (float) ($quadrantBounds[1] + $quadrantBounds[3]) / 2.0
            ]
        );

=======
                (float)($quadrantBounds[0] + $quadrantBounds[2]) / 2.0,
                (float)($quadrantBounds[1] + $quadrantBounds[3]) / 2.0
            ]
        );
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        $bottomRight = array(
            'id' => $zoneId . '.d',
            'timezones' => $intersectedZones,
            'bounds' => [
<<<<<<< HEAD
                (float) ($quadrantBounds[0] + $quadrantBounds[2]) / 2.0,
                $quadrantBounds[1],
                $quadrantBounds[2],
                (float) ($quadrantBounds[1] + $quadrantBounds[3]) / 2.0
            ]
        );

        return array($topRight, $topLeft, $bottomLeft, $bottomRight);
    }

=======
                (float)($quadrantBounds[0] + $quadrantBounds[2]) / 2.0,
                $quadrantBounds[1],
                $quadrantBounds[2],
                (float)($quadrantBounds[1] + $quadrantBounds[3]) / 2.0
            ]
        );
        
        return array($topRight, $topLeft, $bottomLeft, $bottomRight);
    }
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Select timezones to find the intersections
     * @param $previousTimezone
     * @return array
     */
    protected function selectTimeZonesToInspect($previousTimezone)
    {
        $timezonesToInspect = [];
        if (isset($previousTimezone['timezones'])) {
            $timezonesToInspect = $previousTimezone['timezones'];
        } else {
            for ($zoneIdx = count($this->dataSource['features']) - 1; $zoneIdx >= 0; $zoneIdx--) {
                $timezonesToInspect[] = $zoneIdx;
            }
        }
        return $timezonesToInspect;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Update the lookup table
     * @param $zoneResult
     * @param $curQuadrantId
     */
    protected function updateLookup($zoneResult, $curQuadrantId)
    {
        $levelPath = explode(self::LEVEL_DELIMITER_SYMBOL, $curQuadrantId);
        if ($zoneResult !== self::DEFAULT_ZONE_RESULT) {
            $this->addLevelToLookup($zoneResult, $levelPath);
        } else {
            $this->removeLevelFromLookup($levelPath);
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Get intersection features from current quadrant and each intersected timezone areas
     * @param $intersectionResult
     * @param $curQuadrant
     * @return array
     */
    protected function getIntersectionFeatures($intersectionResult, $curQuadrant)
    {
        $features = [];
        for ($zoneIdx = count($intersectionResult['intersectedZones']) - 1; $zoneIdx >= 0; $zoneIdx--) {
            $tzIdx = $intersectionResult['intersectedZones'][$zoneIdx];
            $quadrantBoundsGeoJson = $this->utils->createPolygonJsonFromPoints(
                $this->utils->adaptQuadrantBoundsToPolygon($curQuadrant['bounds'])
            );
<<<<<<< HEAD

            $intersectedArea = $this->utils->intersection(
                json_encode($this->dataSource['features'][$tzIdx]['geometry']),
                json_encode($quadrantBoundsGeoJson)
            );
=======
            
            $intersectedArea = $this->utils->intersection(
                json_encode($this->dataSource['features'][$tzIdx]['geometry']),
                json_encode($quadrantBoundsGeoJson));
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
            if ($intersectedArea) {
                $intersectedArea['properties']['tzid'] = $this->timezones[$tzIdx];
                $features[] = $intersectedArea;
            }
        }
        return $features;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Find the associated zones to the current quadrants and the next quadrants to be evaluated
     * @param $intersectionResult
     * @param $curQuadrant
     * @param $lastLevelFlag
     * @return array
     */
    protected function getAssociatedZonesAndNextQuadrants($intersectionResult, $curQuadrant, $lastLevelFlag)
    {
        $zoneResult = self::DEFAULT_ZONE_RESULT;
        $nextQuadrants = [];
        if (count($intersectionResult['intersectedZones']) === 1 && $intersectionResult['foundExactMatch']) {
            $zoneResult = $intersectionResult['intersectedZones'];
        } elseif (count($intersectionResult['intersectedZones']) > 0) {
            if ($lastLevelFlag) {
                $features = $this->getIntersectionFeatures($intersectionResult, $curQuadrant);
                $featuresCollection = $this->utils->getFeatureCollection($features);
                $featuresPath = $this->dataDirectory . str_replace('.', "/", $curQuadrant['id']) . "/";
                $this->writeGeoFeaturesToJson($featuresCollection, $featuresPath);
                $zoneResult = 'f';
            } else {
                $nextQuadrants = $this->getNextQuadrants(
                    $curQuadrant['id'],
                    $intersectionResult['intersectedZones'],
                    $curQuadrant['bounds']
                );
                $zoneResult = array(
                    'a' => $intersectionResult['intersectedZones'],
                    'b' => $intersectionResult['intersectedZones'],
                    'c' => $intersectionResult['intersectedZones'],
                    'd' => $intersectionResult['intersectedZones']
                );
            }
        }
        return array(
            'zoneResult' => $zoneResult,
            'nextQuadrants' => $nextQuadrants
        );
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Check if the current indexing iteration should be carry on or not
     * @param $curLevel
     * @param $numQuadrants
     * @return bool
     */
    protected function validIndexingPercentage($curLevel, $numQuadrants)
    {
        $expectedAtLevel = pow(self::TOTAL_LEVELS, $curLevel + 1);
        $curPctIndexed = ($expectedAtLevel - $numQuadrants) / $expectedAtLevel;
        echo "\nIteration " . $curLevel . "\n Num quadrants: " . $numQuadrants . "\n";
        echo " Indexing percentage: " . $curPctIndexed . "\n";
        return $curPctIndexed < self::TARGET_INDEX_PERCENT;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Index current quadrants and get the new ones
     * @param $lastLevelFlag
     * @return array
     */
    protected function indexQuadrants($lastLevelFlag)
    {
        $nextQuadrants = array();
        for ($levelIdx = count($this->currentQuadrants) - 1; $levelIdx >= 0; $levelIdx--) {
            $curQuadrant = $this->currentQuadrants[$levelIdx];
            $nextStep = $this->findTimezonesAndNextQuadrants($lastLevelFlag, $curQuadrant);
            $this->updateLookup($nextStep['zoneResult'], $curQuadrant['id']);
            $nextQuadrants = array_merge($nextQuadrants, $nextStep['nextQuadrants']);
        }
        return $nextQuadrants;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Main function that run all index processing
     */
    protected function generateIndexes()
    {
        $this->initCurrentQuadrants();
        $curLevel = 1;
        $numQuadrants = 16;
        $lastLevel = 0;
<<<<<<< HEAD

=======
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        while ($this->validIndexingPercentage($curLevel, $numQuadrants)) {
            $curLevel += 1;
            $this->currentQuadrants = $this->indexQuadrants($lastLevel);
            $numQuadrants = count($this->currentQuadrants);
        }
        echo "\nLast iteration... \n";
        $lastLevel = 1;
        $this->currentQuadrants = $this->indexQuadrants($lastLevel);
        echo "\nWriting quadrant tree json...\n";
        $this->writeQuadrantTreeJson();
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Create the directory tree
     * @param $path
     */
    protected function createDirectoryTree($path)
    {
        $directories = explode($this->dataDirectory, $path)[1];
        $directories = explode("/", $directories);
        $currentDir = $this->dataDirectory;
        foreach ($directories as $dir) {
            $currentDir = $currentDir . "/" . $dir;
            if (!is_dir($currentDir)) {
                mkdir($currentDir);
            }
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Create json file from timezone features
     * @param $features
     * @param $path
     * @return bool|int
     */
    protected function writeGeoFeaturesToJson($features, $path)
    {
        $writtenBytes = false;
        $this->createDirectoryTree($path);
        if ($path && is_writable($path)) {
            $full = $path . DIRECTORY_SEPARATOR . Tree::GEO_FEATURE_FILENAME;
            $writtenBytes = file_put_contents($full, json_encode($features));
        }
        return $writtenBytes;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Build tree array to be save in a json file later
     * @return array
     */
    protected function buildTree()
    {
        $tree = array(
            'timezones' => $this->timezones,
            'lookup' => $this->lookup
        );
        return $tree;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Write the quadrant tree in a json file
     * @return bool|int
     */
    protected function writeQuadrantTreeJson()
    {
        $writtenBytes = false;
        $tree = $this->buildTree();
        $path = realpath($this->dataDirectory);
        if ($path && is_writable($path)) {
            $full = $path . DIRECTORY_SEPARATOR . Tree::DATA_TREE_FILENAME;
            $writtenBytes = file_put_contents($full, json_encode($tree));
        }
        return $writtenBytes;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Set the input data source
     * @param $path
     * @throws ErrorException
     */
    public function setGeoDataSource($path)
    {
        if (isset($path) && is_file($path)) {
            $this->dataSourcePath = $path;
<<<<<<< HEAD
        } else {
            throw new ErrorException("ERROR: Geo data source path not found.");
        }
    }

=======
        }else{
            throw new ErrorException("ERROR: Geo data source path not found.");
        }
    }
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Main public function that starts all processing
     */
    public function createQuadrantTreeData()
    {
        echo "Reading data source...\n";
        $this->readDataSource();
        echo "Saving timezones array...\n";
        $this->setTimezonesArray();
        echo "Generating indexes...\n";
        $this->generateIndexes();
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Find the intersected timezones and the next quadrant to be evaluated
     * @param $lastLevelFlag
     * @param $curQuadrant
     * @return array
     */
    protected function findTimezonesAndNextQuadrants($lastLevelFlag, $curQuadrant)
    {
        $quadrantBounds = $curQuadrant['bounds'];
        $timezonesToInspect = $this->selectTimeZonesToInspect($curQuadrant);
        $intersectionResult = $this->whichTimeZonesIntersect($timezonesToInspect, $quadrantBounds);
        $zonesAndNextQuadrants = $this->getAssociatedZonesAndNextQuadrants(
            $intersectionResult,
            $curQuadrant,
<<<<<<< HEAD
            $lastLevelFlag
        );
        return $zonesAndNextQuadrants;
    }

=======
            $lastLevelFlag);
        return $zonesAndNextQuadrants;
    }
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Add level to the lookup table where the quadrant tree is being defined
     * @param $zoneResult
     * @param $levelPath
     * @return mixed
     */
    protected function addLevelToLookup($zoneResult, $levelPath)
    {
        $level = &$this->lookup;
        foreach ($levelPath as $levelId) {
            $level = &$level[$levelId];
        }
        $level = $zoneResult;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Remove level from the lookup table where the quadrant tree is being defined
     * @param $levelPath
     */
    protected function removeLevelFromLookup($levelPath)
    {
        $level = &$this->lookup;
        $levelId = "a";
        foreach ($levelPath as $idx => $levelId) {
            if (isset($level[$levelId])) {
                if ($idx < count($levelPath) - 1) {
                    $level = &$level[$levelId];
                }
            }
        }
        unset($level[$levelId]);
    }
}
