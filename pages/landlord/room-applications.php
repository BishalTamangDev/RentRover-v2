<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "room-applications";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Room Applications </title>

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
    <link rel="stylesheet" href="/rentrover/css/filter.css">
    <link rel="stylesheet" href="/rentrover/css/popup-alert.css">
    <link rel="stylesheet" href="/rentrover/css/room-application.css">
</head>

<body>
    <!-- aside -->
    <?php
    require_once __DIR__ . '/sections/aside.php';
    ?>

    <main>
        <!-- card container -->
        <section class="card-v2-container">
            <!-- total tenants -->
            <div class="card-v2">
                <p class="title"> Total Applications </p>
                <p class="data" id="total-application-count"> 0 </p>
            </div>

            <!-- pending -->
            <div class="card-v2">
                <p class="title"> Pending </p>
                <p class="data" id="pending-application-count"> 0 </p>
            </div>

            <!-- accepted -->
            <div class="card-v2">
                <p class="title"> Accepted </p>
                <p class="data" id="accepted-application-count"> 0 </p>
            </div>

            <!-- rejected -->
            <div class="card-v2">
                <p class="title"> Rejected </p>
                <p class="data" id="rejected-application-count"> 0 </p>
            </div>

            <!-- expired -->
            <div class="card-v2">
                <p class="title"> Expired </p>
                <p class="data" id="expired-application-count"> 0 </p>
            </div>

            <!-- cancelled -->
            <div class="card-v2">
                <p class="title"> Cancelled </p>
                <p class="data" id="cancelled-application-count"> 0 </p>
            </div>
        </section>

        <!-- filter -->
        <section class="filter-container">
            <!-- rent type -->
            <div class="parameter">
                <label for="filter-rent-type"> Rent Type </label>
                <select name="filter-rent-type" class="form-select-sm" id="filter-rent-type">
                    <option value="all"> All </option>
                    <option value="fixed"> Fixed </option>
                    <option value="not-fixed"> Not-fixed </option>
                </select>
            </div>

            <!-- status -->
            <div class="parameter">
                <label for="filter-status"> Status </label>
                <select name="filter-status" class="form-select-sm" id="filter-status">
                    <option value="all"> All </option>
                    <option value="pending"> Pending </option>
                    <option value="accepted"> Accepted </option>
                    <option value="rejected"> Rejected </option>
                    <option value="cancelled"> Cancelled </option>
                    <option value="expired"> Expired </option>
                </select>
            </div>

            <div class="clear" id="clear">
                <p> Clear <span> <i class="fa fa-multiply"></i></span> </p>
            </div>
        </section>

        <!-- application container -->
        <div class="application-container table-container">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> House </th>
                        <th scope="col"> Room Number </th>
                        <th scope="col"> Applicant </th>
                        <th scope="col"> Rent Type </th>
                        <th scope="col"> Move In Date </th>
                        <th scope="col"> Move Out Date </th>
                        <th scope="col"> Status </th>
                        <th scope="col"> Applied Date </th>
                    </tr>
                </thead>

                <tbody id="application-table-body">
                    <tr class="invisible application-row rent-not-fixed pending-row accepted-row rejected-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td> House </td>
                        <td> Room number </td>
                        <td> Rupak dangi </td>
                        <td> Fixed </td>
                        <td> 00-00-00 </td>
                        <td> - </td>
                        <td> Pending </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <p class="small text-primary pointer" data-bs-toggle="modal"
                                data-bs-target="#applicationModal">
                                Show details
                            </p>
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

        <!-- notice modal -->
        <div class="modal modal-lg fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4 fw-semibold" id="applicationModalLabel"> Application Detail </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="modal-close"></button>
                    </div>
                    <div class="modal-body" id="application-detail-modal-body">
                        <!-- erro message -->
                        <p class="text-danger small mb-2 error-message" id="error-message"> Message appears here... </p>

                        <div class="form d-flex flex-column flex-md-row gap-3" id="landlord-notice-form">
                            <div class="applicant-photo-container">
                                <img src="/rentrover/assets/images/shristi.jpg" alt="">
                            </div>

                            <div class="detail">
                                <!-- applicant -->
                                <div class="mb-2 d-flex flex-row gap-2">
                                    <p class="m-0 text-secondary"> Applicant : </p>
                                    <p class="m-0 fw-semibold"> Shristi Pradhan </p>
                                </div>

                                <!-- renting type -->
                                <div class="mb-2 d-flex flex-row gap-2">
                                    <p class="m-0 text-secondary"> Renting type: </p>
                                    <p class="m-0 fw-semibold"> Fixed <code>[0000-00-00 to 0000-00-00]</code> </p>
                                </div>

                                <!-- application date -->
                                <div class="mb-2 d-flex flex-row gap-2">
                                    <p class="m-0 text-secondary"> Applied on : </p>
                                    <p class="m-0 fw-semibold"> 00-00-00 &nbsp; 00:00 </p>
                                </div>

                                <p class="m-0 bio small mb-2"> "Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Natus reprehenderit laborum veritatis, quasi repellendus ad molestiae, quos nobis
                                    odio, deleniti placeat! Quas officiis modi voluptate."</p>
                            </div>
                        </div>

                        <!-- status -->
                        <p class="m-0 mb-3 small fit-content bg-dark text-light px-2 rounded"> Status : Accepted ||
                            Rejected || Pending </p>

                        <!-- action -->
                        <div class="action mt-2">
                            <button type="button" class="btn btn-success" id="accept-application-btn"> <i
                                    class="fa-solid fa-check"></i> Accept
                            </button>
                            <button type="button" class="btn btn-outline-danger" id="reject-application-btn"> <i
                                    class="fa fa-multiply"></i> Reject
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    <!-- popup js -->
    <script src="/rentrover/js/popup-alert.js"></script>

    <!-- script -->
    <script>
        $(document).ready(function () {
            let rentType = "all";
            let status = "all";
            let filterStatus = false;

            countApplication();

            // rent type
            $('#filter-rent-type').change(function () {
                rentType = $('#filter-rent-type').val();
                toggleData();
            });

            // application status
            $('#filter-status').change(function () {
                status = $('#filter-status').val();
                toggleData();
            });

            // clear
            $('#clear').click(function () {
                filterStatus = false;
                $('#filter-rent-type').val("all");
                $('#filter-status').val("all");
                rentType = "all";
                status = "all";
                toggleData();
            });

            // toggle empty data
            function toggleEmptyContent() {
                $('.application-row:visible').length == 0 ? $('#empty-data-foot').show() : $('#empty-data-foot').hide();
            }

            function toggleData() {
                filterStatus = false;
                // rent
                if (rentType == "all") {
                    $('.application-row').show();
                } else {
                    filterStatus = true;
                    $('.application-row').hide();
                    if (rentType == "fixed") {
                        $('.rent-fixed').show();
                    } else {
                        $('.rent-not-fixed').show();
                    }
                }

                // status
                if (status != "all") {
                    filterStatus = true;
                    if (status == "pending") {
                        $('.accepted-row').hide();
                        $('.rejected-row').hide();
                        $('.cancelled-row').hide();
                        $('.expired-row').hide();
                    } else if (status == "accepted") {
                        $('.pending-row').hide();
                        $('.rejected-row').hide();
                        $('.cancelled-row').hide();
                        $('.expired-row').hide();
                    } else if (status == "rejected") {
                        $('.pending-row').hide();
                        $('.accepted-row').hide();
                        $('.cancelled-row').hide();
                        $('.expired-row').hide();
                    } else if (status == "cancelled") {
                        $('.pending-row').hide();
                        $('.accepted-row').hide();
                        $('.rejected-row').hide();
                        $('.expired-row').hide();
                    } else if (status == "expired") {
                        $('.pending-row').hide();
                        $('.accepted-row').hide();
                        $('.rejected-row').hide();
                        $('.cancelled-row').hide();
                    }
                }

                // toggle clear div
                filterStatus ? $('#clear').show() : $('#clear').hide();

                toggleEmptyContent();
            }

            toggleEmptyContent();

            // load application
            function loadRoomApplication() {
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/room-application.php',
                    type: "POST",
                    data: { landlordId: <?= $r_id ?> },
                    success: function (data) {
                        $('#application-table-body').html(data);
                        toggleEmptyContent();
                    }
                });
            }

            loadRoomApplication();
            countApplication();

            // fetch application detail
            $(document).on('click', '.show-application-detail', function () {
                var app_id = $(this).data('app-id');
                $.ajax({
                    url: '/rentrover/pages/landlord/sections/fetch-application-detail.php',
                    type: "POST",
                    data: { applicationId: app_id },
                    success: function (data) {
                        $('#application-detail-modal-body').html(data);
                    }
                });
            });

            // accept application
            $(document).on('click', '#accept-application-btn', function () {
                app_id = $(this).data('id')
                $.ajax({
                    url: '/rentrover/pages/landlord/app/accept-application.php',
                    type: "POST",
                    data: { applicationId: app_id },
                    beforeSend: function () {
                        $('#accept-application-btn').html("Please wait").prop('disabled', true);
                    },
                    success: function (response) {
                        if (response == true) {
                            loadRoomApplication();
                            countApplication();
                            $('#accept-application-btn').html("<i class='fa-solid fa-check'> </i> Accepted").prop('disabled', true);
                            $('#reject-application-btn').fadeOut();
                        } else {
                            $('#error-message').html("Application couln't be accepted.").show();
                            $('#accept-application-btn').html("<i class='fa-solid fa-check'> </i> Accept").prop('disabled', false);
                        }
                    }
                });
            });

            // reject application
            $(document).on('click', '#reject-application-btn', function () {
                app_id = $(this).data('id')
                $.ajax({
                    url: '/rentrover/pages/landlord/app/reject-application.php',
                    type: "POST",
                    data: { applicationId: app_id },
                    beforeSend: function () {
                        $('#reject-application-btn').html("Please wait").prop('disabled', true);
                    },
                    success: function (response) {
                        if (response == true) {
                            loadRoomApplication();
                            countApplication();
                            $('#reject-application-btn').html("<i class='fa-solid fa-multiply'> </i> Rejected");
                            $('#make-tenant-btn').fadeOut();
                            $('#accept-application-btn').fadeOut();
                        } else {
                            $('#error-message').html("Application couln't be accepted.").show();
                            $('#reject-application-btn').html("<i class='fa-solid fa-multiply'> </i> Reject").prop('disabled', false);
                        }
                    }
                });
            });

            // count application
            function countApplication() {
                // total
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-applications.php',
                    success: function (data) {
                        $('#total-application-count').html(data);
                    }
                });

                // pending
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-pending-applications.php',
                    success: function (data) {
                        $('#pending-application-count').html(data);
                    }
                });

                // accepted
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-accepted-applications.php',
                    success: function (data) {
                        $('#accepted-application-count').html(data);
                    }
                });

                // rejected
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-rejected-applications.php',
                    success: function (data) {
                        $('#rejected-application-count').html(data);
                    }
                });

                // expired
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-expired-applications.php',
                    success: function (data) {
                        $('#expired-application-count').html(data);
                    }
                });

                // cancelled
                $.ajax({
                    url: '/rentrover/pages/landlord/app/count-cancelled-applications.php',
                    success: function (data) {
                        $('#cancelled-application-count').html(data);
                    }
                });
            }

            // make tenant btn
            $(document).on('click', '#make-tenant-btn', function () {
                var room_id = $(this).data('room-id');
                var applicant_id = $(this).data('applicant-id');
                $.ajax({
                    url: '/rentrover/pages/landlord/app/make-tenant.php',
                    type: 'POST',
                    data: { roomId: room_id, applicantId: applicant_id },
                    beforeSend: function () { },
                    success: function (response) {
                        console.log(response);
                        if(response == true) {
                            $('#make-tenant-btn').html("<i class='fa fa-check'> </i> Added as Tenant");
                            $('#reject-application-btn').fadeOut();
                        }
                    },
                });
            });
        });
    </script>
</body>

</html>