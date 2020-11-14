<?php

$appRoot 	= APP_ROOT;
$cmd 		= "php $appRoot/api/check/action schedule:run";
$outputPath = '/dev/null';
$cmd 		= "$cmd &gt; $outputPath &amp;";
$sleep 		= 60;
 
while (true) {
    exec($cmd);
    sleep($sleep);
}