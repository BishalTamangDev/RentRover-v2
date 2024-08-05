$('#notification-container').hide();
$('#profile-menu').hide();

// notification
$('#notification-icon').click(function () {
    if ($('#notification-container:visible').length) {
        $('#notification-container').hide();
    } else {
        if ($('#profile-menu:visible').length)
            $('#profile-menu').hide();
        $('#notification-container').show();
    }
});

// profile
$('#profile-image-container').click(function () {
    if ($('#profile-menu:visible').length) {
        $('#profile-menu').hide();
    } else {
        if ($('#notification-container:visible').length)
            $('#notification-container').hide();
        $('#profile-menu').show();
    }
});

$('#notification-close').click(function () {
    $('#notification-container').hide();
});
