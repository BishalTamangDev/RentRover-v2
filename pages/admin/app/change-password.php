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
require_once __DIR__ . '/../../../classes/admin.php';
$tempAdmin = new Admin();
$tempAdmin->fetch($_SESSION['rentrover-id'], "mandatory");
$validOldPassword = $tempAdmin->checkPassword($oldPassword);

if (!$validOldPassword) {
    $message = "Old password didn't match.";
    echo $message;
    exit;
}

// same old and new password
if ($oldPassword == $newPassword) {
    $message = "Please enter different new password.";
    echo $message;
    exit;
}

// different new passwords
if ($newPassword != $newPasswordConfirmation) {
    $message = "Please enter the confirmation password same as new password.";
    echo $message;
    exit;
}

// update password
$response = $tempAdmin->updatePassword($newPassword);
$message = $response ? true : "Passoword couldn't be updated.";

echo $message;