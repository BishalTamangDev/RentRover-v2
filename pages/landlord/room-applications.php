<?php
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
                <p class="data"> 120 </p>
            </div>

            <!-- current tenants -->
            <div class="card-v2">
                <p class="title"> Accepted </p>
                <p class="data"> 50 </p>
            </div>

            <!-- ex-tenants -->
            <div class="card-v2">
                <p class="title"> Rejected </p>
                <p class="data"> 70 </p>
            </div>
        </section>

        <!-- filter -->
        <section class="filter-container">
            <!-- house -->
            <div class="parameter">
                <label for="filter-house-id"> House </label>
                <select name="filter-house-id" class="form-select-sm" id="filter-house-id">
                    <option value="all"> All </option>
                    <option value="house-id-1"> Pipalboat, Kathmandu </option>
                    <option value="house-id-2"> Balkot, Bhaktapur </option>
                    <option value="house-id-2"> Imadol, Lalitpur </option>
                </select>
            </div>

            <!-- room -->
            <div class="parameter">
                <label for="filter-room-id"> Room </label>
                <select name="filter-room-id" class="form-select-sm" id="filter-room-id">
                    <option value="all"> All </option>
                    <option value="room-id-1"> Room no 1 </option>
                    <option value="room-id-1"> Room no 2 </option>
                    <option value="room-id-1"> Room no 3 </option>
                </select>
            </div>

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
                        <th scope="col"> Room </th>
                        <th scope="col"> Applicant </th>
                        <th scope="col"> Rent Type </th>
                        <th scope="col"> Move In Date </th>
                        <th scope="col"> Move Out Date </th>
                        <th scope="col"> Status </th>
                        <th scope="col"> Applied Date </th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="application-row rent-not-fixed pending-row">
                        <th scope="row" class="serial"> 1 </th>
                        <td> Phungling, Pathivara, 3 </td>
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

                    <tr class="application-row rent-not-fixed accepted-row">
                        <th scope="row" class="serial"> 2 </th>
                        <td> Sindhupalchowk </td>
                        <td> Bishal Tamang </td>
                        <td> Not-Fixed </td>
                        <td> 00-00-00 </td>
                        <td> - </td>
                        <td> Accepted </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <p class="small text-primary pointer" data-bs-toggle="modal"
                                data-bs-target="#applicationModal">
                                Show details
                            </p>
                        </td>
                    </tr>

                    <tr class="application-row rent-fixed rejected-row">
                        <th scope="row" class="serial"> 3. </th>
                        <td> Bhojpur </td>
                        <td> Shristi Pradhan </td>
                        <td> Not-Fixed </td>
                        <td> 00-00-00 </td>
                        <td> 00-00-00 </td>
                        <td> Rejected </td>
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
                        <td colspan="8"> No data found! </td>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                            <button type="button" class="btn btn-success"> <i class="fa-solid fa-check"></i> Accept
                            </button>
                            <button type="button" class="btn btn-outline-danger"> <i class="fa fa-multiply"></i> Reject
                            </button>
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
            let rentType = "all";
            let status = "all";
            let filterStatus = false;

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
                $('#filter-staus').val("all");
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
                    } else if (status == "accepted") {
                        $('.pending-row').hide();
                        $('.rejected-row').hide();

                    } else if (status == "rejected") {
                        $('.pending-row').hide();
                        $('.accepted-row').hide();
                    }
                }

                // toggle clear div
                filterStatus ? $('#clear').show() : $('#clear').hide();

                toggleEmptyContent();
            }

            toggleEmptyContent();
        });
    </script>
</body>

</html>