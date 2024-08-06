<?php

require_once __DIR__ . '/../app/connection.php';

class Admin
{
    public $adminId;
    public $name = [
        'first' => '',
        'last' => ''
    ];
    public $gender;
    public $dob;
    public $email;
    private $password;
    private $phoneNumber;

    public $address = [
        'province' => '',
        'district' => '',
        'municipalityRural' => '',
        'ward' => '',
        'toleVillage' => '',
    ];

    public $profilePhoto;
    public $kyc = [
        'front' => '',
        'back' => '',
    ];
    public $registrationDate;
    public $flag;

    // constructor
    public function __construct()
    {
        $this->name = [
            'first' => '',
            'last' => ''
        ];

        $this->gender = "";
        $this->dob = "";
        $this->email = "";
        $this->password = "";
        $this->phoneNumber = "";
        $this->address = [
            'province' => '',
            'district' => '',
            'municipalityRural' => '',
            'ward' => '',
            'toleVillage' => '',
        ];
        $this->flag = "";
        $this->profilePhoto = "";
        $this->registrationDate = '';
    }

    // setters
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // getters
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // register
    public function register()
    {
        global $conn;

        $firstName = $this->name['first'];
        $lastName = $this->name['first'];

        $province = $this->address['province'];
        $district = $this->address['district'];
        $municipalityRural = $this->address['municipalityRural'];
        $ward = $this->address['ward'];
        $toleVillage = $this->address['toleVillage'];

        $kycFront = $this->kyc['front'];
        $kycBack = $this->kyc['back'];

        date_default_timezone_set('Asia/Kathmandu');
        $this->registrationDate = date('Y-m-d H:i:s');

        $query = "INSERT INTO admin_tb (first_name, last_name, gender, dob, email, password, phone_number, province, district, municipality_rural, ward, tole_village, profile_photo, kyc_front, kyc_back, registration_date, flag) 
        VALUES ('$firstName', '$lastName','$this->gender','$this->dob','$this->email','$this->password','$this->phoneNumber','$province','$district','$municipalityRural','$ward','$toleVillage', '$this->profilePhoto','$kycFront','$kycBack', '$this->registrationDate', 'verified')";
        $response = mysqli_query($conn, $query);

        return $response;
    }

    // check email existence
    public function checkEmailExistence($email)
    {
        global $conn;
        $status = false;

        $query = "SELECT * FROM admin_tb WHERE email = '$email'";

        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0)
            $status = true;

        return $status;
    }

    // check password
    public function checkPassword($password)
    {
        global $conn;

        $query = "SELECT password FROM admin_tb WHERE email = '$this->email' LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            $dbPassword = $dbData['password'];
            return password_verify($password, $dbPassword);
        }

        return false;
    }

    // fetch admin id
    public function fetchIdByEmail($email)
    {
        global $conn;
        $adminId = 0;
        $query = "SELECT admin_id FROM admin_tb WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            $adminId = $dbData['admin_id'];
        }
        return $adminId;
    }

    // set admin
    public function set($firstName, $lastName, $gender, $dob, $email, $phoneNumber, $province, $district, $municipalityRural, $ward, $toleVillage, $flag, $profilePhoto, $registrationDate)
    {
        $this->name = [
            'first' => $firstName,
            'last' => $lastName
        ];
        $this->gender = $gender;
        $this->dob = $dob;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->address = [
            'province' => $province,
            'district' => $district,
            'municipalityRural' => $municipalityRural,
            'ward' => $ward,
            'toleVillage' => $toleVillage,
        ];
        $this->flag = $flag;
        $this->profilePhoto = $profilePhoto;
        $this->registrationDate = $registrationDate;
    }

    public function setMandatory($firstName, $email, $profilePhoto, $flag)
    {
        $this->name['first'] = $firstName;
        $this->email = $email;
        $this->profilePhoto = $profilePhoto;
        $this->flag = $flag;
    }


    // fetch admin detail :: all for profile purpose
    public function fetch($adminId, $howMuch)
    {
        global $conn;

        $query = $howMuch == "all" ? "SELECT * FROM admin_tb WHERE admin_id = '$adminId' LIMIT 1" : "SELECT first_name, email, flag, profile_photo FROM admin_tb WHERE admin_id = '$adminId'";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            if ($howMuch == "all") {
                $this->set($dbData['first_name'], $dbData['last_name'], $dbData['gender'], $dbData['dob'], $dbData['email'], $dbData['phone_number'], $dbData['province'], $dbData['district'], $dbData['municipality_rural'], $dbData['ward'], $dbData['tole_village'], $dbData['flag'], $dbData['profile_photo'], $dbData['registration_date']);
            } else {
                $this->setMandatory($dbData['first_name'], $dbData['email'], $dbData['profile_photo'], $dbData['flag']);
            }
        }
    }

    // update profile details
    public function update($adminId)
    {
        global $conn;
        $firstName = $this->name['first'];
        $lastName = $this->name['last'];

        $province = $this->address['province'];
        $district = $this->address['district'];
        $municipalityRural = $this->address['municipalityRural'];
        $toleVillage = $this->address['tole-village'];
        $ward = $this->address['ward'];

        if($this->profilePhoto != ""){
            $query = "UPDATE admin_tb SET first_name = '$firstName', last_name = '$lastName', gender = '$this->gender', dob = '$this->dob', phone_number = '$this->phoneNumber', province = '$province', district = '$district', municipality_rural = '$municipalityRural', tole_village = '$toleVillage', ward = '$ward', profile_photo = '$this->profilePhoto' WHERE admin_id = '$adminId'";
        } else {
            $query = "UPDATE admin_tb SET first_name = '$firstName', last_name = '$lastName', gender = '$this->gender', dob = '$this->dob', phone_number = '$this->phoneNumber', province = '$province', district = '$district', municipality_rural = '$municipalityRural', tole_village = '$toleVillage', ward = '$ward' WHERE admin_id = '$adminId'";
        }

        $response = mysqli_query($conn, $query);

        return $response ? true : false;
    }

    public function updatePassword($password) {
        $encNewPassword = password_hash($password, PASSWORD_BCRYPT);
        global $conn;
        $query = "UPDATE admin_tb SET password = '$encNewPassword' WHERE email = '$this->email'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
}