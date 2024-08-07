<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/admin.php';
$profileUser = new Admin();

$profileUser->fetch($r_id, "all");

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
    <link rel="stylesheet" href="/rentrover/css/dashboard.css">

    <!-- script -->
    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"> </script>
</head>

<body>
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- cards -->
        <div class="card-v1-container">
            <!-- users -->
            <div class="card-v1">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>

                <div class="details">
                    <p class="title"> Users </p>
                    <p class="data" id="user-count"> 0 </p>
                </div>
            </div>

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
                    <p class="data"> 18,566 </p>
                </div>
            </div>

            <!-- feedbacks -->
            <div class="card-v1">
                <div class="icon">
                    <i class="fa fa-comments"></i>
                </div>

                <div class="details">
                    <p class="title"> Feedbacks </p>
                    <p class="data"> 40K </p>
                </div>
            </div>
        </div>

        <!-- pie chart -->
        <!-- chart container -->
        <div class="chart-container mt-5">
            <!-- user pie chart -->
            <canvas id="room-pie-chart"> </canvas>
        </div>

        <!-- latest system notices -->
        <p class="mt-5 fw-semibold fs-3 heading"> Latest System Notice </p>
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

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <script>
        // user pie chart
        var roomChart = new Chart($('#room-pie-chart'), {
            type: 'pie',
            data: {
                labels: ['Acquired Rooms', 'Unacquired Rooms'],
                datasets: [{
                    backgroundColor: ['#5CBEDB', 'lightgray'],
                    data: [0, 0],
                }]
            },
            options: {
                borderColor: 'white',
                responsize: true,
            }
        });

        $(document).ready(function () {
            var userCount = 0;
            var houseCount = 0;

            // counting users
            function animatedUserCounting() {
                var count = 0;

                var interval = setInterval(function () {
                    if (count <= userCount) {
                        $('#user-count').html(count++);
                        roomChart.data.datasets[0].data[0] = count;
                        roomChart.update();
                    } else {
                        clearInterval(interval);
                    }

                }, 150);
            }

            // counting houses
            function animatedHouseCounting() {
                var count = 0;

                var interval = setInterval(function () {
                    if (count <= houseCount) {
                        $('#house-count').html(count++);
                    } else {
                        clearInterval(interval);
                    }

                }, 150);
            }

            // all users
            $.ajax({
                url: '/rentrover/pages/admin/app/count-user.php',
                type: "POST",
                success: function (data) {
                    // animate user count
                    userCount = data;
                    animatedUserCounting();
                },
                error: function (data) {
                    $('#user-count').html('0');
                },
            });

            // count house
            $.ajax({
                url: '/rentrover/pages/admin/app/count-house.php',
                type: "POST",
                success: function (data) {
                    houseCount = data;
                    animatedHouseCounting();
                },
                error: function (data) {
                    $('#house-count').html('0');
                },
            });
        });
    </script>
</body>

</html>