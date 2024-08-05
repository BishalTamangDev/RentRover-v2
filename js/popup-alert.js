function showPopupAlert(msg){
    $('#popup-alert-container').show();
    $('#popup-message').html(msg);
    setTimeout(() => {
        hidePopupAlert();
    }, 4000);
}

function hidePopupAlert(){
    $('#popup-alert-container').hide();
    $('#popup-message').html("");
}

// showPopupAlert("This is a sample popup message.");