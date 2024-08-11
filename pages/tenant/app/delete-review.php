<?php
$reviewId = $_POST['reviewId'] ?? 0;

if ($reviewId == 0) {
    echo false;
    exit;
}

require_once __DIR__ . '/../../../classes/room-review.php';

$tempReview = new Review();

echo $tempReview->delete($reviewId);