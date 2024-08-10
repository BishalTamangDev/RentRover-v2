<?php
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/user.php';

$tempRoom = new Room();
$tempHouse = new House();
$tempUser = new User();

$roomList = $tempRoom->fetchAllRoom();
$serial = 1;
foreach ($roomList as $room) {
    $roomId = $room['room_id'];
    $houseId = $room['house_id'];
    $tempHouse->fetch($houseId);
    $landlordId = $tempHouse->getLandlordId();
    $tempUser->fetch($landlordId, "mandatory");
    ?>
    <tr
        class="room-row <?= $room['type'] == 'bhk' ? "bhk-row" : "non-bhk-row" ?> 
        <?php if ($room['furnishing'] == 'unfunished')
            echo "unfurnished-row";
        elseif ($room['furnishing'] == 'semi-furnished')
            echo "semi-furnished-row";
        else
            echo "full-furnished-row"; ?> <?= $room['flag'] != 'acquired' ? "unacquired-row" : "acquired-row" ?> bhk-row unfurnished-row unacquired-row">
        <th scope="row" class="serial"> <?= $serial++ ?> </th>
        <td> <a href="/rentrover/admin/house-detail/<?= $houseId ?>" class="text-primary"> <?= $houseId ?> </a> </td>
        <td> <?= $tempHouse->getAddress() ?> </td>
        <td> <a href="/rentrover/admin/user-detail/<?= $landlordId ?>" class="text-primary"> <?= $tempUser->getFullName() ?> </a> </td>
        <td>
            <?php
            if ($room['type'] == 'bhk') {
                echo $room['bhk'] . " BHK";
            } else {
                echo "Non-BHK, " . $room['number_of_room'] . " Rooms";
            }
            ?>
        </td>
        <td> <?= ucfirst($room['furnishing']) ?> </td>
        <td> <?= $room['flag'] != 'acquired' ? "Unacquired" : "Acquired" ?> </td>
        <td class="text-secondary small"> <?= $room['registration_date'] ?> </td>
        <td class="action text-primary">
            <a href="/rentrover/admin/room-detail/<?= $roomId ?>" class="text-primary small"> Show details
            </a>
        </td>
    </tr>
    <?php
}
?>