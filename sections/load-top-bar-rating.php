<?php
$roomId = $_POST['roomId'] ?? 0;

if ($roomId == 0) {
    exit;
}

require_once __DIR__ . '/../classes/room-review.php';

$tempReview = new Review();

$list = $tempReview->fetchRoomReviews($roomId);

if (sizeof($list) == 0) {
    ?>
    <div class="rating">
        <img src="/rentrover/assets/icons/full-star.png" alt="">
    </div>
    <p class="m-0 text-secondary small pt-1"> (0 Review) </p>
    <?php
} else {
    $totalRating = 0;
    $count = 0;
    foreach ($list as $review) {
        $totalRating += $review['rating'];
        $count++;
    }
    $finalRating = $totalRating / $count;
    $remaining = $finalRating;
    ?>
    <div class="rating">
        <?php
        for ($i = 1; $i < $finalRating; $i++) {
            $remaining--;
            ?>
            <img src="/rentrover/assets/icons/full-star.png" alt="">
            <?php
        }
        if ($remaining > 0) {
            ?>
            <img src="/rentrover/assets/icons/half-star.png" alt="">
            <?php
        }
        ?>
    </div>
    <p class="m-0 text-secondary small pt-1"> (<?= $count ?> Reviews) </p>
    <?php
}