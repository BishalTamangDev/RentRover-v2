<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../../classes/admin.php';

global $conn;
$response = "";
$hasPhoto = false;
$fileUploaded = false;

$tempAdmin = new Admin();
$tempAdmin->fetch($_SESSION['rentrover-id'], "all");

if (isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] != UPLOAD_ERR_NO_FILE) {
    $hasPhoto = true;
    $profilePhoto = $_FILES['profile-photo'];
    require_once __DIR__ . '/../../../functions/file-validity-check.php';
    $photoValid = fileValidityCheck($profilePhoto);

    if ($photoValid) {
        $response = "";
        require_once __DIR__ . '/../../../functions/file-upload.php';
        $fileUploaded = uploadFile("admin-profile-photo", $profilePhoto);
        if ($fileUploaded != false) {
            // delete previous photo
            if ($tempAdmin->profilePhoto != '') {
                unlink("../../../uploads/admins/" . $tempAdmin->profilePhoto);
            }
            $tempAdmin->profilePhoto = $fileUploaded;
        }
    } else {
        $response = $photoValid;
    }
}

if ($hasPhoto) {
    if (!$photoValid) {
        echo $response;
        exit;
    }
    if (!$fileUploaded) {
        echo "Error in uploading profile photo";
        exit;
    }
}

$tempAdmin->name = [
    'first' => $conn->real_escape_string($_POST['first-name']),
    'last' => $conn->real_escape_string($_POST['last-name'])
];

$tempAdmin->gender = $_POST['gender'];
$tempAdmin->dob = $_POST['dob'];
$tempAdmin->address = [
    'province' => $_POST['province'],
    'district' => $_POST['district'],
    'municipalityRural' => $conn->real_escape_string($_POST['municipality-rural']),
    'tole-village' => $conn->real_escape_string($_POST['tole-village']),
    'ward' => $_POST['ward'],
];

$tempAdmin->setPhoneNumber($_POST['phone-number']);

$response = $tempAdmin->update($_SESSION['rentrover-id']);

echo $response;