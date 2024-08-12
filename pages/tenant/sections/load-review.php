<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;

$roomId = $_POST['roomId'] ?? 0;

if ($roomId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/room-review.php';
require_once __DIR__ . '/../../../classes/user.php';

$tempReview = new Review();
$tempUser = new User();

$list = $tempReview->fetchRoomReviews($roomId);

if (sizeof($list) == 0) {
    ?>
    <p class="text-danger"> No review found for this room. </p>
    <?php
} else {
    foreach ($list as $review) {
        $tempUser->fetch($review['user_id'], "mandatory");
        $photo = $tempUser->profilePhoto;
        $name = $tempUser->getFullName();
        $rating = $review['rating'];
        ?>
        <div class="review-div">
            <div class="image">
                <img src="/rentrover/uploads/users/<?= $photo ?>" alt="">
            </div>

            <div class="review-details">
                <p class="reviewer"> <?= $name ?> </p>
                <p class="review"> <?= $review['review'] ?> </p>
                <div class="rating">
                    <?php
                    for ($i = 0; $i < $rating; $i++) {
                        ?>
                        <img src="/rentrover/assets/icons/full-star.png" alt="">
                        <?php
                    }
                    ?>
                </div>
            </div>

            <!-- action -->
            <?php
            if ($userId == $review['user_id']) {
                ?>
                <div>
                    <abbr title="Delete">
                        <i class="fa fa-trash delete-review-icon" data-review-id="<?= $review['review_id'] ?>"></i>
                    </abbr>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}