<?php

require_once __DIR__ . '/../app/connection.php';

class House
{
    public $houseId;
    private $landlordId;
    public $address = [
        'district' => '',
        'municipalityRural' => '',
        'toleVillage' => '',
        'ward' => '',
        'nearestLandmark' => '',
    ];

    public $coordinate = [
        'longitude' => 0,
        'latitude' => 0
    ];

    public $flag;
    public $info;
    public $registrationDate;

    public $photo;

    public $amenity = [''];

    // constructor
    public function __construct()
    {
        $this->houseId = '';
        $this->landlordId = '';
        $this->address = [
            'district' => '',
            'municipalityRural' => '',
            'toleVillage' => '',
            'ward' => '',
            'nearestLandmark' => '',
        ];

        $this->coordinate = [
            'longitude' => 0,
            'latitude' => 0
        ];

        $this->flag = '';
        $this->registrationDate = '';
        $this->photo = '';
        $this->amenity = [];
    }

    // setter
    public function setLandlordId($id)
    {
        $this->landlordId = $id;
    }

    // getter
    public function getLandlordId()
    {
        return $this->landlordId;
    }

    public function getAddress()
    {
        return ucwords($this->address['toleVillage']) . ', ' . ucwords($this->address['municipalityRural']) . '-' . $this->address['ward'] . ', ' . ucwords($this->address['district']);
    }

    public function formatAddress($district, $municipalityRural, $toleVillage, $ward)
    {
        return ucwords($toleVillage) . ', ' . ucwords($municipalityRural) . '-' . $ward . ', ' . ucwords($district);
    }

    // register house
    public function register()
    {
        $status = false;
        global $conn;

        $district = $this->address['district'];
        $municipalityRural = $this->address['municipalityRural'];
        $toleVillage = $this->address['toleVillage'];
        $ward = $this->address['ward'];
        $nearestLandmark = $this->address['nearestLandmark'];
        $longitude = $this->coordinate['longitude'];
        $latitude = $this->coordinate['latitude'];
        $this->flag = "verified";

        date_default_timezone_set('Asia/Kathmandu');
        $this->registrationDate = date('Y-m-d H:i:s');

        $houseQuery = "INSERT INTO house_tb (landlord_id, district, municipality_rural, tole_village, ward, nearest_landmark, longitude, latitude, info, flag, registration_date) VALUES ('$this->landlordId', '$district', '$municipalityRural', '$toleVillage', '$ward', '$nearestLandmark', '$longitude', '$latitude', '$this->info', '$this->flag', '$this->registrationDate')";

        $houseQueryResult = mysqli_query($conn, $houseQuery);
        if ($houseQueryResult) {
            // instant house id
            $houseId = $conn->insert_id;

            $photoQuery = "INSERT INTO house_photo_tb (house_id, photo) VALUES ('$houseId', '$this->photo')";
            $photoQueryResult = mysqli_query($conn, $photoQuery);

            if ($photoQueryResult) {
                $status = true;
                foreach ($this->amenity as $amenity) {
                    if ($amenity != '') {
                        $amenityQuery = "INSERT INTO amenity_tb (house_id, amenity) VALUES ('$houseId','$amenity')";
                        $amenityQueryResult = mysqli_query($conn, $amenityQuery);
                        if (!$amenityQueryResult) {
                            $status = false;
                        }
                    } else {
                        $status = true;
                    }
                }
            }
        }

        return $status;
    }

    // set house details
    public function set($houseId, $landlordId, $district, $municipalityRural, $toleVillage, $ward, $nearestLandmark, $longitude, $latitude, $info, $flag, $registrationDate)
    {
        $this->houseId = $houseId;
        $this->landlordId = $landlordId;
        $this->address = [
            'district' => $district,
            'municipalityRural' => $municipalityRural,
            'toleVillage' => $toleVillage,
            'ward' => $ward,
            'nearestLandmark' => $nearestLandmark,
        ];
        $this->coordinate = [
            'longitude' => $longitude,
            'latitude' => $latitude,
        ];
        $this->info = $info;
        $this->flag = $flag;
        $this->registrationDate = $registrationDate;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function setAmenity()
    {
    }


    // fetch house detail
    public function fetch($houseId)
    {
        global $conn;
        $houseExists = false;
        $houseQuery = "SELECT * FROM house_tb WHERE house_id = '$houseId' LIMIT 1";
        $houeResult = mysqli_query($conn, $houseQuery);

        if ($houeResult->num_rows > 0) {
            $houseExists = true;
            $dbData = $houeResult->fetch_assoc();
            $this->set($dbData['house_id'], $dbData['landlord_id'], $dbData['district'], $dbData['municipality_rural'], $dbData['tole_village'], $dbData['ward'], $dbData['nearest_landmark'], $dbData['longitude'], $dbData['latitude'], $dbData['info'], $dbData['flag'], $dbData['registration_date']);
        }
        return $houseExists;
    }

    // fetch house photo
    public function fetchPhoto($houseId)
    {
        global $conn;
        $query = "SELECT * FROM house_photo_tb WHERE house_id = '$houseId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = $result->fetch_assoc();
            $this->setPhoto($row['photo']);
        }
    }

    // fetch amenity
    public function fetchAmenity($houseId)
    {
        global $conn;
        $query = "SELECT * FROM amenity_tb WHERE house_id = '$houseId' AND room_id = '0'";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->amenity[] = $row['amenity'];
            }
        }
    }

    // fetch all house :: admin
    public function fetchAllHouse()
    {
        global $conn;
        $houseList = [];
        $query = "SELECT * from house_tb";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                $houseList[] = $row;
        }
        return $houseList;
    }

    // fetch house id by landlord id
    public function fetchHouseIdByLandlordId($landlordId)
    {        
        global $conn;
        $houseIdList = [];
        $query = "SELECT house_id from house_tb WHERE landlord_id = '$landlordId'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                $houseIdList[] = $row['house_id'];
        }
        return $houseIdList;
    }

    // fetch all house for landlord
    public function fetchHouseByLandlordId($landlordId)
    {
        global $conn;
        $houseList = [];
        $query = "SELECT * from house_tb WHERE landlord_id = '$landlordId'";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                $houseList[] = $row;
        }
        return $houseList;
    }

    // count house
    public function countHouse()
    {
        global $conn;
        $query = "SELECT house_id FROM house_tb";
        $result = mysqli_query($conn, $query);
        return $result->num_rows;
    }

    // count landlord's house
    public function countLandlordHouse($landlordId)
    {
        global $conn;
        $query = "SELECT house_id FROM house_tb WHERE landlord_id = '$landlordId'";
        $result = mysqli_query($conn, $query);
        return $result->num_rows;
    }

    // search house
    public function search($content)
    {
        global $conn;
        $searchedHouses = [];
        $query = "SELECT * FROM house_tb WHERE house_id LIKE '%$content%' OR municipality_rural LIKE '%$content%' OR tole_village LIKE '%$content%'";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchedHouses[] = $row;
            }
        }
        return $searchedHouses;
    }

    // update house
    public function update()
    {
        global $conn;

        $district = $this->address['district'];
        $municipalityRural = $this->address['municipalityRural'];
        $toleVillage = $this->address['toleVillage'];
        $ward = $this->address['ward'];
        $nearestLandmark = $this->address['nearestLandmark'];
        $longitude = $this->coordinate['longitude'];
        $latitude = $this->coordinate['latitude'];
        $this->flag = "verified";

        $query = "UPDATE house_tb SET longitude = '$longitude', latitude = '$latitude', district = '$district', municipality_rural = '$municipalityRural', tole_village = '$toleVillage', ward = '$ward', nearest_landmark = '$nearestLandmark', info = '$this->info', flag = '$this->flag' WHERE house_id = '$this->houseId'";

        $result = mysqli_query($conn, $query);

        return $result ? true : false;
    }

    public function updateAmenity($oldAmenity, $newAmenity)
    {
        global $conn;

        // remove old amenity
        $query = "DELETE FROM amenity_tb WHERE room_id = '0' AND house_id = '$this->houseId'";
        $result = mysqli_query($conn, $query);

        // add new amenity
        foreach ($newAmenity as $new) {
            if ($new != '') {
                $query = "INSERT INTO amenity_tb (house_id, amenity, room_id) VALUES ('$this->houseId', '$new', '0')";

                $result = mysqli_query($conn, $query);
            }
        }
    }

    // update photo
    public function updatePhoto($newFileName)
    {
        global $conn;

        $query = "UPDATE house_photo_tb SET photo = '$newFileName' WHERE house_id = '$this->houseId'";
        $result = mysqli_query($conn, $query);

        return $result ? true : false;
    }

    // landlord eligibility test to add rom
    public function checkIfEligibleToAddRoom($landlordId)
    {
        global $conn;
        $query = "SELECT house_id FROM house_tb WHERE landlord_id = '$landlordId' AND flag = 'verified'";
        $result = $conn->query($query);
        return ($result->num_rows > 0) ? true : false;
    }

    // delete house
    public function delete($houseId)
    {
        global $conn;
        $query = "DELETE FROM house_tb WHERE house_id = '$houseId'";
        $result = $conn->query($query);
        if ($result) {
            // delete amenity
            $amenityQuery = "DELETE FROM amenity_tb WHERE house_id = '$houseId'";
            $amenityQueryResult = $conn->query($amenityQuery);

            // delete photos
            $photoFetchQuery = "SELECT * FROM house_photo_tb WHERE house_id = '$houseId'";
            $photoFetchQueryResult = $conn->query($photoFetchQuery);

            if ($photoFetchQueryResult->num_rows > 0) {
                while ($row = $photoFetchQueryResult->fetch_assoc()) {
                    $file = $row['photo'];
                    unlink("../../../uploads/houses/$file");
                }
            }

            $photoQuery = "DELETE FROM house_photo_tb WHERE house_id = '$houseId'";
            $photoQueryResult = $conn->query($photoQuery);
        }
        return $result;
    }
}