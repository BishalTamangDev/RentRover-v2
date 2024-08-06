<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../../classes/user.php';
$profileUser = new User();

$profileUser->fetch($r_id, "all");

if (!isset($tab))
    $tab = isset($_GET['tab']) ? $_GET['tab'] : "view";

$page = "leave-applications";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title> Leave Room Applications </title>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="/rentrover/assets/brands/rentrover-circular-logo.png">

    <!-- bootstrap :: cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap :: local -->
    <link rel="stylesheet" href="/rentrover/bootstrap/bootstrap-css-5.3.3/bootstrap.min.css">

    <!-- css files -->
    <link rel="stylesheet" href="/rentrover/css/style.css">
    <link rel="stylesheet" href="/rentrover/css/aside.css">
</head>

<body>
    <!-- aside -->
    <?php require_once __DIR__ . '/sections/aside.php'; ?>

    <main>
        <p class="m-0 fw-bold fs-3"> Leave Applications </p>
        <!-- leave room application container -->
        <div class="d-flex flex-row flex-wrap leave-room-application-container table-container">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="serial"> S.N. </th>
                        <th scope="col"> Room No. </th>
                        <th scope="col"> Tenant </th>
                        <th scope="col"> Move out Date </th>
                        <th scope="col"> Application Date </th>
                        <th scope="col" class="action"> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <th scope="row" class="serial"> 1 </th>
                        <td> 10256 </td>
                        <td> Rupak Dangi </td>
                        <td> 0000-00-00 </td>
                        <td> 0000-00-00 00:00:00 </td>
                        <td class="action">
                            <p class="text-primary pointer small" data-leave-application-id="" data-bs-toggle="modal"
                                data-bs-target="#leaveApplicationModal"> Show detail </p>
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
        <div class="modal fade" id="leaveApplicationModal" tabindex="-1" aria-labelledby="leaveApplicationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="leaveApplicationModalLabel"> Leave Application </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="d-flex flex-column gap-2 modal-body">
                        <!-- tenant -->
                        <div class="d-flex flex-row gap-2">
                            <p class="m-0"> Tenant : </p>
                            <p class="m-0 fw-semibold"> Rupak Dangi</p>
                        </div>

                        <!-- house -->
                        <div class="d-flex flex-row gap-2 mt-2">
                            <p class="m-0"> House : </p>
                            <p class="m-0 fw-semibold"> Pipalboat, Kathmandu</p>
                        </div>

                        <!-- room number -->
                        <div class="d-flex flex-row gap-2 mt-2">
                            <p class="m-0"> Room : </p>
                            <p class="m-0 fw-semibold"> 142 </p>
                        </div>

                        <!-- note -->
                        <div class="mt-2">
                            <p class="m-0"> Note: </p>
                            <p class="m-0"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut eligendi
                                provident dicta odit accusantium deleniti debitis voluptatibus molestias facilis
                                tempore. Quis deserunt dolor consequuntur nam! </p>
                        </div>

                        <!-- move out date -->
                        <div class="d-flex flex-row gap-2 mt-2">
                            <p class="m-0"> Move out date : </p>
                            <p class="m-0 fw-semibold"> 0000:00:00 </p>
                        </div>

                        <!-- application date -->
                        <div class="d-flex flex-row gap-2 mt-2">
                            <p class="m-0"> Application date </p>
                            <p class="m-0 fw-semibold"> 0000:00:00 00:00:00 </p>
                        </div>

                        <!-- action -->
                        <div class="action mt-2">
                            <button class="btn btn-success" id="leave-application-acknowledge-btn"> <i
                                    class="fa-solid fa-check mr-2"></i> Mark as read </button>
                            <a href="/rentrover/landlord/tenant-detail/1" class="btn btn-outlined-brand"
                                id="show-tenant-detail"> <i class="fa-solid fa-arrow-up-right-from-square"></i> Show
                                Tenant Details </a>
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
</body>

</html>