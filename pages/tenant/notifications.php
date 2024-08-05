<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Notifications </title>

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
    <link rel="stylesheet" href="/rentrover/css/notification.css">
    <link rel="stylesheet" href="/rentrover/css/header.css">
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header.php'; ?>

    <main class="container" style="margin-top:68px; padding-top:1px;">
        <p class="mt-5 fw-semibold fs-4 heading"> Notifications </p>

        <div class="notification-container mt-4">
            <!-- notification :: new user -->
            <div class="notification seen-notification">
                <div class="icon">
                    <img src="/rentrover/assets/icons/notifications/new-user.jpg" alt="">
                </div>

                <div class="detail">
                    <p class="title"> You joined us. </p>
                    <p class="date"> 0000-00-00 00:00:00 </p>
                    <a href="" class="btn btn-outline-primary action"> Show user detail </a>
                </div>

                <div class="delete">
                    <i class="fa fa-trash" id="delete-notification" data-id=""></i>
                </div>
            </div>
        </div>

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

    <!-- js :: notification & profile menu -->
    <script type="text/javascript" src="/rentrover/js/tenant.js"></script>

    <!-- script -->
    <script>
        $(document).ready(function () {
            // notification filter
            // all
            $('#all-notification-btn').click(function () {
                toggleNotification("all");
            });

            // unseen notification
            $('#unseen-notification-btn').click(function () {
                toggleNotification("unseen");
            });

            // seen notification
            $('#seen-notification-btn').click(function () {
                toggleNotification("seen");
            });

            function toggleNotification(type) {
                $('#all-notification-btn').removeClass("active");
                $('#unseen-notification-btn').removeClass("active");
                $('#seen-notification-btn').removeClass("active");

                if (type == "all") {
                    $('.notification').show();
                    $('#all-notification-btn').addClass("active");
                } else if (type == "unseen") {
                    $('.unseen-notification').show();
                    $('.seen-notification').hide();
                    $('#unseen-notification-btn').addClass("active");
                } else if (type == "seen") {
                    $('.seen-notification').show();
                    $('.unseen-notification').hide();
                    $('#seen-notification-btn').addClass("active");
                }

                emptyContext();
            }

            // empty context
            function emptyContext() {
                if ($('.notification:visible').length == 0) {
                    $('#empty-context-container').show();
                } else {
                    $('#empty-context-container').hide();
                }
            }

            emptyContext();
        });
    </script>
</body>

</html>