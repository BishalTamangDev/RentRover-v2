<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

$page = "profile";
if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$tempPhotoSrc = '/rentrover/uploads/blank.jpg';
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
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/notice.css">
    <link rel="stylesheet" href="/rentrover/css/profile.css">

    <!-- prevent resubmission of the form -->
    <script>
        if (window.history.replaceState)
            window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . '/sections/header.php'; ?>

    <section class="d-flex flex-row gap-2 container main-container">
        <aside class="">
            <ul>
                <li class="<?php if ($tab == 'view' || $tab == 'edit')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/tenant/profile/'">
                    <i class="fa fa-user"></i> <span> My Profile </span>
                </li>
                <li class="<?php if ($tab == 'security')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/tenant/profile/security'"> <i
                        class="fa fa-lock"></i> <span> Security </span> </li>
                <li class="<?php if ($tab == 'room-notices')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/tenant/profile/room-notices'"> <i
                        class="fa-solid fa-bullhorn"></i> <span> Room Notices </span> </li>
                <li class="<?php if ($tab == 'tenancy-histories')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/tenant/profile/tenancy-histories'"> <i
                        class="fa-solid fa-timeline"></i> <span> Tenancy History </span> </li>
                <li class="<?php if ($tab == 'applied-rooms')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/tenant/profile/applied-rooms'"> <i
                        class="fa-solid fa-file-contract"></i> <span> Applied Rooms </span> </li>
                <li class="<?php if ($tab == 'issues')
                    echo "active"; ?>" onclick="window.location.href='/rentrover/tenant/profile/issues'">
                    <i class="fa-solid fa-triangle-exclamation"></i> <span> Issues </span>
                </li>
            </ul>
        </aside>

        <main id="content-container">
            <?php
            switch ($tab) {
                case 'view':
                    require_once __DIR__ . '/sections/view-profile.php';
                    break;
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
                case 'issues':
                    require_once __DIR__ . '/sections/issues.php';
                    break;
                default:
                    require_once __DIR__ . '/sections/view-profile.php';
            }
            ?>
        </main>
    </section>

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

    <script type="text/javascript" src="/rentrover/js/tenant.js"></script>

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <script>
        $(document).ready(function () {
            // csrf token generation
            function generateCsrfTokenForPasswordChange() {
                $.ajax({
                    url: '/rentrover/app/csrf-token-generation.php',
                    success: function (data) {
                        $('#password-csrf-token').val(data);
                    }
                });
            }

            // load wishlist count
            $(document, loadWishlistCount());

            generateCsrfTokenForPasswordChange();

            // edit profile
            $('#delete-profile-photo').hide();

            // profile photo
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

            // delete profile photo
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

            // profile photo change :: instant preview
            $(document).on('change', '#profile-photo', function (e) {
                var file = e.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile-photo-container').attr('src', e.target.result).show();
                        $('#delete-profile-photo').removeClass("invisible");
                    }
                    reader.readAsDataURL(file);
                } else {
                    e.preventDefault();

                    $('#profile-photo-container').attr('src', '<?= $tempPhotoSrc ?>').show();
                }
            });

            // deleting new profile
            $(document).on('click', '#delete-profile-photo', function () {
                $('#profile-photo-container').attr('src', '<?= $tempPhotoSrc ?>').show();
                $('#profile-photo').val('');
                $('#delete-profile-photo').addClass("invisible");
            });

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

            // delete front citizenship
            $('#delete-image-2').click(function () {
                $('#image-file-2').attr('src', '/rentrover/assets/images/blank.jpg').show();
                $('#image-input-2').val('');
            });

            // upload kyc
            $(document).on('submit', '#kyc-form', function (e) {
                e.preventDefault();
                var formData = new FormData($('#kyc-form')[0]);

                $.ajax({
                    url: '/rentrover/app/kyc-upload.php',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#kyc-upload-btn').html('Uploading kyc document...').prop('disabled', true);
                    },
                    success: function (response) {
                        if (response == "true") {
                            showPopupAlert("Document uploaded successfully.");
                            setTimeout(function () {
                                window.location.href = '/rentrover/tenant/profile';
                            }, 2000);
                        } else {
                            $('#error-message').html("An unexpected error occured. Please try again.").show();
                        }
                        $('#kyc-upload-btn').html('Upload').prop('disabled', false);
                    }, error: function () {
                        $('#kyc-upload-btn').html('Upload').prop('disabled', false);
                    }
                });
            });

            // profile update
            $(document).on('submit', '#profile-form', function (e) {
                e.preventDefault();
                var formData = new FormData($('#profile-form')[0]);

                // phone number validation
                if($('#phone-number').val().length != 10) {
                    $('#error-message').html('Please enter valid phone number.').fadeIn();
                    $('#phone-number').focus();
                } else {
                    $.ajax({
                        url: '/rentrover/app/edit-profile.php',
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $('#update-profile-btn').html('Updating Information...').prop('disabled', true);
                        },
                        success: function (response) {
                            if (response) {
                                // alert meesage
                                showPopupAlert("Profile updated successfully.");
                                setTimeout(function () {
                                    window.location.href = '/rentrover/tenant/profile'
                                }, 2000);
                            } else {
                                $('#error-message').html(response).show();
                                $('#update-profile-btn').html('Update Information').prop('disabled', false);
                            }
                        },
                        error: function () {
                            $('#error-message').html("An unexpected error occured. Please try again.").show();
                            $('#update-profile-btn').html('Update Information').prop('disabled', false);
                        }
                    });
                }
            });

            // password change
            $(document).on('submit', '#password-form', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/rentrover/app/change-password.php',
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#update-password-btn').html("Updating password").prop('disabled', true);
                    },
                    success: function (response) {
                        if (response == true) {
                            $('#password-form').trigger("reset");
                            $('#error-message').html("").hide();
                            showPopupAlert("Password updated successfully.");
                            setTimeout(function () {
                                window.location.href = "/rentrover/tenant/profile/";
                            }, 2000);
                        } else {
                            $('#error-message').html(response).show();
                        }
                        $('#update-password-btn').prop('disabled', false).html("Update Password");
                    },
                    error: function () {
                        $('#update-password-btn').prop('disabled', false).html("Update Password");
                    },
                });
            });

            // load applications
            function loadRoomApplication() {

            };

            // apply for verification
            $('#apply-for-verification-trigger').click(function () {
                $.ajax({
                    url: '/rentrover/app/apply-for-verification.php',
                    success: function (response) {
                        if (response == true) {
                            showPopupAlert("Your account has been submitted for the verification process.");
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            showPopupAlert("An error occured.");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>