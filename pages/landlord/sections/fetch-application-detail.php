<?php
$applicationId = $_POST['applicationId'] ?? 0;

if ($applicationId == 0) {
    echo "error occure";
    exit;
}

require_once __DIR__ . '/../../../classes/application.php';
require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../classes/room.php';

$tempUser = new User();
$tempRoom = new Room();
$tempApplication = new Application();

$tempApplication->fetch($applicationId);

// fetch user detail
$tempUser->fetch($tempApplication->getApplicantId(), "all");
?>

<!-- erro message -->
<p class="text-danger small mb-2 error-message" id="error-message"> Message appears here... </p>

<div class="form d-flex flex-column flex-md-row gap-3" id="landlord-notice-form">
    <div class="applicant-photo-container">
        <img src="/rentrover/uploads/users/<?= $tempUser->profilePhoto ?>" alt="">
    </div>

    <div class="detail">
        <!-- applicant -->
        <div class="mb-2 d-flex flex-row gap-2">
            <p class="m-0 text-secondary"> Applicant : </p>
            <p class="m-0 fw-semibold"> <?= $tempUser->getFullName() ?> </p>
        </div>

        <!-- phone number -->
        <?php
        if ($tempApplication->flag == 'pending' || $tempApplication->flag == 'accepted') {
            ?>
            <div class="mb-2 d-flex flex-row gap-2" id="applicant-phone-number-div">
                <p class="m-0 text-secondary"> Phone number : </p>
                <p class="m-0 fw-semibold"> <?= $tempUser->getPhoneNumber() ?> </p>
            </div>
            <?php
        }
        ?>


        <!-- address -->
        <div class="mb-2 d-flex flex-row gap-2" id="applicant-phone-number-div">
            <p class="m-0 text-secondary"> Address : </p>
            <p class="m-0 fw-semibold"> <?= $tempUser->getAddress() ?> </p>
        </div>

        <!-- renting type -->
        <div class="mb-2 d-flex flex-row gap-2">
            <p class="m-0 text-secondary"> Renting type: </p>
            <p class="m-0 fw-semibold">
                <?= ucfirst($tempApplication->rentingType) ?>
                <code>
                    <?php
                    if ($tempApplication->rentingType == 'fixed') {
                        ?>
                                                    [Move In Date : <?= $tempApplication->date['moveIn'] ?> to Move out Date : <?= $tempApplication->date['moveOut'] ?>]
                                                    <?php
                    } else {
                        ?>
                                                    [Move In Date : <?= $tempApplication->date['moveIn'] ?>]
                                                    <?php
                    }
                    ?>
                </code>
            </p>
        </div>

        <!-- application date -->
        <div class="mb-2 d-flex flex-row gap-2">
            <p class="m-0 text-secondary"> Applied on : </p>
            <p class="m-0 fw-semibold"> <?= $tempApplication->applicationDate ?> </p>
        </div>

        <!-- note -->
        <p class="m-0 bio mb-2"> "Note: <?= ucfirst($tempApplication->note) ?>"</p>
    </div>
</div>

<!-- status -->
<p class="m-0 mb-3 mt-3 small fit-content bg-dark text-light px-2 rounded">
    <?= "Status: " . ucfirst($tempApplication->flag) ?>
</p>

<!-- action -->
<?php
if ($tempApplication->flag == 'pending') {
    ?>
    <div class="action mt-2">
        <button type="button" class="btn btn-success" id="accept-application-btn" data-id="<?= $applicationId ?>"> <i
                class="fa-solid fa-check"></i> Accept
        </button>
        <button type="button" class="btn btn-outline-danger" id="reject-application-btn" data-id="<?= $applicationId ?>"> <i
                class="fa fa-multiply"></i> Reject
        </button>
    </div>
    <?php
} elseif ($tempApplication->flag == 'accepted') {
    ?>
    <div class="action mt-2 d-flex flex-row flex-wrap row-gap-2 column-gap-2">
        <!-- check if already added as a tenant -->
        <?php
        $isTenant = $tempRoom->checkIfTenant($tempApplication->roomId, $tempApplication->getApplicantId());
        if ($isTenant) {

            ?>
            <button type="button" class="btn btn-success"> <i class="fa fa-check"></i> Accepted as Tenant </button>
            <?php
        } else {
            ?>
            <button type="button" class="btn btn-success" id="make-tenant-btn" data-room-id="<?= $tempApplication->roomId ?>"
                data-applicant-id="<?= $tempApplication->getApplicantId() ?>"> Make Tenant </button>
            <button type="button" class="btn btn-outline-danger" id="reject-application-btn" data-id="<?= $applicationId ?>"> <i
                    class="fa fa-multiply"></i> Cancel Application </button>
            <?php
        }
        ?>
    </div>
    <?php
}
?>