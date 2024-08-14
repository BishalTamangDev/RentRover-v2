<?php
$tenantId = $_POST['tenantId'] ?? 0;

if ($tenantId == 0)
    exit;

require_once __DIR__ . '/../../../classes/tenancy-history.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();
$tempRoom = new Room();
$tempTenancy = new Tenancy();

$list = $tempTenancy->fetchHistoryOfTenant($tenantId);

$serial = 1;
if (sizeof($list) == 0) {
    ?>
    <tr>
        <td scope="row" colspan="76" class="text-danger small" style="text-align:center;"> No tenancy history found </td>
    </tr>
    <?php
} else {
    foreach ($list as $history) {
        $roomId = $history['room_id'];
        $tempRoom->fetch($roomId);

        $roomNumber = $tempRoom->number;

        $tempHouse->fetch($tempRoom->houseId);
        $location = $tempHouse->getAddress();

        $specs = "";
        if ($tempRoom->type == 'bhk') {
            $specs = "$tempRoom->bhk BHK";
        } else {
            $specs = "$tempRoom->numberOfRoom Rooms";
        }

        $specs .= ", ".$tempRoom->floor;

        $moveInDate = $history['move_in_date'];
        $moveOutDate = $history['move_out_date'] != '0000-00-00 00:00:00' ? $history['move_out_date'] : "Still Residing";
        ?>
        <tr>
            <td scope="row"> <?= $serial++ ?> </td>
            <td> <?= $location ?> </td>
            <td>
                <a href="/rentrover/tenant/room-detail/<?= $roomId ?>" class="text-primary">
                    <?= $roomNumber ?>
                </a>
            </td>
            <td> <?= $specs ?> </td>
            <td class="text-success"> <?= "NPR. " . number_format($tempRoom->rent, 2) ?> </td>
            <td class="small text-secondary"> <?= $moveInDate ?> </td>
            <td class="small text-secondary"> <?= $moveOutDate ?> </td>
        </tr>
        <?php
    }
}