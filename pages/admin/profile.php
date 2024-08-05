<?php
if(!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> My Profile </title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/rentrover/assets/brands/rentrover-circular-logo.png">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap :: cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap :: local -->
    <link rel="stylesheet" href="/rentrover/bootstrap/bootstrap-css-5.3.3/bootstrap.min.css">

    <!-- css files -->
    <link rel="stylesheet" href="/rentrover/css/style.css">
    <link rel="stylesheet" href="/rentrover/css/profile.css">
    <link rel="stylesheet" href="/rentrover/css/user-detail.css">
    <link rel="stylesheet" href="/rentrover/css/aside.css">
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- my profile -->
        <div class="d-nones d-flex flex-column user-profile-container profile-content">
            <p class="m-0 fs-4 fw-semibold"> Profile Information </p>
            <p class="m-0 small"> Manage your Account details </p>

            <!-- top section -->
            <div class="d-flex flex-row gap-3 mt-4 align-items-center photo-username-email">
                <div class="photo">
                    <img src="/rentrover/assets/images/bishal.jpg" alt="">
                </div>
                <div class="username-email">
                    <p class="m-0 fw-semibold"> Mr. Beast | Admin </p>
                    <p class="m-0 text-secondary small"> someone@gmail.com </p>
                    <a href="/rentrover/pages/admin/profile.php?tab=edit" class="mt-3 text-primary small" id="edit-profile-trigger"> Edit Information </a>
                </div>
            </div>

            <hr class="mt-4 text-secondary" />

            <?php
            switch ($tab) {
                case 'edit':
                    include_once __DIR__ . '/sections/edit-profile.php';
                    break;
                case 'password-change':
                    include_once __DIR__ . '/sections/password-change.php';
                    break;
                default:
                    include_once __DIR__ . '/sections/view-profile.php';
            }
            ?>
        </div>
    </main>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <!-- script -->
    <script>
        $(document).ready(function () {
            // toggle password
            $('#password-toggle').click(function () {
                var type = $('#old-password').attr('type') === 'password' ? 'text' : 'password';
                togglePassword(type);
            });

            $('#password-toggle-label').click(function () {
                var type = $('#old-password').attr('type') === 'password' ? 'text' : 'password';
                togglePassword(type);
            });

            function togglePassword(type) {
                $('#old-password').attr('type', type);
                $('#new-password').attr('type', type);
                $('#new-password-confirmation').attr('type', type);

                if (type === "password") {
                    $('#password-toggle-label').html("Show password");
                } else {
                    $('#password-toggle-label').html("Hide password");
                }
            }
        });
    </script>
</body>

</html>