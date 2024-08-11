<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../../classes/application.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';

$tempApplication = new Application();
$tempHouse = new House();
$tempRoom = new Room();

$tempApplication->setApplicantId($_SESSION['rentrover-id']);

$list = $tempApplication->fetchApplicationOfTenant($_SESSION['rentrover-id']);

$serial = 1;
foreach ($list as $row) {
    $tempApplication->checkExpired($row['application_id']);

    // fetch room
    $roomId = $row['room_id'];
    $tempRoom->fetch($row['room_id']);
    $tempHouse->fetch($tempRoom->houseId);
    $location = $tempHouse->getAddress();
    $flag = $row['flag'];
    ?>
    <tr>
        <td scope="row"> <?= $serial++ ?> </td>
        <td> <?= $location ?> </td>
        <td>
            <a href="/rentrover/tenant/room-detail/<?= $roomId ?>" class="text-primary">
                <?= $tempRoom->number ?>
        </td>
        </a>
        <td>
            <?php
            if ($tempRoom->type == 'bhk') {
                echo $tempRoom->bhk . ' BHK, ';
            } else {
                echo $tempRoom->numberOfRoom . ' Rooms, ';
            }
            echo $tempRoom->floor . " Floor";
            ?>
        </td>
        <td> <?= $row['move_in_date'] ?> </td>
        <td> <?= $row['move_out_date'] != '0000-00-00' ? $row['move_out_date'] : '-' ?> </td>
        <td> <?= ucfirst($flag) ?> </td>
    </tr>
    <?php
}
?>