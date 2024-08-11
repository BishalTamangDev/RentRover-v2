<?php
$landlordId = $_POST['landlordId'] ?? 0;

if ($landlordId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/tenancy-history.php';

$tempHouse = new House();
$tempRoom = new Room();
$tempTenancy = new Tenancy();

// fetch house
$houseIdList = $tempHouse->fetchHouseIdByLandlordId($landlordId);

// fetch rooms
$roomIdList = $tempRoom->fetchAllRoomIdByLandlord($houseIdList);

$tenancyList = $tempTenancy->fetchHistoryForLandlord($roomIdList);

$totalCount = 0;
$currentCount = 0;
$exCount = 0;
foreach ($tenancyList as $tenancyId) {
    $tempTenancy->fetch($tenancyId);
    $totalCount++;
    if ($tempTenancy->moveOutDate == '0000-00-00 00:00:00') {
        $currentCount++;
    } else {
        $exCount++;
    }
}
?>

<section class="card-v2-container">
    <!-- total tenants -->
    <div class="card-v2">
        <p class="title"> Total Tenants </p>
        <p class="data" id="total-tenant-count"> <?= $totalCount ?> </p>
    </div>

    <!-- current tenants -->
    <div class="card-v2">
        <p class="title"> Current Tenant </p>
        <p class="data" id="current-tenant-count"> <?= $currentCount ?> </p>
    </div>

    <!-- ex-tenants -->
    <div class="card-v2">
        <p class="title"> Ex-Tenant </p>
        <p class="data" id="ex-tenant-count"> <?= $exCount ?> </p>
    </div>
</section>