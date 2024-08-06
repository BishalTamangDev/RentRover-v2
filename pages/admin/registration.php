<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Registration </title>

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
    <link rel="stylesheet" href="/rentrover/css/login.css">

    <!-- prevent resubmission of the form -->
    <script>
        if (window.history.replaceState)
            window.history.replaceState(null, null, window.location.href);
    </script>
</head>

<body>
    <section class="container position-absolute rounded login-container">
        <div class="d-flex flex-row align-items-center justify-content-between mb-4 heading">
            <h3 class="m-0"> Registration </h3>
            <a href="/rentrover/admin/login">
                <i class="fa fa-multiply fs-4 text-dark"></i>
            </a>
        </div>

        <!-- error message -->
        <p class="m-0 text-danger small error-message" id="error-message"> Error message appears here... </p>

        <form method="POST" class="container form p-0 mt-3 d-flex flex-column" id="registration-form">
            <input type="hidden" name="csrf-token" id="csrf-token" class="form-control mb-3" placeholder="csrf token"
                required>

            <!-- email address -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-regular fa-envelope small"></i>
                </span>
                <input type="email" name="email" class="form-control" id="email-field" placeholder="Email address"
                    aria-label="email" aria-describedby="basic-addon1" required>
            </div>

            <!-- password -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-lock small"></i>
                </span>
                <input type="password" name="password" class="form-control" id="password-field" placeholder="Password"
                    aria-label="password" aria-describedby="basic-addon1" minlength="8" required>
            </div>

            <!-- password visibility toggle -->
            <div class="d-flex flex-row gap-2 mb-3 align-items-center fit-content" id="password-toggle">
                <i class="fa-solid fa-eye pointer"></i>
                <p class="m-0 small pointer" id="password-toggle-label"> Show password </p>
            </div>

            <!-- regietr btn -->
            <button type="submit" name="register-btn" id="register-btn" class="btn btn-brand"> Register Now </button>

            <div class="d-flex flex-column gap-3 flex-md-row justify-content-between mt-2 bottom">
                <p class="m-0 small">
                    Already have an account? <a href="/rentrover/admin/login" class="text-primary"> Log in
                    </a>
                </p>
            </div>
        </form>
    </section>

    <!-- bootstrap js :: cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- bootstrap js :: local -->
    <script type="text/javascript" src="/rentrover/bootstrap/bootstrap-js-5.3.3/bootstrap.bundle.min.js"> </script>

    <!-- jquery -->
    <script src="/rentrover/jquery/jquery-3.7.1.min.js"></script>

    <!-- script -->
    <script>
        $(document).ready(function () {
            // toggle password
            $('#password-toggle').click(function () {
                var type = $('#password-field').attr('type') === 'password' ? 'text' : 'password';
                $('#password-field').attr('type', type);
                if (type === 'password') {
                    $('#password-toggle-label').html("Show password");
                } else {
                    $('#password-toggle-label').html("Hide password");
                }
            });

            // csrf token generation
            function generateCsrfToken() {
                $.ajax({
                    url: '/rentrover/app/csrf-token-generation.php',
                    success: function (data) {
                        $('#csrf-token').val(data);
                    }
                });
            }

            generateCsrfToken();

            // email
            $('#email-field').keydown(function (event) {
                // Get the ASCII value
                var asciiValue = event.which || event.keyCode;
                if (asciiValue == 32) {
                    event.preventDefault();
                }
            });

            // password
            $('#password-field').keydown(function (event) {
                // Get the ASCII value
                // var asciiValue = event.which || event.keyCode;
                // if (asciiValue == 32) {
                //     event.preventDefault();
                // }
            });

            // form submission
            $('#registration-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/rentrover/pages/admin/app/app-registration.php',
                    data: $(this).serialize(),
                    type: "POST",
                    beforeSend: function () {
                        $('#register-btn').html('Registering...').prop('disabled', true);
                    },
                    success: function (response) {
                        if (response == "true") {
                            $('#error-message').html("Registration successful.").fadeIn();
                        } else {
                            $('#error-message').html(response).fadeIn();
                        }
                        $('#register-btn').html("Register Now").prop('disabled', false);
                    },
                    error: function () {
                        $('#error-message').html("An error occured.").fadeIn();
                        $('#register-btn').html("Register Now").prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

</html>