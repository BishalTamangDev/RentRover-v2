function countAdminNotification() {
    $.ajax({
        url: '/rentrover/pages/admin/app/count-admin-unseen-notification.php',
        success: function (count) {
            $('#notification-count').html(count);
        }
    });
}

countAdminNotification();

setInterval(countAdminNotification, 5000);