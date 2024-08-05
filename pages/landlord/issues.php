<?php
$page = "issues";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Issues </title>

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
    <link rel="stylesheet" href="/rentrover/css/aside.css">
    <link rel="stylesheet" href="/rentrover/css/issue.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <!-- card container -->
        <section class="card-v2-container">
            <!-- total issues -->
            <div class="card-v2">
                <p class="title"> Number of issues </p>
                <p class="data"> 120 </p>
            </div>

            <!-- solved issues -->
            <div class="card-v2">
                <p class="title"> Solved issues </p>
                <p class="data"> 12 </p>
            </div>

            <!-- unsolved issues -->
            <div class="card-v2">
                <p class="title"> Unsolved issues </p>
                <p class="data"> 108 </p>
            </div>
        </section>

        <!-- simple card -->
        <div class="simple-card-container mt-4">
            <p class="simple-card active" id="all-simple-card"> All </p>
            <p class="simple-card" id="unsolved-simple-card"> Unsolved </p>
            <p class="simple-card" id="solved-simple-card"> Solved </p>
        </div>

        <div class="table-container">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> Room ID </th>
                        <th scope="col"> Room No. </th>
                        <th scope="col"> Tenant </th>
                        <th scope="col"> Issued Date </th>
                        <th scope="col"> Solved Date </th>
                        <th scope="col" class="action"> </th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="issue-row solved-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td> 10256 </td>
                        <td> 4125 </td>
                        <td> Rupak Dangi </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <p class="text-primary pointer small" data-notice-id="" data-bs-toggle="modal"
                                data-bs-target="#issueModal"> Show details </p>
                        </td>
                    </tr>

                    <tr class="issue-row unsolved-row">
                        <th scope="row" class="serial"> 2 </th>
                        <td> 7845 </td>
                        <td> 9562 </td>
                        <td> Shristi Pradhan </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td> Unsolved </td>
                        <td class="action">
                            <p class="text-primary pointer small" data-notice-id="" data-bs-toggle="modal"
                                data-bs-target="#issueModal"> Show details </p>
                        </td>
                    </tr>
                </tbody>

                <tfoot id="empty-data-foot">
                    <tr>
                        <td colspan="9"> No data found! </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- issue modal -->
        <div class="modal modal-lg fade issue-modal" id="issueModal" tabindex="-1" aria-labelledby="issueModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="issueModalLabel"> Issue Details </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="d-flex flex-column modal-body">
                        <!-- issue -->
                        <div class="mb-2">
                            <p class="m-0 mb-2 fw-semibold"> Issue </p>
                            <p class="m-0"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum facilis, at
                                delectus ex incidunt veritatis. Nobis, eum minima! Dolores delectus exercitationem velit
                                ratione atque optio! </p>
                        </div>

                        <p class="small"> Issued date : 0000:00:00 </p>

                        <hr class="m-0 mb-2">

                        <!-- response -->
                        <div class="mb-3" id="issue-response-container">
                            <p class="m-0 mb-2 fw-semibold"> Issue response </p>
                            <p class="small text-danger error-message mb-2" id="error-message"> Error message appears
                                here.. </p>
                            <form action="" class="form" id="issue-response-form">
                                <textarea name="issue-response" id="issue-response" class="form-control"
                                    placeholder="Write the issue response here..." required></textarea>
                            </form>
                        </div>

                        <!-- action -->
                        <div class="action">
                            <button class="btn btn-success" id="solved-issue-btn"> <i class="fa-solid fa-check"></i>
                                Mark as Solved </button>
                            <button class="btn btn-outline-warning" id="issue-response-btn"> <i
                                    class="fa-regular fa-comment"></i> Send a message </button>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- script -->
    <script>
        $(document).ready(function () {
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
        });
    </script>
</body>

</html>