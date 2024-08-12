<?php
$landlordId = $_POST['landlordId'] ?? 0;


if ($landlordId == 0)
    exit;

require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/leave-application.php';

$tempHouse = new House();
$tempRoom = new Room();
$tempLeave = new Leave();
$tempUser = new User();

$houseList = $tempHouse->fetchHouseIdByLandlordId($landlordId);
$roomList = $tempRoom->fetchAllRoomIdByLandlord($houseList);

$applicationList = $tempLeave->fetchAllLeaveApplicationForLandlord($roomList);

if (sizeof($applicationList) > 0) {
    $serial = 1;
    foreach ($applicationList as $application) {
        $applicationId = $application['leave_id'];
        $roomId = $application['room_id'];
        $tenantId = $application['tenant_id'];

        // fetch room
        $tempRoom->fetch($roomId);
        $tempRoom->number;

        // fetch user detail 
        $tempUser->fetch($tenantId, "mandatory");
        $name = $tempUser->getFullName();
        ?>
        <tr>
            <th scope="row" class="serial"> <?= $serial++ ?> </th>
            <td>
                <a href="/rentrover/landlord/room-detail/<?= $roomId ?>" class="text-primary">
                    <?= $tempRoom->number; ?>
                </a>
            </td>
            <td> <?= $name ?> </td>
            <td> <?= $application['move_out_date'] ?> </td>
            <td> <?= $application['submitted_date'] ?> </td>
            <td class="action">
                <p class="text-primary pointer small show-leave-applciation-detail" data-leave-application-id="<?= $applicationId ?>" data-bs-toggle="modal"
                    data-bs-target="#leaveApplicationModal"> Show detail </p>
            </td>
        </tr>
        <?php
    }
}