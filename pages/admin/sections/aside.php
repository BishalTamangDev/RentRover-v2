<?php
require_once __DIR__ . '/../../../classes/admin.php';

if (!isset($profileUser))
    $profileUser = new Admin();

if (!isset($page))
    $page = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Aside : Admin </title>

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
    <link rel="stylesheet" href="/rentrover/css/aside.css">

    <!-- prevent resubmission of the form -->
    <script>
        if (window.history.replaceState)
            window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body>
    <!-- header -->
    <header class="position-fixed w-100 d-flex flex-row gap-3 p-3 justify-content-end align-items-center header">
        <!-- search form -->
        <form class="d-flex flex-row" id="search-form">
            <input type="search" id="content" name="content" placeholder="search here" class="form-control" required>
        </form>

        <!-- notification -->
        <div class="position-relative notification-section">
            <div class="position-relative notification-icon pointer" id="notification-icon">
                <i class="fa-regular fa-bell fs-5 pt-1 text-secondary pointer"></i>
                <div class="position-absolute text-danger fw-semibold notification-counter"> 9<sup>+</sup></div>
            </div>

            <!-- container -->
            <div class="position-absolute flex-column shadow notification-container" id="notification-container">
                <div class="d-flex flex-row justify-content-between p-3 border-bottom notification-heading">
                    <div class="d-flex flex-column gap-1 title">
                        <h5 class="m-0"> Notifications </h5>
                        <a href="/rentrover/admin/notifications" class="m-0 small text-primary"> Show all </a>
                    </div>

                    <i class="fa fa-multiply fs-5 pointer" id="notification-close"></i>
                </div>
                <!-- notification 1 -->
                <div class="d-flex flex-row gap-2 notification">
                    <!-- icon -->
                    <div class="notification-icon">
                        <img src="/rentrover/assets/icons/verified.png" alt="">
                    </div>

                    <!-- details -->
                    <div class="notification-details">
                        <!-- detail -->
                        <p class="m-0 small"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus,
                            numquam? </p>

                        <!-- date -->
                        <p class="m-0 small text-secondary"> 0000-00-00 00:00:00 </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- profile -->
        <div class="position-relative profile-container">
            <div class="profile" id="profile-image-container">
                <?php
                if ($profileUser->profilePhoto != "") {
                    ?>
                    <img src="/rentrover/uploads/admins/<?= $profileUser->profilePhoto ?>" alt="user profile photo"
                        class="pointer">
                    <?php
                } else {
                    ?>
                    <img src="/rentrover/uploads/blank-profile.jpg" alt="user profile photo" class="pointer">
                    <?php
                }
                ?>
            </div>

            <!-- user menu -->
            <div class="position-absolute shadow-sm profile-menu" id="profile-menu">
                <ul>
                    <li onclick="window.location.href='/rentrover/admin/profile'"> <i class="fa fa-user"></i>
                        <span> My Profile </span>
                    </li>
                    <li onclick="window.location.href='/rentrover/pages/admin/app/logout.php'"> <i
                            class="fa-solid fa-arrow-right-from-bracket"></i> <span> Logout </span> </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- aside -->
    <aside class="position-fixed aside">
        <!-- menu bar -->
        <div class="menu-bar-div">
            <i class="fa fa-bars fs-5 pointer" id="menu-bar"></i>
        </div>

        <ul>
            <!-- home -->
            <li class="<?= $page == 'dashboard' ? 'active' : 'inactive'; ?>"
                onclick="window.location.href='/rentrover/admin/dashboard'">
                <i class="fa fa-home"></i>
                <span id="ul-span"> Dashboard </span>
            </li>

            <!-- users -->
            <li class="<?= $page == 'users' || $page == "user-detail" ? 'active' : 'inactive'; ?>"
                onclick="window.location.href='/rentrover/admin/users'">
                <i class="fa fa-users"></i>
                <span> Users </span>
            </li>

            <!-- houses -->
            <li class="<?= $page == 'houses' || $page == "house-detail" ? 'active' : 'inactive'; ?>"
                onclick="window.location.href='/rentrover/admin/houses'">
                <i class="fa fa-building"></i>
                <span> Houses </span>
            </li>

            <!-- rooms -->
            <li class="<?= $page == 'rooms' || $page == "room-detail" ? 'active' : 'inactive'; ?>"
                onclick="window.location.href='/rentrover/admin/rooms'">
                <i class="fa-solid fa-person-shelter"></i>
                <span> Rooms </span>
            </li>

            <!-- feedbacks -->
            <li class="<?= $page == 'feedbacks' ? 'active' : 'inactive'; ?>"
                onclick="window.location.href='/rentrover/admin/feedbacks'">
                <i class="fa-regular fa-comment"></i>
                <span> Feedbacks </span>
            </li>

            <!-- system notice application -->
            <li class="<?= $page == 'notices' ? 'active' : 'inactive'; ?>"
                onclick="window.location.href='/rentrover/admin/notices'">
                <i class="fa fa-bullhorn"></i>
                <span> Notices </span>
            </li>
        </ul>
    </aside>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#notification-container').hide();
            $('#profile-menu').hide();

            // notification
            $('#notification-icon').click(function () {
                if ($('#notification-container:visible').length) {
                    $('#notification-container').hide();
                } else {
                    if ($('#profile-menu:visible').length)
                        $('#profile-menu').hide();
                    $('#notification-container').show();
                }
            });

            // profile
            $('#profile-image-container').click(function () {
                if ($('#profile-menu:visible').length) {
                    $('#profile-menu').hide();
                } else {
                    if ($('#notification-container:visible').length)
                        $('#notification-container').hide();
                    $('#profile-menu').show();
                }
            });

            $('#notification-close').click(function () {
                $('#notification-container').hide();
            });

            function toggleAside() {
                if (!$('#ul-span:visible').length) {
                    $('.aside').css(
                        { 'width': '220px' }
                    );
                    $('.aside ul li span').css({
                        'display': 'inline-block',
                    });
                } else {
                    $('.aside').css(
                        { 'width': 'auto' }
                    );
                    $('.aside ul li span').css({
                        'display': 'none',
                    });
                }
            }

            $('#menu-bar').click(function () {
                toggleAside();
            });

            $(window).on('resize', function () {
                if ($(window).width() >= 1200) {
                    // show
                    $('.aside').css(
                        { 'width': '220px' }
                    );
                    $('.aside ul li span').css({
                        'display': 'inline-block',
                    });
                } else {
                    if ($('#ul-span:visible').length) {

                        $('.aside').css(
                            { 'width': 'auto' }
                        );
                        $('.aside ul li span').css({
                            'display': 'none',
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>