<?php

$appRoot 	= APP_ROOT;
$cmd 		= "curl $appRoot/api/check/action";
$sleep 		= 30;
 
while (true) {
    exec($cmd);
    sleep($sleep);
}