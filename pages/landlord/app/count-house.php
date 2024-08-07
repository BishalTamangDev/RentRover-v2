<?php

if (!isset($_POST['landlordId'])) {
    echo "0";
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();

$landlordId = $_POST['landlordId'];

$count = $tempHouse->countLandlordHouse($landlordId);

echo $count;