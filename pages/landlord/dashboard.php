<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "dashboard";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Home </title>

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
    <link rel="stylesheet" href="/rentrover/css/system-notice.css">
    <link rel="stylesheet" href="/rentrover/css/feedback.css">
    <link rel="stylesheet" href="/rentrover/css/aside.css">
    <link rel="stylesheet" href="/rentrover/css/issue-card.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- cards -->
        <div class="card-v1-container">
            <!-- house -->
            <div class="card-v1">
                <div class="icon">
                    <i class="fa fa-building"></i>
                </div>

                <div class="details">
                    <p class="title"> Houses </p>
                    <p class="data" id="house-count"> 0 </p>
                </div>
            </div>

            <!-- Rooms -->
            <div class="card-v1">
                <div class="icon">
                    <i class="fa-solid fa-person-shelter"></i>
                </div>

                <div class="details">
                    <p class="title"> Rooms </p>
                    <p class="data" id="room-count"> 0 </p>
                </div>
            </div>

            <!-- tenant -->
            <div class="card-v1">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>

                <div class="details">
                    <p class="title"> Tenants </p>
                    <p class="data" id="tenant-count"> 0 </p>
                </div>
            </div>

            <!-- unsolved issues -->
            <div class="card-v1">
                <div class="icon">
                    <i class="fa fa-comments"></i>
                </div>

                <div class="details">
                    <p class="title"> Unsolved Issues </p>
                    <p class="data" id="unsolved-issue-count"> 0 </p>
                </div>
            </div>
        </div>

        <!-- issues -->
        <div class="mt-5 fw-semibold fs-3 heading"> Latest Issues </div>
        <section class="section mt-3 issue-container" id="issue-container">
            <!-- issue -->
            <div class="shadow-sm border issue-div">
                <div class="img-div">
                    <img src="/rentrover/uploads/blank.jpg" alt="">
                </div>
                <div class="detail-div">
                    <p class="name"> Name</p>
                    <p class="house-room"> House Room </p>
                    <p class="date"> 0000-00-00 </p>
                    <div class="feedback">
                        <div class="feedback-detail">
                            <p> "Issues" </p>
                        </div>
                    </div>

                    <!-- action -->
                    <div class="action">
                        <a href="/rentrover/landlord/tenant-detail/" class="btn btn-brand"> <i
                                class="fa-solid fa-arrow-up-right-from-square"></i> Show tenant detail </a>
                        <a href="/rentrover/landlord/room-detail/" class="btn btn-outlined-brand"> <i
                                class="fa-solid fa-arrow-up-right-from-square"></i> Show room detail </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- feedback trigger -->
        <div class="mt-5">
            <a class="pointer" data-bs-toggle="modal" data-bs-target="#feedback-modal"> <i
                    class="fa-regular fa-paper-plane"></i> Submit a feeback </a>
        </div>

    </main>

    <!-- modal :: feedback modal-->
    <?php require_once __DIR__ . '/../../sections/feedback.php'; ?>

    <!-- popup alert -->
    <div class="popup-alert-container" id="popup-alert-container">
        <p id="popup-message"> Popup alert content. </p>
    </div>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <!-- popup script -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <!-- feedback-js -->
    <script src="/rentrover/js/feedback-submit.js"></script>

    <script>
        $(document).ready(function () {
            // fetch latest issue
            function fetchLatestIssue() {
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/latest-issue-fetch.php',
                    type: 'POST',
                    data: { landlordId: <?= $r_id ?? 0 ?> },
                    success: function (data) {
                        $('#issue-container').html(data);
                    },
                });
            }

            function updateCountCard() {
                // count house
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-house.php',
                    type: "POST",
                    data: { landlordId: <?= $r_id ?> },
                    success: function (data) {
                        $('#house-count').html(data);
                    }
                });

                // count rooms
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-room.php',
                    success: function (data) {
                        $('#room-count').html(data);
                    }, error: function () {
                        $('#room-count').html("0");
                    }
                });

                // acquired rooms || current tenant count
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-acquired-room.php',
                    success: function (data) {
                        $('#tenant-count').html(data);
                    }, error: function () {
                        $('#tenant-count').html("0");
                    }
                });

                // count unsolved issues
                $.ajax({
                    type: 'POST',
                    data: { landlordId: <?= $r_id ?> },
                    url: '/rentrover/pages/landlord/app/count-unsolved-issue.php',
                    success: function (data) {
                        $('#unsolved-issue-count').html(data);
                    }, error: function () {
                        $('#unsolved-issue-count').html("0");
                    }
                });
            }

            updateCountCard();

            fetchLatestIssue();
        });
    </script>
</body>

</html>