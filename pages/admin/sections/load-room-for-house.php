<?php
$houseId = $_POST['houseId'];

require_once __DIR__ . '/../../../classes/room.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room-review.php';

$tempHouse = new House();
$tempRoom = new Room();
$tempReview = new Review();

$roomIdList = $tempRoom->fetchRoomIdByHouseId($houseId);

if (sizeof($roomIdList) > 0) {
    foreach ($roomIdList as $roomId) {
        $tempRoom->fetch($roomId);
        $tempRoom->fetchMainPhoto($roomId);

        $tempHouse->fetch($tempRoom->houseId);
        $location = $tempHouse->getAddress();
        ?>
        <div class="room shadow-sm">
            <!-- image -->
            <div class="room-image-div">
                <img src="/rentrover/uploads/rooms/<?= $tempRoom->photo['first'] ?>" alt="room image">
            </div>

            <!-- details -->
            <div class="room-details">
                <!-- location -->
                <div class="location-wishlist">
                    <div class="location-container">
                        <abbr title="Pipalboat, Kathmandu">
                            <p class="location"> <?= $location ?> </p>
                        </abbr>
                    </div>
                </div>

                <!-- specs :: number of room & floor -->
                <p class="spec">
                    <?= $tempRoom->type == 'bhk' ? $tempRoom->bhk . " BHK, " : "Non-BHK, " . $tempRoom->numberOfRoom . ' Rooms, '; ?>
                    <?php
                    $floor = $tempRoom->floor;
                    $x = $floor % 10;
                    switch ($x) {
                        case 1:
                            echo '1<sup>st</sup> Floor';
                            break;
                        case 2:
                            echo '2<sup>nd</sup> Floor';
                            break;
                        case 3:
                            echo '3<sup>rd</sup> Floor';
                            break;
                        default:
                            echo "$floor<sup>th</sup> Floor";
                    }
                    ?>
                </p>

                <!-- rent -->
                <p class="rent text-success"> <?= "NPR. " . number_format($tempRoom->rent, 2) ?> </p>

                <div class="room-bottom">
                    <div class="rating">
                        <img src="/rentrover/assets/icons/full-star.png" alt="">
                        <p class="fw-semibold small"> <?= $tempReview->calculateRating($roomId) ?> </p>
                    </div>

                    <a href="/rentrover/admin/room-detail/<?= $roomId ?>" class="btn btn-outlined-brand show-more-btn">
                        Show More </a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <p class="text-danger"> No room has been added in this house. </p>
    <?php
}