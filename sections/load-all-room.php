<?php
require_once __DIR__ . '/../classes/house.php';
require_once __DIR__ . '/../classes/room.php';
require_once __DIR__ . '/../classes/user.php';
require_once __DIR__ . '/../classes/room-review.php';

$tempUser = new User();
$tempHouse = new House();
$tempRoom = new Room();
$tempReview = new Review();

$allRoomList = $tempRoom->fetchAllRoom();

if (sizeof($allRoomList) > 0) {
    foreach ($allRoomList as $room) {
        $roomId = $room['room_id'];
        $bhk = $room['bhk'];
        $rent = $room['rent'];
        $type = $room['type'];
        $furnishing = $room['furnishing'];
        $floor = $room['floor'];
        $numberOfRoom = '';

        $tempHouse->fetch($room['house_id']);

        $location = $tempHouse->getAddress();

        // class purpose
        // district
        $districtClass = 'district-' . $tempHouse->address['district'] . '-element';

        // furnishing
        if ($furnishing == 'unfurnished') {
            $furnishingClass = "unfurnished-element";
        } elseif ($furnishing == 'semi-furnished') {
            $furnishingClass = "semi-furnished-element";
        } else {
            $furnishingClass = "full-furnished-element";
        }

        // room type
        $typeClass = $type == 'bhk' ? "bhk-element" : 'non-bhk-element';

        // photo
        $tempRoom->fetchMainPhoto($roomId);

        // main photo
        $mainPhoto = $tempRoom->photo['first'];
        ?>
        <div class="room shadow-sm room-element <?= $typeClass ?> <?= $furnishingClass ?> <?= $districtClass ?>"
            data-rent="<?= $rent ?>" data-floor="<?= $floor ?>">
            <!-- image -->
            <div class="room-image-div">
                <img src="/rentrover/uploads/rooms/<?= $mainPhoto ?>" alt="room image">
            </div>

            <!-- details -->
            <div class="room-details">
                <!-- location -->
                <div class="location-wishlist">
                    <div class="location-container">
                        <abbr title="Pipalboat, Kathmandu">
                            <p class="location">
                                <?= $location ?>
                            </p>
                        </abbr>
                    </div>
                </div>

                <!-- specs :: number of room & floor -->
                <p class="spec">
                    <?= $type == 'bhk' ? $bhk . " BHK, " : "Non-BHK" . $numberOfRoom . ' Rooms, '; ?>
                    <?php
                    $x = $floor % 10;
                    echo $floor;
                    if ($x == 1) {
                        ?>
                        <sup> st </sup>
                        <?php
                    } elseif ($x == 2) {
                        ?>
                        <sup> nd </sup>
                        <?php
                    } elseif ($x == 3) {
                        ?>
                        <sup> rd </sup>
                        <?php
                    }
                    $floor . " Floor"; ?>
                </p>

                <!-- rent -->
                <p class="rent text-success"> <?= "NPR. " . number_format($rent, 2) ?> </p>

                <!-- rating -->
                <div class="room-bottom">
                    <div class="rating">
                        <img src="/rentrover/assets/icons/full-star.png" alt="">
                        <p class="fw-semibold small"> <?= $tempReview->calculateRating($roomId) ?> </p>
                    </div>

                    <a href="/rentrover/room-detail/<?= $roomId ?>" class="btn btn-outlined-brand show-more-btn">
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