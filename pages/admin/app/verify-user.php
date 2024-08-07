<?php
$userId = $_POST['userId'];

require_once __DIR__ . '/../../../classes/user.php';

$tempUser = new User();

$response = $tempUser->verifyUser($userId);

echo $response;