<?php
$tenantId = $_POST['tenantId'] ?? 0;

if ($tenantId == 0)
    exit;

require_once __DIR__ . '/../../../classes/notice.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();
$tempRoom = new Room();
$tempNotice = new Notice();

$list = $tempNotice->fetchRoomNoticeForTenant($tenantId);

if (sizeof($list) == 0) {
    ?>
    <p class="text-danger"> No notice found! </p>
    <?php
} else {
    foreach ($list as $notice) {
        $houseId = $notice['house_id'];
        $roomId = $notice['room_id'];
        $title = $notice['title'];
        $description = $notice['description'];
        $date = $notice['notice_date'];

        $tempRoom->fetch($roomId);
        $tempHouse->fetch($tempRoom->houseId);
        $location = $tempHouse->getAddress();
        $roomNumber = $tempRoom->number;
        ?>
        <div class="system-notice room-notice">
            <div class="top">
                <p class="title"> <?= ucwords($title) ?> </p>
                <p class="location">
                    House : <?= $location ?> Room : 
                    <?= $roomNumber ?>
                </p>
                <p class="room"> 
                </p>
            </div>

            <p class="description"> <?= ucfirst($description) ?> </p>
            <p class="date"> <?= $date ?> </p>
        </div>
        <?php
    }
}