<?php

$appRoot 	= APP_ROOT;
$cmd 		= "php $appRoot/api/check/action";
$sleep 		= 60;
 
while (true) {
    exec($cmd);
    sleep($sleep);
}