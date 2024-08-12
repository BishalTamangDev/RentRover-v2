<!-- report and issue modal -->
<div class="modal fade" id="feedback-modal" tabindex="-1" aria-labelledby="feedback-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="feedback-modal-label"> What's you thoughts on our service? </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="feedback-modal-close"></button>
            </div>

            <div class="modal-body">
                <p class="text-danger small error-message mb-3" id="feedback-error-message"> Error message appears here...
                </p>
                <form action="" class="form feedback-form" id="feedback-form">
                    <textarea name="feedback-feedback" id="feedback-feedback" class="form-control mb-3"
                        placeholder="write here..." style="min-height:140px;max-height:200px;" required></textarea>
                    <select name="feedback-rating" id="feedback-rating" class="form-select w-100 fit-content mb-3"
                        required>
                        <option value=""> Select rating </option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                        <option value="3"> 3 </option>
                        <option value="4"> 4 </option>
                        <option value="5"> 5 </option>
                    </select>
                    <button class="btn btn-brand" id="feedback-btn"> <i class="fa-regular fa-paper-plane"></i> Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>