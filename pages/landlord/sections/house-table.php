<?php

if (!isset($_POST['landlordId'])) {
    echo "Error occured.";
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';

$tempHouse = new House();
$tempRoom = new Room();

$landlordId = $_POST['landlordId'];

$tempHouse->setLandlordId($landlordId);

$houseList = $tempHouse->fetchHouseByLandlordId($landlordId);

if (sizeof($houseList) > 0) {
    $serial = 1;
    foreach ($houseList as $house) {
        $id = $house['house_id'];
        $address = $tempHouse->formatAddress($house['district'], $house['municipality_rural'], $house['tole_village'], $house['ward']);
        ?>
        <tr class="house-row">
            <th scope="row" class="serial"> <?= $serial++ ?> </th>
            <td> <?= $address ?> </td>
            <td> <?= $tempRoom->countRoomOfThisHouse($id) ?> </td>
            <td class="small text-secondary"> <?= $house['registration_date'] ?> </td>
            <td class="action">
                <a href="/rentrover/landlord/house-detail/<?= $id ?>" class="text-primary small">
                    Show details
                </a>
            </td>
        </tr>
        <?php
    }
}