<?php
require_once __DIR__ . '/../../../functions/district-array.php';
require_once __DIR__ . '/../../../classes/user.php';

if (!isset($profileUser)) {
    $profileUser = new User();
}

if (!isset($tab))
    $tab = "view";
?>

<div class="d-flex flex-column border rounded user-profile-container profile-content">
    <p class="m-0 fs-4 fw-semibold"> Profile Information </p>
    <p class="m-0 small"> Manage your Account details </p>

    <!-- top section -->
    <div class="d-flex flex-row gap-3 mt-4 align-items-center photo-username-email">
        <div class="photo">
            <?php
            if ($profileUser->profilePhoto != '') {
                $tempPhotoSrc = "/rentrover/uploads/users/$profileUser->profilePhoto";
                ?>
                <img src="<?= $tempPhotoSrc ?>" id="profile-photo-container" alt="user profile photo" class="pointer">
                <?php
            } else {
                $tempPhotoSrc = "/rentrover/uploads/blank-profile.jpg";
                ?>
                <img src="/rentrover/uploads/blank-profile.jpg" id="profile-photo-container" alt="user profile photo"
                    class="pointer">
                <?php
            }
            ?>
        </div>
        <div class="username-email">
            <p class="m-0 fw-semibold">
                <?= ($profileUser->name['first'] != '') ? ucfirst($profileUser->name['first']) : "New User" ?> |
                <?= ucfirst($profileUser->role) ?>
            </p>
            <p class="m-0 text-secondary small"> <?= $profileUser->email ?> </p>

            <?php
            if ($tab == 'view') {
                ?>
                <a href="/rentrover/tenant/profile/edit" class="mt-3 text-primary small" id="edit-profile-trigger">
                    Edit Information </a>
                <?php
            }
            ?>
        </div>
    </div>

    <hr class="mt-4 text-secondary" />

    <?php
    if ($profileUser->flag != "verified") {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php
            if ($profileUser->flag == "pending") {
                ?>
                <p class="m-0">
                    Your account is not verified yet. Update your details and apply for verification.
                </p>
                <?php
            } elseif ($profileUser->flag == "on-hold") {
                ?>
                <p class="m-0">
                    Your account is being verified. Please wait sometime. You'll get notified soon.
                </p>
            <?php
            }
            ?>

            <!-- check if the account is eligible for verification -->
            <?php
            if ($profileUser->checkAccountEligibilityForVerification($r_id)) {
                ?>
                <p class="m-0">
                    <a class="pointer" id="apply-for-verification-trigger"> Click Here </a> to apply for verification.
                </p>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

    <?php
    if ($tab == "view") {
        ?>
        <div class="mb-3 profile-informations">
            <div class="d-flex flex-column flex-md-row row-gap-3">
                <div class="w-100 w-md-50">
                    <p class="m-0 text-secondary"> First Name </p>
                    <p class="m-0 fw-semibold">
                        <?= ($profileUser->name['first'] != '') ? ucfirst($profileUser->name['first']) : "-" ?>
                    </p>
                </div>

                <div class="w-100 w-md-50">
                    <p class="m-0 text-secondary"> Last Name </p>
                    <p class="m-0 fw-semibold">
                        <?= ($profileUser->name['last'] != '') ? ucfirst($profileUser->name['last']) : "-" ?>
                    </p>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row row-gap-3 mt-3">
                <div class="w-50">
                    <p class="m-0 text-secondary"> Gender </p>
                    <p class="m-0 fw-semibold"> <?= ($profileUser->gender != '') ? ucfirst($profileUser->gender) : "-" ?>
                    </p>
                </div>

                <div class="w-50">
                    <p class="m-0 text-secondary"> DoB </p>
                    <p class="m-0 fw-semibold"> <?= ($profileUser->dob != '0000-00-00') ? $profileUser->dob : "-" ?> </p>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row row-gap-3 mt-3">
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

            <hr>

            <p class="m-0 mt-3 text-secondary"> Address </p>
            <div class="d-flex flex-column">
                <div class="d-flex flex-column flex-md-row row-gap-3 mt-3">
                    <div class="w-100 w-md-50">
                        <p class="m-0 mt-2 text-secondary"> Province </p>
                        <p class="m-0 fw-semibold">
                            <?= ($profileUser->address['province'] != '') ? ucfirst($profileUser->address['province']) : "-" ?>
                        </p>
                    </div>
                    <div class="w-100 w-md-50">
                        <p class="m-0 mt-2 text-secondary"> District </p>
                        <p class="m-0 fw-semibold">
                            <?= ($profileUser->address['district'] != '') ? ucfirst($profileUser->address['district']) : "-" ?>
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row row-gap-3 mt-3">
                    <div class="w-100 w-md-50">
                        <p class="m-0 mt-3 text-secondary"> Municipality/ Rupal Municipality </p>
                        <p class="m-0 fw-semibold">
                            <?= ($profileUser->address['municipalityRural'] != '') ? ucfirst($profileUser->address['municipalityRural']) : "-" ?>
                        </p>
                    </div>

                    <div class="w-100 w-md-50">
                        <p class="m-0 mt-3 text-secondary"> Ward </p>
                        <p class="m-0 fw-semibold">
                            <?= ($profileUser->address['ward'] != 0) ? $profileUser->address['ward'] : "-" ?>
                        </p>
                    </div>
                </div>

                <div class="w-100">
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

            if ($profileUser->flag != 'verified' && $profileUser->flag != 'on-hold') {
                ?>
                <a href="/rentrover/tenant/profile/kyc" class="btn btn-dark mt-3"> Upload/ Change KYC Documents </a>
                <?php
            }
            ?>
        </div>
        <?php
    } elseif ($tab == "edit") {
        ?>
        <!-- profile form -->
        <form method="POST" class="d-flex flex-column profile-form" id="profile-form">
            <div class="d-flex flex-row mb-3 align-items-center justify-content-between">
                <div class="d-flex flex-row align-items-center gap-2">
                    <i class="fa fa-edit fs-5 text-secondary"></i>
                    <h5 class="m-0"> Edit Profile </h5>
                </div>

                <a href="/rentrover/tenant/profile/" class="btn btn-danger p-1 px-2"> Cancel </a>
            </div>

            <!-- error message -->
            <p class="text-danger small error-message mb-3" id="error-message">Error message appeags here... </p>

            <!-- new profile picture -->
            <div class="d-flex flex-row w-100 align-items-center gap-2 mb-3">
                <label for="profile-photo"
                    class="d-flex flex-row gap-2 border align-items-center rounded px-3 py-1 small pointer"> <i
                        class="fa fa-upload"></i> Change profile picture </label>
                <i class="invisible fa fa-trash pointer" id="delete-profile-photo"></i>
                <input type="file" name="profile-photo" id="profile-photo" class="invisible form-control fit-content">
            </div>

            <!-- name -->
            <label for="first-name" class="mb-2"> Name </label>
            <div class="d-flex flex-column flex-md-row gap-2">
                <input type="text" value="<?php if ($profileUser->name['first'] != '')
                    echo $profileUser->name['first']; ?>" name="first-name" class="form-control" id="first-name"
                    placeholder="first name">
                <input type="text" value="<?php if ($profileUser->name['last'] != '')
                    echo $profileUser->name['last']; ?>" name="last-name" class="form-control" id="last-name"
                    placeholder="last name">
            </div>

            <!-- gender -->
            <label for="gender" class="mt-4 mb-2"> Gender </label>
            <select name="gender" class="form-select" id="gender">
                <?php
                $gender = $profileUser->gender;
                if ($gender != '') {
                    ?>
                    <option value="<?= $gender ?>" selected hidden> <?= ucfirst($gender) ?> </option>
                    <?php
                } else {
                    ?>
                    <option value="" selected hidden> Select Gender </option>
                    <?php
                }
                ?>
                <option value="male"> Male </option>
                <option value="female"> Female </option>
                <option value="others"> Others </option>
            </select>

            <!-- dob -->
            <label for="dob" class="mt-4 mb-2"> Date of Birth </label>
            <input type="date" value="<?php if ($profileUser->dob != '0000-00-00')
                echo $profileUser->dob ?>" name="dob" class="form-control" id="dob">

                <!-- address -->
                <!-- province -->
                <label for="province" class="mt-4 mb-2"> Province </label>
                <select name="province" class="form-select" id="province">
                    <?php
            $province = $profileUser->address['province'];

            if ($province != '') {
                ?>
                    <option value="<?= $province ?>" selected hidden> <?= ucwords($province) ?> </option>
                    <?php
            } else {
                ?>
                    <option value="" selected hidden> Select Province </option>
                    <?php
            }
            ?>
                <option value="koshi"> Koshi </option>
                <option value="madhesh"> Madhesh </option>
                <option value="bagmati"> Bagmati </option>
                <option value="gandaki"> Gandaki </option>
                <option value="lumbini"> Lumbini </option>
                <option value="karnali"> Karnali </option>
                <option value="sudurpashchim"> Sudurpashchim </option>
            </select>

            <!-- district -->
            <label for="district" class="mt-4 mb-2"> District </label>
            <select name="district" class="form-select" id="district">
                <?php
                $district = $profileUser->address['district'];
                if ($district != '') {
                    ?>
                    <option value="<?= $district ?>" selected hidden> <?= ucwords($district) ?> </option>
                    <?php
                } else {
                    ?>
                    <option value="" selected hidden> Select District </option>
                    <?php
                }
                ?>

                <?php
                foreach ($districtArray as $districtArr) {
                    ?>
                    <option value="<?= $districtArr ?>"> <?= $districtArr ?> </option>
                    <?php
                }
                ?>
            </select>

            <!-- municipality/ rural municipality -->
            <label for="municipality-rural-municipality" class="mt-4 mb-2"> Municipality/ Rural Municipality
            </label>
            <input type="text" value="<?php if ($profileUser->address['municipalityRural'] != '')
                echo ucwords($profileUser->address['municipalityRural']); ?>" name="municipality-rural"
                class="form-control" id="municipality-rural-municipality" placeholder="municipality/ rural municipality">

            <!-- ward -->
            <label for="ward" class="mt-4 mb-2"> Ward </label>
            <select name="ward" class="form-select" id="ward">
                <?php
                $ward = $profileUser->address['ward'];
                if ($ward != '' && $ward != 0) {
                    ?>
                    <option value="<?= $ward ?>" selected hidden> <?= $ward ?> </option>
                    <?php
                } else {
                    ?>
                    <option value="" selected hidden> Select Ward </option>
                    <?php
                }
                ?>
                <option value="1"> 1 </option>
                <option value="2"> 2 </option>
                <option value="3"> 3 </option>
                <option value="4"> 4 </option>
                <option value="5"> 5 </option>
                <option value="6"> 6 </option>
                <option value="7"> 7 </option>
                <option value="8"> 8 </option>
                <option value="9"> 9 </option>
            </select>

            <!-- tole or village -->
            <label for="tole-village" class="mt-4 mb-2"> Tole/ Village </label>
            <input type="text" value="<?php if ($profileUser->address['toleVillage'] != '')
                echo ucwords($profileUser->address['toleVillage']); ?>" name="tole-village" class="form-control"
                id="tole-village" placeholder="tole/ village">

            <!-- phone number -->
            <label for="phone-number" class="mt-4 mb-2"> Phone number </label>
            <input type="text" value="<?php if ($profileUser->getPhoneNumber() != '')
                echo $profileUser->getPhoneNumber(); ?>" name="phone-number" class="form-control" id="phone-number"
                placeholder="phone number" minlength="10"  maxlength="10" />

            <div class="d-flex flex-row gap-2 action">
                <button type="submit" class="mt-4 btn btn-success fit-content" id="update-profile-btn"> Update
                    Information </button>
                <a class="mt-4 btn btn-danger fit-content" id="delete-account-btn"> Delete Account </a>
            </div>
        </form>
        <?php
    } elseif ($tab == "kyc") {
        ?>
        <!-- kyc -->
        <p class="mt-4 mb-2"> Documents [Citizensip] </p>

        <p class="mb-2 text-danger error-message" id="error-message"> Error message appears here... </p>

        <form method="POST" id="kyc-form" enctype="multipart/form-data">
            <div class="d-flex flex-row flex-wrap gap-2 mt-2 document-div">
                <!-- front document container -->
                <div class="image-input-container">
                    <!-- image container -->
                    <div class="image-container" id="image-container-1">
                        <!-- background-image -->
                        <img src="/rentrover/assets/images/blank.jpg" alt="image-file-1" id="image-file-1">

                        <!-- delete icon -->
                        <div class="delete-div" id="delete-image-1">
                            <i class="fa fa-trash"> </i>
                        </div>

                        <!-- file input -->
                        <input type="file" name="image-input-1" id="image-input-1" required>
                    </div>

                    <label for="image-input-1" class="upload-label small"> <i class="fa-solid fa-upload"></i>
                        Upload
                    </label>
                </div>

                <!-- back document container -->
                <div class="image-input-container">
                    <!-- image container -->
                    <div class="image-container" id="image-container-2">
                        <!-- background-image -->
                        <img src="/rentrover/assets/images/blank.jpg" alt="image-file-2" id="image-file-2">

                        <!-- delete icon -->
                        <div class="delete-div" id="delete-image-2">
                            <i class="fa fa-trash"> </i>
                        </div>

                        <!-- file input -->
                        <input type="file" name="image-input-2" id="image-input-2" required>
                    </div>

                    <label for="image-input-2" class="upload-label small"> <i class="fa-solid fa-upload"></i>
                        Upload
                    </label>
                </div>
            </div>

            <!-- kyc upload button -->
            <button type="submit" class="btn btn-success mt-3" id="kyc-upload-btn"> Upload </button>
        </form>
        <?php
    }
    ?>
</div>