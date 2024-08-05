<?php
if (!isset($tab)) {
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";
}
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
    <link rel="stylesheet" href="/rentrover/css/file-input.css">
    <link rel="stylesheet" href="/rentrover/css/user-detail.css">
    <link rel="stylesheet" href="/rentrover/css/header.css">
    <link rel="stylesheet" href="/rentrover/css/profile.css">
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header.php'; ?>

    <section class="d-flex flex-row gap-2 container main-container">
        <aside class="">
            <ul>
                <li class="<?php if ($tab == 'view' || $tab == 'edit')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/pages/tenant/profile.php?tab=view'">
                    <i class="fa fa-user"></i> <span> My Profile </span> </li>
                <li class="<?php if ($tab == 'security')
                    echo "active"; ?>"
                    onclick="window.location.href='/rentrover/pages/tenant/profile.php?tab=security'"> <i
                        class="fa fa-lock"></i> <span> Password & Security </span> </li>
                <li class="<?php if ($tab == 'room-notice')
                    echo "active"; ?>"
                    onclick="window.location.href='/rentrover/pages/tenant/profile.php?tab=room-notices'"> <i
                        class="fa-solid fa-bullhorn"></i> <span> Landlord Notices </span> </li>
                <li class="<?php if ($tab == 'tenancy-history')
                    echo "active"; ?>"
                    onclick="window.location.href='/rentrover/pages/tenant/profile.php?tab=tenancy-histories'"> <i
                        class="fa-solid fa-timeline"></i> <span> Tenancy History </span> </li>
                <li class="<?php if ($tab == 'applied-room')
                    echo "active"; ?>"
                    onclick="window.location.href='/rentrover/pages/tenant/profile.php?tab=applied-rooms'"> <i
                        class="fa-solid fa-file-contract"></i> <span> Applied Rooms </span> </li>
                <li class="<?php if ($tab == 'custom-application')
                    echo "active"; ?>"
                    onclick="window.location.href='/rentrover/pages/tenant/profile.php?tab=custom-applications'"> <i
                        class="fa-solid fa-gears"></i> <span> Custom Application </span> </li>
                <li class="<?php if ($tab == 'issue')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/pages/tenant/profile.php?tab=issues'">
                    <i class="fa-solid fa-triangle-exclamation"></i> <span> Issues </span> </li>
            </ul>
        </aside>

        <main id="content-container">
            <?php
            switch ($tab) {
                case 'security':
                    require_once __DIR__ . '/sections/security.php';
                    break;
                case 'room-notices':
                    require_once __DIR__ . '/sections/room-notices.php';
                    break;
                case 'tenancy-histories':
                    require_once __DIR__ . '/sections/tenancy-histories.php';
                    break;
                case 'applied-rooms':
                    require_once __DIR__ . '/sections/applied-rooms.php';
                    break;
                case 'custom-applications':
                    require_once __DIR__ . '/sections/custom-applications.php';
                    break;
                case 'issues':
                    require_once __DIR__ . '/sections/issues.php';
                    break;
                default:
                    require_once __DIR__ . '/sections/view-profile.php';
            }
            ?>
        </main>
    </section>

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
            // edit profile
            $('#delete-new-profile-photo').hide();
            $('#profile-photo').on('change', function (event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#existing-profile-picture').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                    $('#delete-new-profile-photo').show();
                } else {
                    event.preventDefault();
                    // load exiting photo
                    $('#delete-new-profile-photo').hide();
                    $('#existing-profile-picture').attr('src', '/rentrover/assets/images/bishal.jpg').show();
                }
            });

            $('#delete-new-profile-photo').click(function () {
                // load exiting photo
                $('#delete-new-profile-photo').hide();
                $('#existing-profile-picture').attr('src', '/rentrover/assets/images/bishal.jpg').show();
                $('#profile-photo').val('');
            });

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

        $('#all-simple-card').click(function () {
            toggleData("all");
        });

        $('#unsolved-simple-card').click(function () {
            toggleData("unsolved");
        });

        $('#solved-simple-card').click(function () {
            toggleData("solved");
        });

        function toggleData(type) {
            $('#all-simple-card').removeClass("active");
            $('#unsolved-simple-card').removeClass("active");
            $('#solved-simple-card').removeClass("active");

            if (type == "all") {
                $('#all-simple-card').addClass("active");
                $('.issue-row').show();
            } else {
                $('.issue-row').hide();

                if (type == "unsolved") {
                    $('.unsolved-row').show();
                    $('#unsolved-simple-card').addClass("active");
                } else if (type == "solved") {
                    $('.solved-row').show();
                    $('#solved-simple-card').addClass("active");
                }
            }

            toggleEmptyContent();
        }

        // toggle empty data
        function toggleEmptyContent() {
            $('.issue-row:visible').length == 0 ? $('#empty-data-foot').show() : $('#empty-data-foot').hide();
        }

        toggleEmptyContent();

        // citizenship photo
        // front citizensip
        $('#image-input-1').on('change', function (event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-file-1').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                event.preventDefault();
                $('#image-file-1').attr('src', '/rentrover/assets/images/blank.jpg').show();
            }
        });

        // back citizenship
        $('#image-input-2').on('change', function (event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-file-2').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                event.preventDefault();
                $('#image-file-2').attr('src', '/rentrover/assets/images/blank.jpg').show();
            }
        });

        // delete front citizenship
        $('#delete-image-1').click(function () {
            $('#image-file-1').attr('src', '/rentrover/assets/images/blank.jpg').show();
            $('#image-input-1').val('');
        });

        // delete back citizensip
        // delete front citizenship
        $('#delete-image-2').click(function () {
            $('#image-file-2').attr('src', '/rentrover/assets/images/blank.jpg').show();
            $('#image-input-2').val('');
        });
    </script>
</body>

</html>