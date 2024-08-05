<div class="d-flex flex-column border rounded user-profile-container profile-content">
    <p class="m-0 fs-4 fw-semibold"> Change Password </p>
    <form method="POST" class="form d-flex flex-column gap-2 mt-4" id="password-form">
        <input type="password" name="old-password" class="form-control" placeholder="old password" id="old-password">
        <input type="password" name="new-password" class="form-control" placeholder="new password" id="new-password">
        <input type="password" name="new-password-confirmation" class="form-control"
            placeholder="new password confirmation" id="new-password-confirmation">
        <div class="d-flex flex-row align-items-center gap-2">
            <i class="fa fa-eye pointer pointer" id="password-toggle"></i>
            <label for="password-toggle" class="pt-1 pointer" id="password-toggle-label"> Show password
            </label>
        </div>
        <button type="submit" class="btn btn-success p-1 px-2 fit-content"> Update Password </button>
    </form>
</div>