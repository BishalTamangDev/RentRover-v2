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
        <h1 class="m-0 mb-4 fw-semibold"> Registration </h1>

        <form action="/rentrover/app/app-registration.php" method="POST"
            class="container form p-0 mt-4 d-flex flex-column" id="registration-form">

            <!-- error message -->
            <p class="m-0 text-danger small error-message mb-3" id="error-message"> Error message appears here... </p>

            <!-- csrf token -->
            <input type="hidden" name="registration-csrf-token" id="registration-csrf-token" class="form-control"
                placeholder="csrf-token" required>

            <!-- role -->
            <div class="d-flex flex-row col-gap-4 row-gap-2 gap-3 mb-3 align-items-center justify-content-between">
                <p class="m-0"> Register&nbsp;as</label>

                <div class="d-flex flex-row gap-4">
                    <!-- role :: landlord -->
                    <div class="d-flex flex-row gap-2 role">
                        <input type="radio" name="role" value="landlord" id="role-landlord" required>
                        <label for="role-landlord" class="pointer"> Landlord </label>
                    </div>

                    <!-- role :: tenant -->
                    <div class="d-flex flex-row gap-2 role">
                        <input type="radio" name="role" value="tenant" id="role-tenant">
                        <label for="role-tenant" class="pointer"> Tenant </label>
                    </div>
                </div>
            </div>

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
            <div class="d-flex flex-row gap-2 mb-3 align-items-center fit-content px-2" id="password-toggle">
                <i class="fa-solid fa-eye pointer"></i>
                <p class="m-0 small pointer" id="password-toggle-label"> Show password </p>
            </div>

            <!-- registration button -->
            <button type="submit" class="btn btn-brand" id="register-btn"> Register Now </button>

            <div class="d-flex flex-column gap-3 flex-md-row justify-content-between mt-2 bottom">
                <p class="m-0 small">
                    Already have an account? <a href="/rentrover/login" class="text-primary"> Log in </a>
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

    <script>
        $(document).ready(function () {
            // csrf token generation
            function generateCsrfToken() {
                $.ajax({
                    url: '/rentrover/app/csrf-token-generation.php',
                    success: function (data) {
                        $('#registration-csrf-token').val(data);
                    }
                });
            }

            generateCsrfToken();

            // prevent space in email
            $('#email-field').keydown(function (event) {
                // Get the ASCII value
                var asciiValue = event.which || event.keyCode;
                if (asciiValue == 32) {
                    event.preventDefault();
                }
            });

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

            // form submission
            $('#registration-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/rentrover/app/app-registration.php',
                    data: $(this).serialize(),
                    type: "POST",
                    beforeSend: function () {
                        $('#register-btn').html('Registering...').prop('disabled', true);
                    },
                    success: function (response) {
                        if (response == "true") {
                            $('#error-message').html("Registration successful.").fadeIn();
                            $('#registration-form').trigger("reset");
                            setTimeout(function () {
                                window.location.href = '/rentrover/login';
                            }, 1000);

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