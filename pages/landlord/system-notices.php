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
    <link rel="stylesheet" href="/rentrover/css/aside.css">
    <link rel="stylesheet" href="/rentrover/css/filter.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- heading -->
        <p class="m-0 fs-4 fw-semibold"> System Notice </p>

        <!-- system notice -->
        <section class="system-notice-container mt-4" id="system-notice-container">
            <!-- system notice -->
            <div class="system-notice target-both">
                <div class="top">
                    <div class="title-div">
                        <p class="title"> Title </p>
                        <p class="for"> Both </p>
                    </div>
                </div>
                <p class="desciption"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est sint possimus esse
                    voluptas accusamus nobis expedita cupiditate tempore suscipit perspiciatis, culpa dolores dolorem
                    reprehenderit amet eos incidunt maiores recusandae doloribus minus quisquam unde nihil quia illum
                    saepe! Asperiores, illo esse odit nam nisi, dolor quos ullam neque aliquid sint unde? </p>
                <p class="date"> 0000-00-00 00:00:00 </p>
                <a href="" class="show-more"> Show More <i class="fa fa-arrow-right"></i> </a>
            </div>

            <!-- system notice -->
            <div class="system-notice target-landlord">
                <div class="top">
                    <div class="title-div">
                        <p class="title"> Title </p>
                        <p class="for"> Landlord</p>
                    </div>
                </div>
                <p class="desciption"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est sint possimus esse
                    voluptas accusamus nobis expedita cupiditate tempore suscipit perspiciatis, culpa dolores dolorem
                    reprehenderit amet eos incidunt maiores recusandae doloribus minus quisquam unde nihil quia illum
                    saepe! Asperiores, illo esse odit nam nisi, dolor quos ullam neque aliquid sint unde? </p>
                <p class="date"> 0000-00-00 00:00:00 </p>
                <a href="" class="show-more"> Show More <i class="fa fa-arrow-right"></i> </a>
            </div>
        </section>

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
    <script type="textjavascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {

            // toggle empty data
            function toggleEmptyContent() {
                $('.system-notice:visible').length == 0 ? $('#empty-context-container').show() : $('#empty-context-container').hide();
            }

            toggleEmptyContent();
        });
    </script>
</body>

</html>