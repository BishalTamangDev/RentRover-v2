<?php

if (!isset($_POST['content'])) {
    exit;
}

$content = trim($_POST['content']);

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/user.php';

$tempHouse = new House();
$tempUser = new User();

if (!is_null($content)) {
    $searchedHouses = $tempHouse->search($content);
    if (sizeof($searchedHouses) > 0) {
        $serial = 1;
        foreach ($searchedHouses as $house) {
            $district = $house['district'];
            $tempHouse->fetch($house['house_id']);
            $tempUser->fetch($tempHouse->getLandlordId(), "mandatory");
            $landlordName = $tempUser->getFullName();
            $address = $tempHouse->formatAddress($house['district'], $house['municipality_rural'], $house['tole_village'], $house['ward']);
            ?>
            <tr class="house-row  <?="$district-row"?>">
                <th scope="row" class="serial"> <?= $serial++ ?> </th>
                <td> <?= $address ?> </td>
                <td>
                    <a href="/rentrover/admin/user-detail/<?= $landlordId ?>" class="text-primary">
                        <?= $landlordName ?>
                    </a>
                </td>
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
} else {
    $houseList = $tempHouse->fetchAllHouse();
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
        <tr class="house-row  <?="$district-row"?>">
            <th scope="row" class="serial"> <?= $serial++ ?> </th>
            <td> <?= $address ?> </td>
            <td>
                <a href="/rentrover/admin/user-detail/<?= $landlordId ?>" class="text-primary">
                    <?= $landlordName ?>
                </a>
            </td>
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