<?php

$landlordId = $_POST['landlordId'] ?? 0;

if ($landlordId == 0)
    exit;

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/notice.php';

$tempHouse = new House();
$tempRoom = new Room();
$tempNotice = new Notice();

$houseList = $tempHouse->fetchHouseIdByLandlordId($landlordId);
$roomList = $tempRoom->fetchAllRoomIdByLandlord($houseList);
$noticeList = $tempNotice->fetchRoomNoticeForLandlord($roomList);

foreach ($noticeList as $notice) {
    ?>
    <div class="system-notice">
        <div class="top">
            <p class="title fw-semibold fs-4"> <?= ucfirst($notice['title']) ?> </p>
        </div>

        <p class="desciption"> <?= ucfirst($notice['description']) ?> </p>
        <p class="date"> <?= $notice['notice_date'] ?> </p>
    </div>
    <?php
}