<?php

require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();

$count = $tempHouse->countHouse();

echo $count;