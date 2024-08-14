$(document).on('click', '.notification-card', function () {
    var notification_id = $(this).data('notification-id');
    $.ajax({
        type: "POST",
        url: "/rentrover/app/click-notification.php",
        data: { notificationId: notification_id },
    });
});