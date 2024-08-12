<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "system-notices";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Notice </title>

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
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/aside.css">
    <link rel="stylesheet" href="/rentrover/css/filter.css">
    <link rel="stylesheet" href="/rentrover/css/notice.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- heading -->
        <p class="m-0 fs-4 fw-semibold"> My Notices </p>

        <!-- new notice -->
        <button class="btn btn-brand fit-content mt-3" data-bs-toggle="modal" data-bs-target="#noticeModal"> Create new
            notice </button>

        <!-- room notice -->
        <section class="system-notice-container mt-4" id="notice-container">
            <div class="d-none invisible system-notice">
                <div class="top">
                    <p class="title fw-semibold fs-4"> Title </p>
                </div>

                <p class="desciption"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est sint possimus esse
                    voluptas accusamus nobis expedita cupiditate tempore suscipit perspiciatis, culpa dolores dolorem
                    reprehenderit amet eos incidunt maiores recusandae doloribus minus quisquam unde nihil quia illum
                    saepe! Asperiores, illo esse odit nam nisi, dolor quos ullam neque aliquid sint unde? </p>
                <p class="date"> 0000-00-00 00:00:00 </p>
            </div>
        </section>

        <div class="d-none empty-context-container" id="empty-context-container">
            <img src="/rentrover/assets/images/empty.png" alt="">
            <p class="m-0 text-danger"> Empty! </p>
        </div>

        <!-- notice modal -->
        <div class="modal modal-lg fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4 fw-semibold" id="noticeModalLabel"> Notice Form </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="notice-form-close-btn"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- erro message -->
                        <p class="text-danger small mb-2 error-message" id="notice-error-message"> Message appears
                            here... </p>

                        <form action="" class="form d-flex flex-column" id="landlord-notice-form">
                            <!-- house && room selection -->
                            <div class="d-flex flex-row gap-2 mb-3">
                                <div class="w-50">
                                    <p class="m-2 small"> Select House </p>
                                    <select name="notice-house" id="notice-house" class="form-select" required>
                                        <option value="" selected hidden> Select house </option>
                                    </select>
                                </div>

                                <div class="w-50">
                                    <p class="m-2 small"> Select Room </p>
                                    <select name="notice-room" id="notice-room" class="form-select" required>
                                        <option value="" selected hidden> Select room </option>
                                    </select>
                                </div>
                            </div>

                            <!-- notice -->
                            <div class="mb-3">
                                <p class="small"> Title </p>
                                <input type="text" name="notice-title" id="notice-title" class="form-control mb-3"
                                    required>
                            </div>

                            <div class="mb-3">
                                <p class="small"> Description </p>
                                <textarea name="notice-description" id="notice-description" class="form-control"
                                    placeholder="Enter the notice here..." required></textarea>
                            </div>

                            <!-- action -->
                            <button type="submit" class="btn btn-brand" id="notify-btn"> <i class="fa fa-bullhorn"></i>
                                Notify Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <script>
        $(document).ready(function () {
            // load notices
            function loadNotices() {
                $.ajax({
                    type: "POST",
                    url: "/rentrover/pages/landlord/sections/fetch-notice-for-landlord.php",
                    data: { landlordId: <?= $r_id ?> },
                    success: function (data) {
                        $('#notice-container').html(data);
                        toggleEmptyContent();
                    }
                });
            }

            // load houses for select
            function loadHouse() {
                $.ajax({
                    type: "POST",
                    url: "/rentrover/pages/landlord/sections/fetch-house-id-for-select.php",
                    data: { landlordId: <?= $r_id ?> },
                    success: function (data) {
                        $('#notice-house').append(data);
                    },
                });
            }

            // load houses for room
            function loadRoom(house_id) {
                $.ajax({
                    type: "POST",
                    url: "/rentrover/pages/landlord/sections/fetch-acquired-room-for-select.php",
                    data: { houseId: house_id },
                    success: function (data) {
                        $('#notice-room').html(data);
                    },
                });
            }

            loadNotices();

            loadHouse();

            $('#notice-house').on('change', function () {
                loadRoom($('#notice-house').val());
            });

            // load tenant after selecting house

            // toggle empty data
            function toggleEmptyContent() {
                $('#empty-context-container').addClass('d-none').removeClass('d-flex');
                var count = $('.system-notice:visible').length;
                if (count == 0)
                    $('#empty-context-container').addClass('d-flex').removeClass('d-none');
            }

            toggleEmptyContent();

            // notice form submission
            $('#landlord-notice-form').submit(function (e) {
                e.preventDefault();
                var house_id = $('#notice-house').val();
                var room_id = $('#notice-room').val();
                var notice_title = $('#notice-title').val();
                var notice_description = $('#notice-description').val();

                if ($.trim(notice_title) == '') {
                    $('#notice-error-message').html("Please enter the valid title").fadeIn();
                    $('#notice-title').focus();
                } else {
                    if ($.trim(notice_description) == '') {
                        $('#notice-error-message').html("Please enter the valid description").fadeIn();
                        $('#notice-description').focus();
                    } else {
                        // valid details
                        $('#notice-error-message').fadeOut();

                        // register
                        $.ajax({
                            type: "POST",
                            url: "/rentrover/pages/landlord/app/add-notice.php",
                            data: $(this).serialize(),
                            beforeSend: function () {
                                $('#notify-btn').html('<i class="fa fa-bullhorn"></i> Notifying')
                            },
                            success: function (response) {
                                loadNotices();
                                if (response == true) {
                                    $('#landlord-notice-form').trigger("reset");
                                    $('#notice-form-close-btn').click();
                                    showPopupAlert("Notified.");
                                } else {
                                    $('#notice-error-message').html("An error occured").fadeIn();
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>