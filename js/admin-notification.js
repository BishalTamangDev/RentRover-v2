var notification_count = 0;

function loadNotification() {
    notification_count++;
    console.clear();
    console.log(notification_count);
    showPopupAlert("Hello : " + notification_count);
}

setInterval(loadNotification, 5000);