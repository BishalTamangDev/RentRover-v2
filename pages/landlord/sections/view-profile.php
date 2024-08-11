<?php
require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../functions/district-array.php';

if (!isset($profileUser)) {
    $profileUser = new User();
}
?>

<!-- check if the account is eligible for verification -->
<?php
if ($profileUser->flag != 'verified') {

    if ($profileUser->checkAccountEligibilityForVerification($_SESSION['rentrover-id'])) {
        ?>
        <div class="alert alert-danger" role="alert">

            <p class="m-0">
                <a class="pointer" id="apply-for-verification-trigger"> Click Here </a> to apply for verification.
            </p>
        </div>
        <?php
    }
}
?>

<div class="mb-3 profile-informations">
    <div class="d-flex flex-column flex-md-row row-gap-3">
        <div class="w-50">
            <p class="m-0 text-secondary"> First Name </p>
            <p class="m-0 fw-semibold">
                <?= ($profileUser->name['first'] != '') ? ucfirst($profileUser->name['first']) : "-" ?>
            </p>
        </div>

        <div class="w-50">
            <p class="m-0 text-secondary"> Last Name </p>
            <p class="m-0 fw-semibold">
                <?= ($profileUser->name['last'] != '') ? ucfirst($profileUser->name['last']) : "-" ?>
            </p>
            </p>
        </div>
    </div>

    <div class="mt-3 d-flex flex-column flex-md-row row-gap-3">
        <div class="w-50">
            <p class="m-0 text-secondary"> Gender </p>
            <p class="m-0 fw-semibold"> <?= ($profileUser->gender != '') ? ucfirst($profileUser->gender) : "-" ?> </p>
        </div>

        <div class="w-50">
            <p class="m-0 text-secondary"> DoB </p>
            <p class="m-0 fw-semibold"> <?= ($profileUser->dob != '0000-00-00') ? $profileUser->dob : "-" ?> </p>
        </div>
    </div>

    <div class="mt-3 d-flex flex-column flex-md-row row-gap-3">
        <div class="w-50">
            <p class="m-0 text-secondary"> Email </p>
            <p class="m-0 fw-semibold"> <?= ($profileUser->email != '') ? $profileUser->email : "-" ?> </p>
        </div>

        <div class="w-50">
            <p class="m-0 text-secondary"> Phone Number </p>
            <p class="m-0 fw-semibold">
                <?= ($profileUser->getPhoneNumber() != '') ? $profileUser->getPhoneNumber() : "-" ?>
            </p>
        </div>
    </div>

    <p class="m-0 mt-3 text-secondary"> Address </p>
    <div class="d-flex flex-column">
        <div class="d-flex flex-column flex-md-row row-gap-3">
            <div class="w-50">
                <p class="m-0 mt-2 text-secondary"> Province </p>
                <p class="m-0 fw-semibold">
                    <?= ($profileUser->address['province'] != '') ? ucfirst($profileUser->address['province']) : "-" ?>
                </p>
            </div>
            <div class="w-50">
                <p class="m-0 mt-2 text-secondary"> District </p>
                <p class="m-0 fw-semibold">
                    <?= ($profileUser->address['district'] != '') ? ucfirst($profileUser->address['district']) : "-" ?>
                </p>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row row-gap-3">
            <div class="w-50">
                <p class="m-0 mt-3 text-secondary"> Municipality/ Rupal Municipality </p>
                <p class="m-0 fw-semibold">
                    <?= ($profileUser->address['municipalityRural'] != '') ? ucfirst($profileUser->address['municipalityRural']) : "-" ?>
                </p>
            </div>

            <div class="w-50">
                <p class="m-0 mt-3 text-secondary"> Ward </p>
                <p class="m-0 fw-semibold">
                    <?= ($profileUser->address['ward'] != 0) ? $profileUser->address['ward'] : "-" ?>
                </p>
            </div>
        </div>

        <div class="">
            <p class="m-0 mt-3 text-secondary"> Tole/ Village </p>
            <p class="m-0 fw-semibold">
                <?= ($profileUser->address['toleVillage'] != '') ? ucfirst($profileUser->address['toleVillage']) : "-" ?>
            </p>
        </div>
    </div>

    <!-- documents -->
    <p class="m-0 mt-3 text-secondary"> Documents </p>
    <?php
    if ($profileUser->kyc['front'] == '' || $profileUser->kyc['back'] == '') {
        ?>
        <p class="text-danger m-0 small mt-2"> You haven't submitted the documents. You must submit the picture of your
            citizenship to be able to use our services. </p>
        <?php
    } else {
        ?>
        <section class="d-flex flex-row gap-2 mt-2 document-section">
            <div class="d-flex flex-column gap-1 document-container">
                <p class="m-0 small mb-1"> Front side </p>
                <div class="document">
                    <img src="/rentrover/uploads/kycs/<?= $profileUser->kyc['front'] ?>" alt="citizenship front side">
                </div>
            </div>

            <div class="d-flex flex-column gap-1 document-container">
                <p class="m-0 small mb-1"> Back side </p>
                <div class="document">
                    <img src="/rentrover/uploads/kycs/<?= $profileUser->kyc['back'] ?>" alt="citizenship back side">
                </div>
            </div>
        </section>
        <?php
    }
    ?>
</div>

<!-- change password -->
<div class="action mt-3 d-flex flex-row flex-wrap gap-2">
    <a href="/rentrover/landlord/profile/password-change" class="btn btn-dark fit-content"> Change Password </a>
    <?php
    if ($profileUser->flag != 'on-hold' && $profileUser->flag != 'verified') {
        ?>
        <a href="/rentrover/landlord/profile/kyc" class="btn btn-success"> Upload/&nbsp;Update&nbsp;KYC </a>
        <?php
    }
    ?>
</div>