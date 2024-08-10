<?php
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../functions/amenity-array.php';

$houseId = $_POST['houseId'];
$roomId = $_POST['roomId'];

$tempHouse = new House();
$tempRoom = new Room();

// fetch room's amenity
$tempRoom->fetchAmenity($roomId);

$tempHouse->houseId = $houseId;
$tempHouse->fetchAmenity($houseId);
$amenityList = $tempHouse->amenity;

$count = 0;
foreach ($amenityList as $amenity) {
    $count++;
    ?>
    <div class="d-flex flex-row gap-2 input-amenity">
        <input type="checkbox" name="amenity[]" value="<?= $amenity ?>" id="amenity-<?= $count ?>" <?php if (in_array($amenity, $tempRoom->amenity))
                echo "checked" ?>>

            <label class="amenity-detail" for="amenity-<?= $count ?>">
            <img src="/rentrover/assets/icons/amenities/<?= amenityIcon($amenity); ?>" alt="amenity icon">
            <p> <?= $amenity ?> </p>
        </label>
    </div>
    <?php
}