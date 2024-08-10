<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$landlordId = $_SESSION['rentrover-id'];

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';

$tempHouse = new House();
$tempRoom = new Room();

$houseIdList = $tempHouse->fetchHouseIdByLandlordId($landlordId);
$count = $tempRoom->countLandlordUnacquiredRoom($houseIdList);

echo $count;