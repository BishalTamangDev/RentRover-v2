<?php
if (!isset($tab))
    $tab = "view";
?>

<div class="d-flex flex-column border rounded user-profile-container profile-content">
    <p class="m-0 fs-4 fw-semibold"> Profile Information </p>
    <p class="m-0 small"> Manage your Account details </p>

    <!-- top section -->
    <div class="d-flex flex-row gap-3 mt-4 align-items-center photo-username-email">
        <div class="photo">
            <img src="/rentrover/assets/images/bishal.jpg" alt="" id="existing-profile-picture">
        </div>
        <div class="username-email">
            <p class="m-0 fw-semibold"> Mr. Beast | Landlord</p>
            <p class="m-0 text-secondary small"> someone@gmail.com </p>
            <a href="/rentrover/tenant/profile/edit" class="mt-3 text-primary small"> Edit Information
            </a>
        </div>
    </div>

    <hr class="mt-4 text-secondary" />

    <?php
    if ($tab == "view") {
        ?>
        <div class="mb-3 profile-informations">
            <div class="d-flex">
                <div class="w-50">
                    <p class="m-0 text-secondary"> First Name </p>
                    <p class="m-0 fw-semibold"> Bishal </p>
                </div>

                <div class="w-50">
                    <p class="m-0 text-secondary"> Last Name </p>
                    <p class="m-0 fw-semibold"> Tamang </p>
                </div>
            </div>

            <div class="mt-3 d-flex">
                <div class="w-50">
                    <p class="m-0 text-secondary"> Gender </p>
                    <p class="m-0 fw-semibold"> Male </p>
                </div>

                <div class="w-50">
                    <p class="m-0 text-secondary"> DoB </p>
                    <p class="m-0 fw-semibold"> 2000-06-06 </p>
                </div>
            </div>

            <div class="mt-3 d-flex">
                <div class="w-50">
                    <p class="m-0 text-secondary"> Email </p>
                    <p class="m-0 fw-semibold"> bishaltamang117@gmail.com </p>
                </div>

                <div class="w-50">
                    <p class="m-0 text-secondary"> Phone Number </p>
                    <p class="m-0 fw-semibold"> 9823645014 </p>
                </div>
            </div>

            <p class="m-0 mt-3 text-secondary"> Address </p>
            <div class="d-flex flex-column">
                <div class="d-flex">
                    <div class="w-50">
                        <p class="m-0 mt-2 text-secondary"> Province </p>
                        <p class="m-0 fw-semibold"> Bagmati </p>
                    </div>
                    <div class="w-50">
                        <p class="m-0 mt-2 text-secondary"> District </p>
                        <p class="m-0 fw-semibold"> Sindhupalchowk </p>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="w-50">
                        <p class="m-0 mt-3 text-secondary"> Municipality/ Rupal Municipality </p>
                        <p class="m-0 fw-semibold"> Melamchi </p>
                    </div>

                    <div class="w-50">
                        <p class="m-0 mt-3 text-secondary"> Ward </p>
                        <p class="m-0 fw-semibold"> 3 </p>
                    </div>
                </div>

                <div class="">
                    <p class="m-0 mt-3 text-secondary"> Tole/ Village </p>
                    <p class="m-0 fw-semibold"> Bobrang </p>
                </div>
            </div>

            <!-- documents -->
            <p class="m-0 mt-3 text-secondary"> Documents </p>
            <p class="text-danger m-0 small mt-2"> You haven't submitted the documents. You must submit the
                picture of your citizenship to be able to use our services. </p>
            <section class="d-flex flex-row gap-2 mt-2 document-section">
                <div class="d-flex flex-column gap-1 document-container">
                    <p class="m-0 small mb-1"> Front side </p>
                    <div class="document">
                        <img src="/rentrover/assets/images/blank.jpg" alt="citizenship front side">
                    </div>
                </div>

                <div class="d-flex flex-column gap-1 document-container">
                    <p class="m-0 small mb-1"> Back side </p>
                    <div class="document">
                        <img src="/rentrover/assets/images/blank.jpg" alt="citizenship back side">
                    </div>
                </div>
            </section>
        </div>

        <?php
    } else {
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

            <!-- new profile picture -->
            <div class="d-flex flex-row w-100 align-items-center gap-2 mb-3">
                <label for="profile-photo"
                    class="d-flex flex-row gap-2 border align-items-center rounded px-3 py-1 small pointer"> <i
                        class="fa fa-upload"></i> Change profile picture </label>
                <i class="fa fa-trash pointer" id="delete-new-profile-photo"></i>
                <input type="file" name="profile-photo" id="profile-photo" class="invisible form-control fit-content">
            </div>

            <label for="first-name" class="mb-2"> Name </label>
            <div class="d-flex gap-2">
                <input type="text" name="first-name" class="form-control" id="first-name" placeholder="first name">
                <input type="text" name="last-name" class="form-control" id="last-name" placeholder="last name">
            </div>

            <label for="gender" class="mt-4 mb-2"> Gender </label>
            <select name="gender" class="form-select" id="gender">
                <option value="" selected hidden> Select Gender </option>
                <option value="male"> Male </option>
                <option value="female"> Female </option>
                <option value="others"> Others </option>
            </select>

            <label for="dob" class="mt-4 mb-2"> Date of Birth </label>
            <input type="date" name="dob" class="form-control" id="dob">

            <!-- address -->
            <!-- province -->
            <label for="province" class="mt-4 mb-2"> Province </label>
            <select name="district" class="form-select" id="province">
                <option value="" selected hidden> Select Province </option>
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
                <option selected hidden> Select District </option>
                <option value="kathmandu"> Kathmandu </option>
                <option value="kathmandu"> Bhaktapur </option>
                <option value="kathmandu"> Lalitpur </option>
            </select>

            <!-- municipality/ rural municipality -->
            <label for="municipality-rural-municipality" class="mt-4 mb-2"> Municipality/ Rural Municipality
            </label>
            <input type="text" name="municipality" class="form-control" id="municipality-rural-municipality"
                placeholder="municipality/ rural municipality">

            <!-- ward -->
            <label for="ward" class="mt-4 mb-2"> Ward </label>
            <select name="ward" class="form-select" id="ward">
                <option selected hidden> Select Ward </option>
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
            <input type="text" name="tole" class="form-control" id="tole-village" placeholder="tole/ village">

            <!-- phone number -->
            <label for="phone-number" class="mt-4 mb-2"> Phone number </label>
            <input type="text" name="contact" class="form-control" id="phone-number" placeholder="phone number"
                minlength="10" />

            <label for="phone-number" class="mt-4 mb-2"> Documents [Citizensip] </label>
            <div class="d-flex flex-row gap-2 mt-2 document-div">
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

            <div class="d-flex flex-row gap-2 action">
                <button type="submit" class="mt-4 btn btn-success fit-content" id="update-profile-btn"> Update
                    Information </button>
                <a class="mt-4 btn btn-danger fit-content" id="update-profile-btn"> Delete Account </a>
            </div>
        </form>
        <?php
    }
    ?>
</div>