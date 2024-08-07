<?php
require_once __DIR__ . '/../../../classes/user.php';

$tempUser = new User();

$count = $tempUser->countLandlord();

echo $count;