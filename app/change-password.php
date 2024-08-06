<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$message = false;

// csrf token validation
if (!isset($_POST['password-csrf-token'])) {
    $message = "An error occured.";
    echo $message;
    exit;
}

if ($_POST['password-csrf-token'] != $_SESSION['csrf-token']) {
    $message = "An error occured.";
    echo $message;
    exit;
}

// validation password
$oldPassword = $_POST['old-password'];
$newPassword = $_POST['new-password'];
$newPasswordConfirmation = $_POST['new-password-confirmation'];

// check database password
require_once __DIR__ . '/../classes/user.php';
$tempUser = new User();
$tempUser->fetch($_SESSION['rentrover-id'], "mandatory");
$validOldPassword = $tempUser->checkPassword($oldPassword);

if (!$validOldPassword) {
    $message = "Old password didn't match.";
    echo $message;
    $conn->close();
    exit;
}

// same old and new password
if ($oldPassword == $newPassword) {
    $message = "Please enter different new password.";
    $conn->close();
    echo $message;
    exit;
}

// different new passwords
if ($newPassword != $newPasswordConfirmation) {
    $message = "Please enter the confirmation password same as new password.";
    $conn->close();
    echo $message;
    exit;
}

// update password
$response = $tempUser->updatePassword($newPassword);
$message = $response ? true : "Passoword couldn't be updated.";

echo $message;

$conn->close();