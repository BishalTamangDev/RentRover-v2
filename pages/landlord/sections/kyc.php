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