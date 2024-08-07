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
                    <p class="title"> Impression  </p>
                    <p class="data"> 7,456 </p>
                </div>
            </div>
        </div>

        <!-- pie chart -->

        <!-- latest system notices -->
        <div class="mt-5 fw-semibold fs-3 heading"> Latest System Notice </div>
        <section class="system-notice-container mt-3" id="system-notice-container">
            <!-- system notice -->
            <div class="system-notice">
                <div class="top">
                    <div class="title-div">
                        <p class="title"> Title </p>
                        <p class="for"> Landlord/ Tenant</p>
                    </div>
                    <a id="system-notice-id">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                <p class="desciption"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est sint possimus esse
                    voluptas accusamus nobis expedita cupiditate tempore suscipit perspiciatis, culpa dolores dolorem
                    reprehenderit amet eos incidunt maiores recusandae doloribus minus quisquam unde nihil quia illum
                    saepe! Asperiores, illo esse odit nam nisi, dolor quos ullam neque aliquid sint unde? </p>
                <p class="date"> 0000-00-00 00:00:00 </p>
                <a href="" class="show-more"> Show More <i class="fa fa-arrow-right"></i> </a>
            </div>
        </section>

        <!-- feedbacks -->
        <div class="mt-5 fw-semibold fs-3 heading"> Latest User Feedback </div>
        <section class="section user-feedback-container mt-3">
            <!-- feedback -->
            <div class="user-feedback">
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

            <!-- feedback -->
            <div class="user-feedback">
                <div class="user-feedback-top">
                    <div class="img-div">
                        <img src="/rentrover/assets/images/shristi.jpg" alt="">
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

            <!-- feedback -->
            <div class="user-feedback">
                <div class="user-feedback-top">
                    <div class="img-div">
                        <img src="/rentrover/assets/images/rupak.png" alt="">
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

    <!-- script -->
    <script src="/rentrover/js/popup-alert.js"></script>
</body>

</html>