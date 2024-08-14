var notification_count = 0;

function countNotification() {
    $.ajax({
        url: '/rentrover/app/count-user-unseen-notification.php',
        success: function (count) {
            // console.clear();
            console.log("Notification count : " + count);
            $('#notification-count').html(count);
        }
    });
}

countNotification();

setInterval(countNotification, 10000);