<?php

namespace GeoTimeZone;

use DateTime;
use DateTimeZone;
use ErrorException;
use GeoTimeZone\Quadrant\Tree;

class Calculator
{
    protected $quadrantTree;
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * TimeZone constructor.
     * @param $dataDirectory
     * @throws ErrorException
     */
    public function __construct($dataDirectory = null)
    {
        if (isset($dataDirectory) && is_dir($dataDirectory)) {
            $this->quadrantTree = new Tree($dataDirectory);
            $this->quadrantTree->initializeDataTree();
<<<<<<< HEAD
        } else {
            throw new ErrorException('Invalid data tree directory: ' . $dataDirectory);
        }
    }

=======
        }else{
            throw new ErrorException('Invalid data tree directory: ' . $dataDirectory);
        }
    }
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Adjust the latitude value
     * @param $latitude
     * @return float|int
     * @throws ErrorException
     */
    protected function adjustLatitude($latitude)
    {
        $newLatitude = $latitude;
        if (null == $latitude || abs($latitude) > Tree::MAX_ABS_LATITUDE) {
            throw new ErrorException('Invalid latitude: ' . $latitude);
        }
        if (abs($latitude) == Tree::MAX_ABS_LATITUDE) {
            $newLatitude = ($latitude <=> 0) * Tree::ABS_LATITUDE_LIMIT;
        }
        return $newLatitude;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Adjust longitude value
     * @param $longitude
     * @return float|int
     * @throws ErrorException
     */
    protected function adjustLongitude($longitude)
    {
        $newLongitude = $longitude;
        if (null == $longitude || abs($longitude) > Tree::MAX_ABS_LONGITUDE) {
            throw new ErrorException('Invalid longitude: ' . $longitude);
        }
        if (abs($longitude) == Tree::MAX_ABS_LONGITUDE) {
            $newLongitude = ($longitude <=> 0) * Tree::ABS_LONGITUDE_LIMIT;
        }
        return $newLongitude;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Get timezone name from a particular location (latitude, longitude)
     * @param $latitude
     * @param $longitude
     * @return string
     * @throws ErrorException
     */
    public function getTimeZoneName($latitude, $longitude)
    {
        $timeZone = Tree::NONE_TIMEZONE;
        try {
            $latitude = $this->adjustLatitude($latitude);
            $longitude = $this->adjustLongitude($longitude);
            $timeZone = $this->quadrantTree->lookForTimezone($latitude, $longitude);
<<<<<<< HEAD
        } catch (ErrorException $error) {
=======
        }catch (ErrorException $error){
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
            throw $error;
        }
        return $timeZone;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Get the local date belonging to a particular latitude, longitude and timestamp
     * @param $latitude
     * @param $longitude
     * @param $timestamp
     * @return DateTime
     * @throws ErrorException
     */
    public function getLocalDate($latitude, $longitude, $timestamp)
    {
        $date = new DateTime();
        try {
            $timeZone = $this->getTimeZoneName($latitude, $longitude);
            $date->setTimestamp($timestamp);
            if ($timeZone != Tree::NONE_TIMEZONE) {
                $date->setTimezone(new DateTimeZone($timeZone));
            }
<<<<<<< HEAD
        } catch (ErrorException $error) {
=======
        }catch (ErrorException $error){
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
            throw $error;
        }
        return $date;
    }
<<<<<<< HEAD

=======
    
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    /**
     * Get timestamp from latitude, longitude and localTimestamp
     * @param $latitude
     * @param $longitude
     * @param $localTimestamp
     * @return mixed
     * @throws ErrorException
     */
    public function getCorrectTimestamp($latitude, $longitude, $localTimestamp)
    {
        $timestamp = $localTimestamp;
        try {
            $timeZoneName = $this->getTimeZoneName($latitude, $longitude);
            if ($timeZoneName != Tree::NONE_TIMEZONE) {
                $date = new DateTime();
                $date->setTimestamp($localTimestamp);
                if ($timeZoneName != null) {
                    $date->setTimezone(new DateTimeZone($timeZoneName));
                }
                $timestamp = $date->getOffset() != false ? $localTimestamp - $date->getOffset() : $localTimestamp;
            }
<<<<<<< HEAD
        } catch (ErrorException $error) {
=======
        }catch(ErrorException $error){
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
            throw $error;
        }
        return $timestamp;
    }
}
<<<<<<< HEAD
=======

>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
