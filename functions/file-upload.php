<?php
function uploadFile($fileCategory, $formFile)
{
    $fileUploaded = false;
    $fileName = $formFile['name'];
    $fileTmpName = $formFile['tmp_name'];

    // extension extraction
    $fileTempExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileTempExtension));

    $newFileName = uniqid('', true) . "." . $fileExtension;

    // setting destination
    if ($fileCategory == 'admin-profile-photo') {
        move_uploaded_file($fileTmpName, "../../../uploads/admins/$newFileName");
        $fileUploaded = $newFileName;
    } elseif ($fileCategory == 'admin-kyc-photo') {
        move_uploaded_file($fileTmpName, "../../../uploads/kycs/$newFileName");
        $fileUploaded = $newFileName;
    } elseif ($fileCategory == 'user-profile-photo') {
        move_uploaded_file($fileTmpName, "../uploads/users/$newFileName");
        $fileUploaded = $newFileName;
    } elseif ($fileCategory == 'user-kyc-photo') {
        move_uploaded_file($fileTmpName, "../uploads/kycs/$newFileName");
        $fileUploaded = $newFileName;
    } elseif ($fileCategory == 'house-photo') {
        move_uploaded_file($fileTmpName, "../../../uploads/houses/$newFileName");
        $fileUploaded = $newFileName;
    } elseif ($fileCategory == 'room-photo') {
        move_uploaded_file($fileTmpName, "../../../uploads/rooms/$newFileName");
        $fileUploaded = $newFileName;
    }

    return $fileUploaded;
}