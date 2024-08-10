<?php

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/user.php';

$tempHouse = new House();
$tempRoom = new Room();
$tempUser = new User();

$houseList = $tempHouse->fetchAllHouse();

if (sizeof($houseList) > 0) {
    $serial = 1;
    foreach ($houseList as $house) {
        $id = $house['house_id'];
        $district = $house['district'];
        $address = $tempHouse->formatAddress($house['district'], $house['municipality_rural'], $house['tole_village'], $house['ward']);
        // get landlord name
        $landlordId = $house['landlord_id'];
        $tempUser->fetch($landlordId, "mandatory");
        $landlordName = $tempUser->getFullName();
        ?>
        <tr class='house-row <?="$district-row"?>'>
            <th scope="row" class="serial"> <?= $serial++ ?> </th>
            <td> <?= $address ?> </td>
            <td> 
                <a href="/rentrover/admin/user-detail/<?=$landlordId?>" class="text-primary">
                    <?= $landlordName ?> 
                </a> 
            </td>
            <td> <?= $tempRoom->countRoomOfThisHouse($id) ?> </td>
            <td class="small text-secondary"> <?= $house['registration_date'] ?> </td>
            <td class="action">
                <a href="/rentrover/admin/house-detail/<?= $id ?>" class="text-primary small">
                    Show details
                </a>
            </td>
        </tr>
        <?php
    }
}