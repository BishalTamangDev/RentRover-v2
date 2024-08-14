function countNotification() {
    $.ajax({
        url: '/rentrover/app/count-user-unseen-notification.php',
        success: function (count) {
            $('#notification-count').html(count);
        }
    });
}

countNotification();

setInterval(countNotification, 5000);