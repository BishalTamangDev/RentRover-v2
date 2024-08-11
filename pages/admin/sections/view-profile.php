<?php
require_once __DIR__ . '/../../../classes/user.php';
if (!isset($profileUser)) {
    $profileUser = new User();
}
?>

<div class="mb-3 w-100 profile-informations">
    <div class="d-flex">
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
        </div>
    </div>

    <div class="mt-3 d-flex">
        <div class="w-50">
            <p class="m-0 text-secondary"> Gender </p>
            <p class="m-0 fw-semibold"> <?= ($profileUser->gender != '') ? ucfirst($profileUser->gender) : "-" ?> </p>
        </div>

        <div class="w-50">
            <p class="m-0 text-secondary"> DoB </p>
            <p class="m-0 fw-semibold"> <?= ($profileUser->dob != '0000-00-00') ? $profileUser->dob : "-" ?> </p>
        </div>
    </div>

    <div class="mt-3 d-flex">
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
        <div class="d-flex">
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

        <div class="d-flex">
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

        <div class="mt-3">
            <p class="m-0 mt-3 text-secondary"> Tole/ Village </p>
            <p class="m-0 fw-semibold">
                <?= ($profileUser->address['toleVillage'] != '') ? ucfirst($profileUser->address['toleVillage']) : "-" ?>
            </p>
        </div>
    </div>

    <!-- password -->
    <a href="/rentrover/admin/profile/password-change" class="btn btn-dark mt-3"> Change Password </a>
</div>