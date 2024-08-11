<?php 
require_once __DIR__ . '/../../../classes/user.php';
require_once __DIR__ . '/../../../functions/district-array.php';

if(!isset($profileUser)) {
    $profileUser =  new User();
}
?>

<!-- profile form -->
<form method="POST" action="/rentrover/app/edit-profile.php" class="d-nones d-flex flex-column"
    id="profile-form" enctype="multipart/form-data">
    <div class="d-flex flex-row mb-3 align-items-center justify-content-between">
        <div class="d-flex flex-row align-items-center gap-2">
            <i class="fa fa-edit fs-5 text-secondary"></i>
            <h5 class="m-0"> Edit Profile </h5>
        </div>
        <a href="/rentrover/landlord/profile/view" class="btn btn-danger p-1 px-2"> Cancel </a>
    </div>

    <!-- error message -->
    <p class="text-danger small error-message mb-3" id="error-message"> error message appeags here... </p>

    <!-- profile photo label -->
    <div class="d-flex flex-row gap-3">
        <label for="profile-photo" class="mb-2 pointer"> <i class="fa-solid fa-upload m-2"></i> Change profile
            photo </label>

        <div class="d-flex flex-row file">
            <input type="file" name="profile-photo" id="profile-photo" class="form-control p-0 m-0" accept="image/*"
                style="height:0; width: 0;">
            <i class="invisible fa fa-trash pointer pt-2 text-secondary" id="delete-profile-photo"></i>
        </div>
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

    <label for="dob" class="mt-4 mb-2"> Date of Birth </label>
    <input type="date" value="<?php if ($profileUser->dob != '0000-00-00') echo $profileUser->dob ?>" name="dob" class="form-control" id="dob">

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
        echo ucwords($profileUser->address['municipalityRural']); ?>" name="municipality-rural" class="form-control"
        id="municipality-rural-municipality" placeholder="municipality/ rural municipality">

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
        placeholder="phone number" minlength="10" maxlength="10" />

    <div class="d-flex flex-row gap-2 action">
        <button type="submit" class="mt-4 btn btn-success fit-content" id="update-profile-btn"> Update
            Information </button>
        <!-- <a class="mt-4 btn btn-danger fit-content" id="delete-account-btn"> Delete Account </a> -->
    </div>
</form>