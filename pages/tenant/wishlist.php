<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

$page = "wishlists";
if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Wishlist </title>

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

    <link rel="stylesheet" href="/rentrover/css/style.css">
    <link rel="stylesheet" href="/rentrover/css/room.css">
    <link rel="stylesheet" href="/rentrover/css/header.css">
    <link rel="stylesheet" href="/rentrover/css/footer.css">
    <link rel="stylesheet" href="/rentrover/css/wishlist.css">
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header.php'; ?>

    <main class="container main">
        <!-- heading -->
        <p class="mb-0 fw-semibold fs-5 text-secondary mt-5"> My Wishlist </p>

        <!-- wishlist container -->
        <section class="mt-4 wishlist-container">
            <!-- room container -->
            <section class="room-container" id="wishlist-room-container">
                <!-- backup -->
                <div class="d-none invisible room shadow-sm" data-rent="17000" data-floor="4">
                    <!-- image -->
                    <div class="room-image-div">
                        <img src="/rentrover/assets/images/room-2.jpg" alt="room image">
                    </div>

                    <!-- details -->
                    <div class="room-details">
                        <!-- location -->
                        <div class="location-wishlist">
                            <div class="location-container">
                                <abbr title="Pipalboat, Kathmandu">
                                    <p class="location">
                                        Pipalboat, Kathmandu
                                    </p>
                                </abbr>
                            </div>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>

                        <!-- specs :: number of room & floor -->
                        <p class="spec"> 2 Rooms, 3rd floor </p>

                        <!-- rent -->
                        <p class="rent"> NPR. 12,000/month </p>

                        <div class="room-bottom">
                            <div class="rating">
                                <img src="/rentrover/assets/icons/full-star.png" alt="">
                                <p class="fw-semibold small"> 2.4 </p>
                            </div>

                            <a href="/rentrover/tenant/room-detail/1" class="btn btn-outlined-brand show-more-btn">
                                Show More </a>
                        </div>
                    </div>
                </div>
            </section>

            <div class="invisible empty-context-container" id="empty-context-container">
                <img src="/rentrover/assets/images/empty.png" alt="">
                <p class="m-0 text-danger"> Your wishlist is empty! </p>
            </div>
        </section>
    </main>

    <!-- footer -->
    <?php require_once __DIR__ . '/../../sections/footer.php'; ?>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <script type="text/javascript" src="/rentrover/js/tenant.js"></script>

    <script>
        $(document).ready(function () {
            function loadWishlist() {
                $.ajax({
                    url: '/rentrover/pages/tenant/sections/load-wishlist.php',
                    type: "POST",
                    data: { userId: <?= $r_id ?> },
                    success: function (data) {
                        if (data == false) {
                            $('#empty-context-container').removeClass('invisible');
                        } else {
                            $('#empty-context-container').addClass('invisible');
                        }
                        $('#wishlist-room-container').html(data);
                    }
                });
            }

            loadWishlist();

            // wishlist
            $(document).on('click', '.wish-icon', function (e) {
                room_id = $(this).data('id');
                task = $(this).data('task');

                var targetIcon = $(this).closest("i");
                var targetRoomContainer = $(this).closest(".room");

                $.ajax({
                    url: '/rentrover/pages/tenant/app/toggle-wishlist.php',
                    data: { roomId: room_id, toDo: task },
                    type: 'POST',
                    beforeSend: function () {
                        if (task == 'add') {
                            targetIcon.data('task', 'remove');
                            targetIcon.addClass('fa-solid');
                            targetIcon.removeClass('fa-regular');
                        } else {
                            targetIcon.data('task', 'add');
                            targetIcon.addClass('fa-regular');
                            targetIcon.removeClass('fa-solid');
                            targetRoomContainer.hide();
                            toggleEmptySection();
                        }
                    },
                    success: function (response) {
                        if (response != true) {
                            location.reload();
                        }
                        loadWishlistCount();
                    }
                });

                function toggleEmptySection() {
                    if ($('.room:visible').length == 0) {
                        $('#empty-context-container').removeClass('invisible').fadeIn("slow");
                    }
                }
            });

            // load wishlist count
            $(document, loadWishlistCount());
        });
    </script>
</body>

</html>