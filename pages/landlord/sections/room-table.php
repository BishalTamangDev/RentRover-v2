<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/user.php';

$tempRoom = new Room();
$tempHouse = new House();

$landlordId = $_SESSION['rentrover-id'];

// $roomList = $tempRoom->fetchAllRoom();
$houseList = $tempHouse->fetchHouseIdByLandlordId($landlordId);

$roomList = $tempRoom->fetchAllRoomByLandlord($houseList);

$serial = 1;
foreach ($roomList as $room) {
    $roomId = $room['room_id'];
    $houseId = $room['house_id'];
    $tempHouse->fetch($houseId);
    $landlordId = $tempHouse->getLandlordId() ?? '';

    // filter class
    // room type
    $typeClass = $room['type'] == 'bhk' ? "bhk-row" : "non-bhk-row";

    // status
    $statusClass = $room['flag'] == 'on-hold' ? 'acquired-row' : 'unacquired-row';

    // furnishihng
    switch ($room['furnishing']) {
        case 'unfurnished':
            $furnishingClass = "unfurnished-row";
            break;
        case 'semi-furnished':
            $furnishingClass = "semi-furnished-row";
            break;
        default:
            $furnishingClass = "full-furnished-row";
    }
    ?>
    <tr class="room-row <?= $typeClass ?> <?= $furnishingClass ?> <?= $statusClass ?>">
        <th scope="row" class="serial"> <?= $serial++ ?> </th>
        <td> <a href="/rentrover/landlord/house-detail/<?= $houseId ?>" class="text-primary"> <?= $houseId ?> </a> </td>
        <td> <?= $tempHouse->getAddress() ?> </td>

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
        <td> <?= $room['flag'] == 'on-hold' ? "Acquired" : "Uncquired" ?> </td>
        <td class="text-secondary small"> <?= $room['registration_date'] ?> </td>
        <td class="action text-primary">
            <a href="/rentrover/landlord/room-detail/<?= $roomId ?>" class="text-primary small"> Show details
            </a>
        </td>
    </tr>
    <?php
}
?>