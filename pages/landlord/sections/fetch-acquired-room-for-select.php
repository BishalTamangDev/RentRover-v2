<?php
$houseId = $_POST['houseId'] ?? 0;

if ($houseId == 0)
    exit;

require_once __DIR__ . '/../../../classes/room.php';
$tempRoom = new Room();

$roomList = $tempRoom->fetchRoomByHouseId($houseId);
?>
<option value="" selected hidden> Select room </option>
<?php
foreach ($roomList as $room) {
    $roomId = $room['room_id'];
    $roomNumber = $room['number'];
    if ($room['tenant_id'] != 0) {

        ?>
        <option value="<?= $roomId ?>"> <?= $roomNumber ?> </option>
        <?php
    }
}