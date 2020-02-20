<?php

namespace Tests\GeoTimeZone;
<<<<<<< HEAD

use GeoTimeZone\UpdaterData;

include __DIR__ . "../../../../../autoload.php";
=======
use GeoTimeZone\UpdaterData;

include __DIR__ . "/../../vendor/autoload.php";
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84


class UpdaterDataTest
{
    public function main()
    {
        try {
<<<<<<< HEAD
            $updater = new UpdaterData(__DIR__ . "/media/ana/Datos/geo-timezone/data");
=======
            $updater = new UpdaterData("/media/ana/Datos/geo-timezone/data/");
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
            $updater->updateData();
        } catch (\ErrorException $error) {
            echo $error->getMessage();
        }
<<<<<<< HEAD
=======
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
    }
}

$test = new UpdaterDataTest();
<<<<<<< HEAD
$test->main();
=======
$test->main();
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
