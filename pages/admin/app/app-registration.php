<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$message = "An error occured";
if (isset($_POST['csrf-token'])) {
    if ($_POST['csrf-token'] == $_SESSION['csrf-token']) {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            global $conn;
            require_once __DIR__ . '/../../../classes/admin.php';

            $admin = new Admin();

            $password = $_POST['password'];
            $admin->email = mysqli_real_escape_string($conn, $_POST['email']);

            // check if this email address is already used
            $emailExists = $admin->checkEmailExistence($admin->email);

            if ($emailExists) {
                $message = "Email already in use.";
            } else {
                $admin->setPassword(password_hash($password, PASSWORD_BCRYPT));

                // register
                $message = $admin->register() ? "true" : "Signup failed.";
            }
            $conn->close();
        }
    }
}

echo $message;