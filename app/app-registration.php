<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$message = "An error occured";
if (isset($_POST['registration-csrf-token'])) {
    if ($_POST['registration-csrf-token'] == $_SESSION['csrf-token']) {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
            require_once __DIR__ . '/../classes/user.php';
            global $conn;

            $user = new User();

            $password = $_POST['password'];
            $user->role = $_POST['role'];
            $user->email = mysqli_real_escape_string($conn, $_POST['email']);

            // check if this email address is already used
            $emailExists = $user->checkEmailExistence($user->email);

            if ($emailExists) {
                $message = "Email already in use.";
            } else {
                $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
                // register
                $message = $user->register() ? "true" : "Signup failed.";
            }
            $conn->close();
        }
    }
}

echo $message;