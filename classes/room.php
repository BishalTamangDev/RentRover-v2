<?php

require_once __DIR__ . '/../app/connection.php';

class Room
{
    public $roomId;
    public $houseId;
    public $type;
    public $bhk;
    public $numberOfRoom;
    public $number;
    public $furnishing;
    public $floor;
    public $rent;
    public $photo = [
        'first' => '',
        'second' => '',
        'third' => '',
        'fourth' => '',
    ];
    public $amenity = [];
    public $info;
    public $flag;
    public $registrationDate;

    // constructor
    public function __construct()
    {
        $this->roomId = '';
        $this->houseId = '';
        $this->type = '';
        $this->bhk = '';
        $this->numberOfRoom = '';
        $this->number = '';
        $this->furnishing = '';
        $this->floor = '';
        $this->rent = '';
        $this->photo = [
            'first' => '',
            'second' => '',
            'third' => '',
            'fourth' => '',
        ];
        $this->amenity = [''];
        $this->info = '';
        $this->flag = '';
        $this->registrationDate = '';
    }

    // register
    public function register()
    {
        global $conn;

        $status = false;

        $photo1 = $this->photo['first'];
        $photo2 = $this->photo['second'];
        $photo3 = $this->photo['third'];
        $photo4 = $this->photo['fourth'];

        $this->flag = "verified";

        date_default_timezone_set('Asia/Kathmandu');
        $this->registrationDate = date('Y-m-d H:i:s');

        $roomQuery = "INSERT INTO room_tb (house_id, type, bhk, number_of_room, number, furnishing, floor, rent, info, flag, registration_date) VALUES ('$this->houseId', '$this->type', '$this->bhk', '$this->numberOfRoom', '$this->number', '$this->furnishing', '$this->floor', '$this->rent', '$this->info', '$this->flag', '$this->registrationDate')";

        $roomQueryResult = $conn->query($roomQuery);

        if ($roomQueryResult) {
            $roomId = $conn->insert_id;
            $status = true;

            // amenity query
            foreach ($this->amenity as $amenity) {
                if ($amenity != '') {
                    $amenityQuery = "INSERT INTO amenity_tb (house_id, room_id, amenity) VALUES ('$this->houseId', '$roomId', '$amenity')";
                    $amenityQueryResult = $conn->query($amenityQuery);
                }
            }

            // photo query

            foreach ($this->photo as $key => $photo) {
                $photoQuery = "INSERT INTO room_photo_tb (room_id, photo) VALUES ('$roomId', '$photo')";
                $photoQueryResult = $conn->query($photoQuery);
            }
        }

        return $status;
    }
}