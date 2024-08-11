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
    private $tenantId;
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
        $this->tenantId = '';
        $this->amenity = [''];
        $this->info = '';
        $this->flag = '';
        $this->registrationDate = '';
    }

    // getter
    public function getTenantId(){
        return $this->tenantId;
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

    // set room
    public function set($roomId, $houseId, $type, $bhk, $numberOfRoom, $number, $furnishing, $floor, $rent, $info, $tenantId, $flag, $registrationDate)
    {
        $this->roomId = $roomId;
        $this->houseId = $houseId;
        $this->type = $type;
        $this->bhk = $bhk;
        $this->numberOfRoom = $numberOfRoom;
        $this->number = $number;
        $this->furnishing = $furnishing;
        $this->floor = $floor;
        $this->rent = $rent;
        $this->info = $info;
        $this->flag = $flag;
        $this->tenantId = $tenantId;
        $this->registrationDate = $registrationDate;
    }

    // fetch specific room by id
    public function fetch($roomId)
    {
        global $conn;
        $roomExists = false;
        $query = "SELECT * FROM room_tb WHERE room_id = '$roomId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows != 0) {
            $dbData = $result->fetch_assoc();
            $roomExists = true;
            $this->set($dbData['room_id'], $dbData['house_id'], $dbData['type'], $dbData['bhk'], $dbData['number_of_room'], $dbData['number'], $dbData['furnishing'], $dbData['floor'], $dbData['rent'], $dbData['info'], $dbData['tenant_id'], $dbData['flag'], $dbData['registration_date']);
        }

        return $roomExists;
    }

    // fetch amenity
    public function fetchAmenity($roomId)
    {
        global $conn;
        $query = "SELECT * FROM amenity_tb WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->amenity[] = $row['amenity'];
                // echo $row['amenity'];
            }
        }
    }

    // fetch photos
    public function fetchPhotos($roomId)
    {
        global $conn;
        $query = "SELECT * FROM room_photo_tb WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) {
                $photo1 = $row['photo'];
                if ($count == 1)
                    $this->photo['first'] = $row['photo'];
                if ($count == 2)
                    $this->photo['second'] = $row['photo'];
                if ($count == 3)
                    $this->photo['third'] = $row['photo'];
                if ($count == 4)
                    $this->photo['fourth'] = $row['photo'];
                $count++;
            }
        }
    }

    // fetch main photo
    public function fetchMainPhoto($roomId)
    {
        global $conn;
        $query = "SELECT photo FROM room_photo_tb WHERE room_id = '$roomId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            $this->photo['first'] = $dbData['photo'];
        }
    }

    // fetch all room
    public function fetchAllRoom()
    {
        global $conn;
        $roomList = [];
        $query = "SELECT * FROM room_tb";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roomList[] = $row;
            }
        }
        return $roomList;
    }

    // fetch all available rooms
    public function fetchAvaibleRooms()
    {
        global $conn;
        $roomList = [];
        $query = "SELECT * FROM room_tb WHERE flag = 'verified'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roomList[] = $row;
            }
        }
        return $roomList;
    }

    // fetch all room of landlord
    public function fetchAllRoomIdByLandlord($houseList)
    {
        global $conn;
        $roomList = [];

        $arrayString = "'" . implode("','", $houseList) . "'";

        $query = "SELECT room_id FROM room_tb WHERE house_id IN ($arrayString)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roomList[] = $row['room_id'];
            }
        }
        return $roomList;
    }

    // fetch all room of landlord
    public function fetchAllRoomByLandlord($houseList)
    {
        global $conn;
        $roomList = [];

        $arrayString = "'" . implode("','", $houseList) . "'";

        $query = "SELECT * FROM room_tb WHERE house_id IN ($arrayString)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roomList[] = $row;
            }
        }
        return $roomList;
    }

    // count all room
    public function countAllRoom()
    {
        global $conn;
        $query = "SELECT room_id FROM room_tb";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    // count landlord's room
    public function countLandlordRoom($houseIdList)
    {
        global $conn;
        $arrayString = "'" . implode("','", $houseIdList) . "'";
        $query = "SELECT room_id FROM room_tb WHERE house_id IN ($arrayString)";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    // count acquired rooms
    public function countAcquiredRoom()
    {
        global $conn;
        $query = "SELECT room_id FROM room_tb WHERE flag = 'acquired'";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    // count landlord's acquired room
    public function countLandlordAcquiredRoom($houseIdList)
    {
        global $conn;
        $arrayString = "'" . implode("','", $houseIdList) . "'";
        $query = "SELECT room_id FROM room_tb WHERE house_id IN ($arrayString) AND tenant_id != '0'";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    // count unacquired rooms
    public function countUnacquiredRoom()
    {
        global $conn;
        $query = "SELECT room_id FROM room_tb WHERE flag != 'acquired'";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    // count landlord's unacquired room
    public function countLandlordUnacquiredRoom($houseIdList)
    {
        global $conn;
        $arrayString = "'" . implode("','", $houseIdList) . "'";
        $query = "SELECT room_id FROM room_tb WHERE house_id IN ($arrayString) AND tenant_id = '0'";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    // count room of the house
    public function countRoomOfThisHouse($houseId)
    {
        global $conn;
        $query = "SELECT room_id FROM room_tb WHERE house_id = '$houseId'";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    // update room
    public function update()
    {
        global $conn;
        $query = "UPDATE room_tb SET house_id = '$this->houseId', type = '$this->type', bhk = '$this->bhk', number_of_room = '$this->numberOfRoom', number = '$this->number', furnishing = '$this->furnishing', floor = '$this->floor', rent = '$this->rent', info = '$this->info' WHERE room_id = '$this->roomId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // update amenity
    public function updateAmenity()
    {
        global $conn;

        // remove old amenity
        $query = "DELETE FROM amenity_tb WHERE room_id = '$this->roomId'";
        $result = mysqli_query($conn, $query);

        // add new amenity
        foreach ($this->amenity as $new) {
            if ($new != '') {
                $query = "INSERT INTO amenity_tb (house_id, room_id, amenity) VALUES ('$this->houseId', '$this->roomId',  '$new')";
                $result = $conn->query($query);
            }
        }
    }

    // update first photo
    public function updatePhoto($roomId, $oldPhoto, $newPhoto)
    {
        global $conn;
        $query = "UPDATE room_photo_tb SET photo = '$newPhoto' WHERE room_id = '$roomId' AND photo = '$oldPhoto'";
        $result = $conn->query($query);
        return $result;
    }

    // delete room
    public function delete($roomId)
    {
        global $conn;
        $query = "DELETE FROM room_tb WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        if ($result) {
            // delete amenity
            $amenityQuery = "DELETE FROM amenity_tb WHERE room_id = '$roomId'";
            $amenityQueryResult = $conn->query($amenityQuery);

            // delete photos
            $photoFetchQuery = "SELECT * FROM room_photo_tb WHERE room_id = '$roomId'";
            $photoFetchQueryResult = $conn->query($photoFetchQuery);

            if ($photoFetchQueryResult->num_rows > 0) {
                while ($row = $photoFetchQueryResult->fetch_assoc()) {
                    $file = $row['photo'];
                    unlink("../../../uploads/rooms/$file");
                }
            }

            $photoQuery = "DELETE FROM room_photo_tb WHERE room_id = '$roomId'";
            $photoQueryResult = $conn->query($photoQuery);
        }
        return $result;
    }

    // fetch room id by house id
    public function fetchRoomIdByHouseId($houseId)
    {
        global $conn;
        $roomIdList = [];
        $query = "SELECT room_id FROM room_tb WHERE house_id = '$houseId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roomIdList[] = $row['room_id'];
            }
        }
        return $roomIdList;
    }

    // fetch room by house id
    public function fetchRoomByHouseId($houseId)
    {
        global $conn;
        $roomList = [];
        $query = "SELECT * FROM room_tb WHERE house_id = '$houseId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roomList[] = $row;
            }
        }
        return $roomList;
    }

    // update room flag
    public function updateFlag($roomId, $flag)
    {
        global $conn;
        $query = "UPDATE room_tb SET flag = '$flag' WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        return $query;
    }

    // fetch tenant's room
    public function fetchTenantRoom($tenantId)
    {
        global $conn;
        $query = "SELECT room_id FROM room_tb WHERE tenant_id = '$tenantId' LIMIT 1";
        $result = $conn->query($query);

        // temporary
        $roomId = 0;

        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            $roomId = $dbData['room_id'];
        }
        return $roomId;
    }

    // make tenant
    public function makeTenant($roomId, $applicantId)
    {
        global $conn;
        $query = "UPDATE room_tb SET tenant_id = '$applicantId' WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // check if tenant
    public function checkIfTenant($userId, $roomId)
    {
        global $conn;
        $query = "SELECT flag FROM room_tb WHERE tenant_id = '$userId' AND room_id = '$roomId' LIMIT 1";
        $result = $conn->query($query);
        return $result->num_rows == 1 ? true : false;
    }
}