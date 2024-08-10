<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$userId = $_SESSION['rentrover-id'] ?? 0;
$roomId = $_POST['roomId'] ?? 0;
$task = $_POST['toDo'] ?? 0;

if ($userId == 0 || $roomId == 0 || $task == 0) {
    echo "false";
    exit;
}

require_once __DIR__ . '/../../../classes/wishlist.php';

$tempWishlist = new Wishlist();

$tempWishlist->setUserId($_SESSION['rentrover-id']);

$present = $tempWishlist->checkWish($roomId);

$status = $present ? $tempWishlist->remove($roomId) : $tempWishlist->add($roomId);

echo $status;