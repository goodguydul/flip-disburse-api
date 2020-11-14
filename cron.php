<?php

$appRoot 	= "https://flip-disburse-api.herokuapp.com";
$cmd 		= "curl $appRoot/check/action";
$sleep 		= 30;
 
while (true) {
    exec($cmd);
    sleep($sleep);
}