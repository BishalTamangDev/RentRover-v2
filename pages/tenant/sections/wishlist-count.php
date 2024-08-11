<?php

$userId = $_POST['userId'] ?? 0;

if ($userId == 0) {
    echo "0";
    exit;
}

require_once __DIR__ . '/../.././../classes/wishlist.php';
$tempWishlist = new Wishlist();

$count = $tempWishlist->count($userId);

if($count < 10) {
    ?>
    <p class="m-0 text-danger fw-semibold" id="wishlist-count"> <?= $count ?></p>
    <?php
} else {
    ?>
    <p class="m-0 text-danger fw-semibold" id="wishlist-count"> 10<sup>+</sup> </p>
    <?php
}
?>