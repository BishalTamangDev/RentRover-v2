<?php
$leaveApplicationId = $_POST['applicationId'] ?? 0;

if ($leaveApplicationId == 0)
    exit;

require_once __DIR__ . '/../../../classes/leave-application.php';
require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/house.php';
require_once __DIR__ . '/../../../classes/room.php';

$tempLeave = new Leave();

$exists = $tempLeave->fetch($leaveApplicationId);

if (!$exists) {
    echo false;
    exit;
} else {
    $tempUser = new User();
    $tempRoom = new Room();
    $tempHouse = new House();

    $tempRoom->fetch($tempLeave->roomId);

    $tempHouse->fetch($tempRoom->houseId);
    $location = $tempHouse->getAddress();

    $tenantId = $tempLeave->getTenantId();

    $tempUser->fetch($tenantId, "mandatory");
    $name = $tempUser->getFullName();
    ?>
    <form class="d-flex flex-column gap-2 modal-body" id="leave-application-form">
        <!-- tenant -->
        <div class="d-flex flex-row gap-2">
            <p class="m-0"> Tenant : </p>
            <p class="m-0 fw-semibold"> <?=$name?> </p>
        </div>

        <!-- house -->
        <div class="d-flex flex-row gap-2 mt-2">
            <p class="m-0"> House : </p>
            <p class="m-0 fw-semibold"> <?=$location?> </p>
        </div>

        <!-- room number -->
        <div class="d-flex flex-row gap-2 mt-2">
            <p class="m-0"> Room : </p>
            <p class="m-0 fw-semibold"> <?=$tempRoom->number?> </p>
        </div>

        <!-- note -->
        <div class="mt-2">
            <p class="m-0"> Note: </p>
            <p class="m-0"> <?=ucfirst($tempLeave->note)?> </p>
        </div>

        <!-- move out date -->
        <div class="d-flex flex-row gap-2 mt-2">
            <p class="m-0"> Move out date : </p>
            <p class="m-0 fw-semibold"> <?=$tempLeave->moveOutDate?> </p>
        </div>

        <!-- application date -->
        <div class="d-flex flex-row gap-2 mt-2">
            <p class="m-0"> Application date </p>
            <p class="m-0 fw-semibold"> <?=$tempLeave->submittedDate?> </p>
        </div>

        <!-- action -->
        <div class="action mt-2">
            <button class="btn btn-success" id="leave-application-acknowledge-btn"> <i class="fa-solid fa-check mr-2"></i>
                Mark as read </button>
            <a href="/rentrover/landlord/tenant-detail/1" class="btn btn-outlined-brand" id="show-tenant-detail"> <i
                    class="fa-solid fa-arrow-up-right-from-square"></i> Show
                Tenant Details </a>
        </div>
    </form>
    <?php
}