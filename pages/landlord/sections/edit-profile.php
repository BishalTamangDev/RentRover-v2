<!-- profile form -->
<form method="POST" class="d-flex flex-column" id="profile form">
    <div class="d-flex flex-row mb-3 align-items-center justify-content-between">
        <div class="d-flex flex-row align-items-center gap-2">
            <i class="fa fa-edit fs-5 text-secondary"></i>
            <h5 class="m-0"> Edit Profile </h5>
        </div>
        <a href="/rentrover/landlord/profile/view" class="btn btn-danger p-1 px-2"> Cancel </a>
    </div>

    <label for="profile-photo" class="mb-2"> Change profile photo </label>
    <input type="file" name="profile-photo" id="profile-photo" class="form-control mb-3">

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

    <div class="d-flex flex-row gap-2 action">
        <button type="submit" class="mt-4 btn btn-success fit-content" id="update-profile-btn"> Update
            Information </button>
        <a class="mt-4 btn btn-danger fit-content" id="update-profile-btn"> Delete Account </a>
    </div>
</form>