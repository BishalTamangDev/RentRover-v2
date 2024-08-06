<!-- password & security -->
<div class="d-flex flex-column user-profile-container">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <p class="m-0 fs-4 fw-semibold"> Change Password </p>
        <a href="/rentrover/landlord/profile/" class="btn btn-danger"> Cancel </a>
    </div>

    <!-- password change form -->
    <form method="POST" action="/rentrover/pages/admin/app/change-password.php"
        class="form d-flex flex-column gap-2 mt-4" id="password-form">
        <!-- error message -->
        <p class="text-danger small error-message" id="error-message"> Error message appeags here... </p>

        <!-- csrf token -->
        <input type="hidden" name="password-csrf-token" class="form-control mt-3" id="password-csrf-token">

        <!-- old password -->
        <input type="password" name="old-password" class="form-control" placeholder="old password" minlength="8"
            id="old-password" required>

        <!-- new password -->
        <input type="password" name="new-password" class="form-control" placeholder="new password" minlength="8"
            id="new-password" required>

        <!-- new password for confirmation -->
        <input type="password" name="new-password-confirmation" class="form-control"
            placeholder="new password confirmation" minlength="8" id="new-password-confirmation" required>
        <div class="d-flex flex-row align-items-center gap-2">
            <i class="fa fa-eye pointer pointer" id="password-toggle"></i>
            <label for="password-toggle" class="pt-1 pointer" id="password-toggle-label"> Show password
            </label>
        </div>
        
        <!-- update password button -->
        <button type="submit" class="btn btn-success p-1 px-2 mt-2 fit-content" id="update-password-btn"> Update
            Password </button>
    </form>
</div>