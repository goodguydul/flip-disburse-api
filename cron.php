<?php

$appRoot 	= APP_ROOT;
$cmd 		= "php $appRoot/api/check/action";
$sleep 		= 30;
 
while (true) {
    exec($cmd);
    sleep($sleep);
}