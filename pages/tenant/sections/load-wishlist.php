<?php
$userId = $_POST['userId'] ?? 0;

if ($userId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/wishlist.php';
$tempWishlist = new Wishlist();

$tempWishlist->setUserId($userId);

$list = $tempWishlist->fetchList();

if (sizeof($list) == 0) {
    echo false;
    exit;
} else {
    require_once __DIR__ . '/../../../classes/room.php';
    require_once __DIR__ . '/../../../classes/house.php';
    require_once __DIR__ . '/../../../classes/room-review.php';

    $tempRoom = new Room();
    $tempHouse = new House();
    $tempReview = new Review();

    foreach ($list as $id) {
        $tempRoom->fetch($id);
        $tempRoom->fetchMainPhoto($id);
        $tempHouse->fetch($tempRoom->houseId);
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
                            <p class="location"> <?= $tempHouse->getAddress() ?> </p>
                        </abbr>
                    </div>

                    <!-- wishlist -->
                    <?php
                    if (in_array($id, $list)) {
                        ?>
                        <i class="fa-solid fa-bookmark wish-icon" data-task="remove" data-id="<?= $id ?>"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa-regular fa-bookmark wish-icon out" data-task="add" data-id="<?= $id ?>"></i>
                        <?php
                    }
                    ?>
                </div>

                <!-- specs :: number of room & floor -->
                <p class="spec">
                    <?= $tempRoom->type == 'bhk' ? $tempRoom->bhk . " BHK, " : "Non-BHK" . $tempRoom->numberOfRoom . ' Rooms, '; ?>
                    <?php
                    $x = $tempRoom->floor % 10;
                    echo $tempRoom->floor;
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
                    echo " Floor"; ?>
                </p>

                <!-- rent -->
                <p class="rent text-success"> <?= "NPR. " . number_format($tempRoom->rent, 2) ?> </p>

                <div class="room-bottom">
                    <div class="rating">
                        <img src="/rentrover/assets/icons/full-star.png" alt="">
                        <p class="fw-semibold small"> <?= $tempReview->calculateRating($id) ?>
                        </p>
                    </div>

                    <a href="/rentrover/tenant/room-detail/<?= $id ?>" class="btn btn-outlined-brand show-more-btn">
                        Show More </a>
                </div>
            </div>
        </div>
        <?php
    }
}