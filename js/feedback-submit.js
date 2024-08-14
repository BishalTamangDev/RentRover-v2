$(document).ready(function () {
    $('#feedback-form').submit(function (e) {
        e.preventDefault();

        var form_feedback = $('#feedback-feedback').val();

        if ($.trim(form_feedback) === "") {
            $('#feedback-error-message').html("Please write something first.").fadeIn();
        } else {
            $.ajax({
                url: '/rentrover/app/feedback-submit.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response == true) {
                        $('#feedback-error-message').fadeOut();
                        $('#feedback-form').trigger('reset');
                        $('#feedback-modal-close').click();
                        $(showPopupAlert("Thank you for submitting the feedback."));
                    } else {
                        $('#feedback-error-message').html("Error occured.").fadeIn();
                    }
                }
            });
        }
    });
});