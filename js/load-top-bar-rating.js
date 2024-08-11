function loadTopBarRating(room_id) {
    $.ajax({
        type: "POST",
        url: "/rentrover/sections/load-top-bar-rating.php",
        data: { roomId: room_id },
        success: function (response) {
            $('#rating-div').html(response);
        }
    });
}