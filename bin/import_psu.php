<?php

use \Model\Bobinaudio\Transfo\Psu;
use \Pomm\Exception\Exception as PommException;
use \Bobinaudio\CSVParserPSU;

$app = require dirname(__DIR__)."/sources/bootstrap.php";
$filename = sprintf("%s/data/psu.csv", PROJECT_DIR);
$file = file_get_contents($filename);

if ($file === false)
{
    throw new RuntimeException(sprintf("Unable to read file '%s'.", $filename));
}

$line_nr = 0;
foreach(preg_split("/\n/", $file) as $line)
{
    if (preg_match('/^ *$/', $line) or preg_match('/^ *#.*$/', $line))
    {
        continue;
    }
    try
    {
        $validated_fields = CSVParserPSU::validate($line);
    }
    catch(\Exception $e)
    {
        printf("Invalid formatting line «%s», parser said «%s».\n", $line, $e->getMessage());
        throw $e;
    }

    try
    {
        $psu = new Psu($validated_fields);
        $app['pomm.connection']->getMapFor('\Model\Bobinaudio\Transfo\Psu')->saveOne($psu);
    }
    catch(PommException $e)
    {
        printf("Rejected line «%s», reason «%s».\n", $line, $e->getMessage());
        continue;
    }

    printf("Line %02d imported.\n", ++$line_nr);
}
