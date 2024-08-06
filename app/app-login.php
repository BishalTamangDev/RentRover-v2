<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$message = "An error occured";

if (isset($_POST['login-csrf-token'])) {
    if ($_POST['login-csrf-token'] == $_SESSION['csrf-token']) {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            require_once __DIR__ . '/../classes/user.php';
            global $conn;

            $user = new User();

            // $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = $_POST['password'];

            $user->email = mysqli_real_escape_string($conn, $_POST['email']);

            // check if this email address is already used
            $emailExists = $user->checkEmailExistence($user->email);

            if (!$emailExists) {
                $message = "Email not registered yet.";
            } else {
                if ($user->checkPassword($password)) {
                    $message = "true";

                    // get user id
                    $_SESSION['rentrover-id'] = $user->fetchIdByEmail($user->email);

                    // get user role
                    $user->fetch($_SESSION['rentrover-id'], "mandatory");

                    $_SESSION['rentrover-role'] = $user->role;
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