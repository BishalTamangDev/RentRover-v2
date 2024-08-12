<?php

$landlordId = $_POST['landlordId'] ?? 0;

if ($landlordId == 0) {
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();

$houseList = $tempHouse->fetchHouseByLandlordId($landlordId);

foreach ($houseList as $house) {
    $id = $house['house_id'];
    $tempHouse->fetch($id);
    $location = $tempHouse->getAddress();
    ?>
    <option value="<?= $id ?>"> <?= $location ?> </option>
    <?php
}
?>