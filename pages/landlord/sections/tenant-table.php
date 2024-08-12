<?php
$landlordId = $_POST['landlordId'] ?? 0;

if ($landlordId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/tenancy-history.php';

$tempHouse = new House();
$tempUser = new User();
$tempRoom = new Room();
$tempTenancy = new Tenancy();

// fetch house
$houseIdList = $tempHouse->fetchHouseIdByLandlordId($landlordId);

// fetch rooms
$roomIdList = $tempRoom->fetchAllRoomIdByLandlord($houseIdList);

$tenancyList = $tempTenancy->fetchHistoryForLandlord($roomIdList);

$serial = 1;
foreach ($tenancyList as $tenancyId) {
    $tempTenancy->fetch($tenancyId);
    $tenantId = $tempTenancy->getTenantId();
    $roomId = $tempTenancy->getRoomId();

    // fetch tenant detail
    $tempUser->fetch($tenantId, "all");

    // fetch room detail
    $tempRoom->fetch($roomId);

    $moveOutDate = $tempTenancy->moveOutDate != '0000-00-00 00:00:00' ? $tempTenancy->moveOutDate : "Still residing";

    $statusClass = $tempTenancy->moveOutDate == '0000-00-00 00:00:00' ? "current-row" : "ex-row";
    ?>

    <tr class="tenant-row <?= $statusClass ?>">
        <th scope="row" class="serial"> <?= $serial++ ?> </th>
        <td>
            <a href="/rentrover/landlord/tenant-detail/<?= $tenantId ?>" class="text-primary">
                <?= $tempUser->getFullName() ?>
            </a>
        </td>
        <td>
            <a href="/rentrover/landlord/room-detail/<?= $roomId ?>" class="text-primary">
                <?= $tempRoom->number ?>
        </td>
        </a>
        <td> <?= $tempUser->getPhoneNumber() ?> </td>
        <td> <?= $tempTenancy->moveInDate ?> </td>
        <td> <?= $moveOutDate ?> </td>
    </tr>
    <?php
}