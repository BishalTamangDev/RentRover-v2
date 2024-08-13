<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/admin.php';
$profileUser = new Admin();

$profileUser->fetch($r_id, "all");

if (!isset($page))
    $page = "feedbacks";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Feedbacks </title>

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
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- card container -->
        <section class="card-v2-container">
            <!-- total feedbacks -->
            <div class="card-v2">
                <p class="title"> Total Feedbacks </p>
                <p class="data" id="feedback-count"> 0 </p>
            </div>
        </section>

        <!-- feedbacks -->
        <section class="section user-feedback-container mt-4" id="feedback-container">
            <!-- feedback -->
            <div class="d-none user-feedback">
                <div class="user-feedback-top">
                    <div class="img-div">
                        <img src="/rentrover/assets/images/bishal.jpg" alt="">
                    </div>
                    <div class="user-details">
                        <p class="feedback-user-name"> Username </p>
                        <p class="feedback-role"> Role </p>
                    </div>
                </div>

                <div class="feedback">
                    <div class="feedback-detail">
                        <p> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos velit sed ea reprehenderit
                            corporis dolor cupiditate fugiat qui ratione hic, placeat, sint odit earum consequatur."
                        </p>
                    </div>
                    <div class="rating-div">
                        <img src="/rentrover/assets/icons/full-star.png" alt="">
                        <img src="/rentrover/assets/icons/full-star.png" alt="">
                        <img src="/rentrover/assets/icons/half-star.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- empty context -->
        <div class="empty-context-container" id="empty-context-container">
            <img src="/rentrover/assets/images/empty.png" alt="">
            <p class="m-0 text-danger"> Empty! </p>
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

    <script>
        $(document).ready(function () {
            // fetch user feedbacks
            function loadLatestFeedback() {
                $.ajax({
                    url: '/rentrover/pages/admin/sections/load-all-feedbacks.php',
                    success: function (data) {
                        $('#feedback-container').html(data);
                        toggleEmptySection();
                    }, error: function () {
                        toggleEmptySection();
                    }
                });
            }

            // toggle empoty section
            function toggleEmptySection() {
                if ($('.user-feedback:visible').length == 0) {
                    $('#empty-context-container').show();
                } else {
                    $('#empty-context-container').hide();
                }
            }

            // count feedback
            function countFeedback(){
                $.ajax({
                    url: '/rentrover/pages/admin/app/count-feedback.php',
                    success: function (data) {
                        $('#feedback-count').html(data);
                    }
                });
            }

            countFeedback();

            loadLatestFeedback();

            toggleEmptySection();
        });
    </script>
</body>

</html>