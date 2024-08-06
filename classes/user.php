<?php

require_once __DIR__ . '/../app/connection.php';

class User
{
    public $userId;
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
    public $role;

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
        $this->role = "";
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

        $query = "INSERT INTO user_tb (first_name, last_name, gender, dob, email, password, phone_number, province, district, municipality_rural, ward, tole_village, role,  profile_photo, kyc_front, kyc_back, registration_date, flag) 
        VALUES ('$firstName', '$lastName','$this->gender','$this->dob','$this->email','$this->password','$this->phoneNumber','$province','$district','$municipalityRural','$ward','$toleVillage', '$this->role', '$this->profilePhoto','$kycFront','$kycBack', '$this->registrationDate', 'pending')";
        $response = mysqli_query($conn, $query);

        return $response;
    }

    // check email existence
    public function checkEmailExistence($email)
    {
        global $conn;
        $status = false;

        $query = "SELECT email FROM user_tb WHERE email = '$email'";

        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0)
            $status = true;

        return $status;
    }

    // check password
    public function checkPassword($password)
    {
        global $conn;

        $query = "SELECT password FROM user_tb WHERE email = '$this->email' LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            $dbPassword = $dbData['password'];
            return password_verify($password, $dbPassword);
        }

        return false;
    }

    // fetch user id
    public function fetchIdByEmail($email)
    {
        global $conn;
        $userId = 0;
        $query = "SELECT user_id FROM user_tb WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            $userId = $dbData['user_id'];
        }
        return $userId;
    }

    // set user
    public function set($firstName, $lastName, $gender, $dob, $email, $phoneNumber, $province, $district, $municipalityRural, $ward, $toleVillage, $role, $flag, $profilePhoto, $kycFront, $kycBack, $registrationDate)
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
        $this->role = $role;
        $this->flag = $flag;
        $this->profilePhoto = $profilePhoto;
        $this->kyc['front'] = $kycFront;
        $this->kyc['back'] = $kycBack;
        $this->registrationDate = $registrationDate;
    }

    public function setMandatory($firstName, $email, $role, $profilePhoto, $flag)
    {
        $this->name['first'] = $firstName;
        $this->email = $email;
        $this->role = $role;
        $this->profilePhoto = $profilePhoto;
        $this->flag = $flag;
    }


    // fetch user detail :: all for profile purpose
    public function fetch($userId, $howMuch)
    {
        global $conn;

        $query = $howMuch == "all" ? "SELECT * FROM user_tb WHERE user_id = '$userId' LIMIT 1" : "SELECT first_name, role, email, flag, profile_photo FROM user_tb WHERE user_id = '$userId'";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            $dbData = $result->fetch_assoc();
            if ($howMuch == "all") {
                $this->set($dbData['first_name'], $dbData['last_name'], $dbData['gender'], $dbData['dob'], $dbData['email'], $dbData['phone_number'], $dbData['province'], $dbData['district'], $dbData['municipality_rural'], $dbData['ward'], $dbData['tole_village'], $dbData['role'], $dbData['flag'], $dbData['profile_photo'], $dbData['kyc_front'], $dbData['kyc_back'], $dbData['registration_date']);
            } else {
                $this->setMandatory($dbData['first_name'], $dbData['email'], $dbData['role'], $dbData['profile_photo'], $dbData['flag']);
            }
        }
    }

    // update profile details
    public function update($userId)
    {
        global $conn;
        $firstName = $this->name['first'];
        $lastName = $this->name['last'];

        $province = $this->address['province'];
        $district = $this->address['district'];
        $municipalityRural = $this->address['municipalityRural'];
        $toleVillage = $this->address['tole-village'];
        $ward = $this->address['ward'];

        if ($this->profilePhoto != "") {
            $query = "UPDATE user_tb SET first_name = '$firstName', last_name = '$lastName', gender = '$this->gender', dob = '$this->dob', phone_number = '$this->phoneNumber', province = '$province', district = '$district', municipality_rural = '$municipalityRural', tole_village = '$toleVillage', ward = '$ward', profile_photo = '$this->profilePhoto' WHERE user_id = '$userId'";
        } else {
            $query = "UPDATE user_tb SET first_name = '$firstName', last_name = '$lastName', gender = '$this->gender', dob = '$this->dob', phone_number = '$this->phoneNumber', province = '$province', district = '$district', municipality_rural = '$municipalityRural', tole_village = '$toleVillage', ward = '$ward' WHERE user_id = '$userId'";
        }

        $response = mysqli_query($conn, $query);

        return $response ? true : false;
    }

    // update password
    public function updatePassword($password)
    {
        $encNewPassword = password_hash($password, PASSWORD_BCRYPT);
        global $conn;
        $query = "UPDATE user_tb SET password = '$encNewPassword' WHERE email = '$this->email'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    // update kyc
    public function updateKyc()
    {
        global $conn;
        $kycFront = $this->kyc['front'];
        $kycBack = $this->kyc['back'];
        $query = "UPDATE user_tb SET kyc_front = '$kycFront', kyc_back = '$kycBack' WHERE email = '$this->email'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    // check if the account is eligible to apply for verification
    public function checkAccountEligibilityForVerification($userId)
    {
        global $conn;
        $eligible = true;
        $query = "SELECT * FROM user_tb WHERE user_id = '$userId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows == 1) {
            $dbData = $result->fetch_assoc();
            foreach ($dbData as $value) {
                if ($value == '' || $value == 'on-hold')
                    $eligible = false;
            }
        }

        return $eligible;
    }
}