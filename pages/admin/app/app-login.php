<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$message = "An error occured";
if (isset($_POST['csrf-token'])) {
    if ($_POST['csrf-token'] == $_SESSION['csrf-token']) {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            require_once __DIR__ . '/../../../classes/admin.php';
            global $conn;

            $admin = new Admin();

            $password = $_POST['password'];

            $admin->email = mysqli_real_escape_string($conn, $_POST['email']);

            // check if this email address is already used
            $emailExists = $admin->checkEmailExistence($admin->email);

            if (!$emailExists) {
                $message = "Email not registered yet.";
            } else {
                if ($admin->checkPassword($password)) {
                    $message = "true";
                    
                    // get admin id
                    $_SESSION['rentrover-id'] = $admin->fetchIdByEmail($admin->email);
                    $_SESSION['rentrover-role'] = "admin";
                } else {
                    echo "<br/>";
                    $message = "Invalid password";
                }
            }
            $conn->close();
        }
    }
}
echo $message;