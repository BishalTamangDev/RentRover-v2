<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Password Recovery </title>

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
</head>

<body>
    <section class="container position-absolute rounded login-container">
        <div class="heading d-flex flex-row w-100 justify-content-between mb-4 align-items-centers">
            <h1 class="m-0 fw-semibold"> Password Recovery </h1>
            <a href="/rentrover/login" class="fa fa-multiply fs-4 pointer mt-2 text-secondary"> </a>
        </div>

        <hr class="mb-3" />

        <!-- error message -->
        <p class="m-0 text-danger small error-message" id="error-message"> Error message appears here... </p>

        <form action="" method="POST" class="container form p-0 mt-4 d-flex flex-column" id="password-recovery-form">
            <!-- csrf token -->
            <input type="hidden" name="csrf-token" id="csrf-token" class="form-control" placeholder="csrf-token"
                required>

            <!-- email address -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-regular fa-envelope small"></i>
                </span>
                <input type="email" class="form-control" id="email-field" placeholder="Email address" aria-label="email"
                    aria-describedby="basic-addon1" required>
            </div>

            <!-- new password -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-lock small"></i>
                </span>
                <input type="password" class="form-control" id="password-field-1" placeholder="New password"
                    aria-label="password" minlength="8" required>
            </div>

            <!-- new password confirmation -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-lock small"></i>
                </span>
                <input type="password" class="form-control" id="password-field-2" placeholder="Enter password again"
                    aria-label="password" minlength="8" required>
            </div>

            <!-- password visibility toggle -->
            <div class="d-flex flex-row gap-2 mb-3 align-items-center fit-content px-2" id="password-toggle">
                <i class="fa-solid fa-eye pointer"></i>
                <p class="m-0 small pointer" id="password-toggle-label"> Show password </p>
            </div>

            <!-- reset button -->
            <button type="submit" class="btn btn-brand" id="reset-btn"> Reset Password </button>
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
                var type = $('#password-field-1').attr('type') === 'password' ? 'text' : 'password';
                $('#password-field-1').attr('type', type);
                $('#password-field-2').attr('type', type);
                if (type === 'password') {
                    $('#password-toggle-label').html("Show password");
                } else {
                    $('#password-toggle-label').html("Hide password");
                }
            });
        });
    </script>
</body>

</html>