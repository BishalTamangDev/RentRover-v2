<?php
require_once __DIR__ . '/../app/connection.php';

class Application
{
    public $applicationId;
    private $applicantId;
    public $roomId;
    public $rentingType;
    public $date = [
        'moveIn' => '',
        'moveOut' => '',
    ];
    public $note;
    public $flag;
    public $applicationDate;

    // constructor
    public function __construct()
    {
        $this->applicantId = '';
        $this->roomId = '';
        $this->rentingType = '';
        $this->date = [
            'moveIn' => '',
            'moveOut' => '',
        ];
        $this->note = '';
        $this->flag = '';
        $this->applicationDate = '';
    }

    // setter
    public function setApplicantId($id)
    {
        $this->applicantId = $id;
    }

    // getter
    public function getApplicantId()
    {
        return $this->applicantId;
    }

    // set
    public function set($applicationId, $applicantId, $roomId, $rentingType, $moveInDate, $moveOutDate, $note, $flag, $applicationDate)
    {
        $this->applicationId = $applicationId;
        $this->applicantId = $applicantId;
        $this->roomId = $roomId;
        $this->rentingType = $rentingType;
        $this->date = [
            'moveIn' => $moveInDate,
            'moveOut' => $moveOutDate
        ];
        $this->note = $note;
        $this->flag = $flag;
        $this->applicationDate = $applicationDate;
    }

    // register application
    public function register()
    {
        global $conn;
        $moveInDate = $this->date['moveIn'];
        $moveOutDate = $this->date['moveOut'];

        $this->flag = 'pending';

        date_default_timezone_set('Asia/Kathmandu');
        $this->applicationDate = Date('Y-m-d H:i:s');

        $query = "INSERT INTO application_tb (applicant_id, room_id, renting_type, move_in_date, move_out_date, note, flag, application_date) VALUES ('$this->applicantId', '$this->roomId', '$this->rentingType', '$moveInDate', '$moveOutDate', '$this->note','$this->flag', '$this->applicationDate')";
        $result = $conn->query($query);
        return $result;
    }

    // fetch
    public function fetch($id)
    {
        global $conn;
        $found = false;
        $query = "SELECT * FROM application_tb WHERE application_id = '$id' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $found = true;
            $this->set($row['application_id'], $row['applicant_id'], $row['room_id'], $row['renting_type'], $row['move_in_date'], $row['move_out_date'], $row['note'], $row['flag'], $row['application_date']);
        }
        return $found;
    }

    // check if application has already been submitted
    public function checkApplication($applicantId, $roomId)
    {
        global $conn;
        $list = [];
        $query = "SELECT * FROM application_tb WHERE room_id = '$roomId' AND applicant_id = '$applicantId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $list[] = $row;;
            }
        }
        return $list;
    }

    // fetch application for a room
    public function fetchForRoom($roomId)
    {
        global $conn;
        $applicationList = [];
        $query = "SELECT * FROM application_tb WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

    // fetch application for a tenant
    public function fetchForTenant($applicantId)
    {
        global $conn;
        $applicationList = [];
        $query = "SELECT * FROM application_tb WHERE applicant_id = '$applicantId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

    // acknowlege application :: accept
    // $task = accept || reject
    public function accept($applicationId)
    {
        global $conn;
        $query = "UPDATE application_tb SET flag = 'accepted' WHERE application_id = '$applicationId'";
        $result = $conn->query($query);
        return $result;
    }

    // reject all remaining applications
    public function rejectRemaining($roomId)
    {
        global $conn;
        $query = "UPDATE application_tb SET flag = 'expired' WHERE room_id = '$roomId' AND flag = 'pending'";
        $result = $conn->query($query);
        return $result;
    }

    // expire all remaining applications
    public function expireApplicationOfApplicant($applicantId)
    {
        global $conn;
        $query = "UPDATE application_tb SET flag = 'expired' WHERE applicant_id = '$applicantId' AND flag = 'pending'";
        $result = $conn->query($query);
        return $result;
    }

    // expired
    public function expire($id)
    {
        global $conn;
        $query = "UPDATE application_tb SET flag = 'expired' WHERE application_id = '$id'";
        $result = $conn->query($query);
        return $result;
    }


    // acknowlege application :: reject
    public function reject($applicationId)
    {
        global $conn;
        $query = "UPDATE application_tb SET flag = 'rejected' WHERE application_id = '$applicationId'";
        $result = $conn->query($query);
        return $result;
    }

    // acknowlege application :: cancel application
    public function cancel($applicationId)
    {
        global $conn;
        $query = "UPDATE application_tb SET flag = 'cancelled' WHERE application_id = '$applicationId'";
        $result = $conn->query($query);
        return $result;
    }

    // check application state
    public function applicationState($id)
    {
        global $conn;
        $state = "not-found";
        $query = "SELECT flag FROM application_tb WHERE application_id = '$id' LIMIT 1";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $state = $row['flag'];
        }

        return $state;
    }

    // check if the applicant is the accepted one
    public function checkIfAcceptedApplicant($applicantId)
    {
        global $conn;
        $query = "SELECT application_id FROM application_tb WHERE applicant_id = '$applicantId' AND flag = 'accepted'";
        $result = $conn->query($query);
        return $result->num_rows > 0 ? true : false;
    }

    // fetch roomId by application id
    public function fetchRoomIdByApplicationId($applicationId)
    {
        global $conn;
        $roomId = 0;
        $query = "SELECT room_id FROM application_tb WHERE application_id = '$applicationId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $roomId = $row['room_id'];
        }
        return $roomId;
    }

    // fetch applied room :: applicatio state -> pending
    public function fetchAppliedRoomId($applicantId)
    {
        global $conn;
        $roomId = 0;
        $query = "SELECT room_id FROM application_tb WHERE applicant_id = '$applicantId' AND flag = 'pending' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $roomId = $row['room_id'];
        }
        return $roomId;
    }

    // fetch all application of landlord
    public function fetchApplicationByRoomList($roomIdList)
    {
        global $conn;
        $applicationList = [];

        $arrayString = "'" . implode("','", $roomIdList) . "'";

        $query = "SELECT * FROM application_tb WHERE room_id IN ($arrayString) ORDER BY application_date DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

    // fetch all application my room list
    public function fetchApplicationIdByRoomList($roomIdList)
    {
        global $conn;
        $applicationList = [];

        $arrayString = "'" . implode("','", $roomIdList) . "'";

        $query = "SELECT application_id FROM application_tb WHERE room_id IN ($arrayString)";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

    // fetch all pending application my room list
    public function fetchPendingApplicationIdByRoomList($roomIdList)
    {
        global $conn;
        $applicationList = [];

        $arrayString = "'" . implode("','", $roomIdList) . "'";

        $query = "SELECT application_id FROM application_tb WHERE room_id IN ($arrayString) AND flag = 'pending'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

    // fetch all accepted application my room list
    public function fetchAcceptedApplicationIdByRoomList($roomIdList)
    {
        global $conn;
        $applicationList = [];

        $arrayString = "'" . implode("','", $roomIdList) . "'";

        $query = "SELECT application_id FROM application_tb WHERE room_id IN ($arrayString) AND flag = 'accepted'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

    // fetch all rejected application my room list
    public function fetchRejectedApplicationIdByRoomList($roomIdList)
    {
        global $conn;
        $applicationList = [];

        $arrayString = "'" . implode("','", $roomIdList) . "'";

        $query = "SELECT application_id FROM application_tb WHERE room_id IN ($arrayString) AND flag = 'rejected'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

     // fetch all expired application my room list
     public function fetchExpiredApplicationIdByRoomList($roomIdList)
     {
         global $conn;
         $applicationList = [];
 
         $arrayString = "'" . implode("','", $roomIdList) . "'";
 
         $query = "SELECT application_id FROM application_tb WHERE room_id IN ($arrayString) AND flag = 'expired'";
         $result = $conn->query($query);
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $applicationList[] = $row;
             }
         }
         return $applicationList;
     }

      // fetch all rejected application my room list
    public function fetchCancelledApplicationIdByRoomList($roomIdList)
    {
        global $conn;
        $applicationList = [];

        $arrayString = "'" . implode("','", $roomIdList) . "'";

        $query = "SELECT application_id FROM application_tb WHERE room_id IN ($arrayString) AND flag = 'cancelled'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $applicationList[] = $row;
            }
        }
        return $applicationList;
    }

    // fetch application of the tenants
    public function fetchApplicationOfTenant($applicantId)
    {
        global $conn;
        $list = [];
        $query = "SELECT * FROM application_tb WHERE applicant_id = '$applicantId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // fetch application id by user id and room id
    public function fetchApplicationIdByUserRoomId($userId, $roomId)
    {
        global $conn;
        $id = 0;
        $query = "SELECT application_id FROM application_tb WHERE applicant_id = '$userId' AND room_id = '$roomId' AND flag = 'pending' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $id = $row['application_id'];
        }
        return $id;
    }

    // fetch application state
    public function fetchApplicationStatus($roomId, $applicantId)
    {
        global $conn;
        $flag = "unknown";
        $query = "SELECT flag FROM application_tb WHERE room_id = '$roomId' AND applicant_id = '$applicantId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flag = $row['flag'];
            }
        }
        return $flag;
    }

    // check for expired applciation
    public function checkExpired($id)
    {
        global $conn;
        $query = "SELECT application_date FROM application_tb WHERE application_id = '$id' AND flag = 'pending' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $dbData = $result->fetch_assoc();

            // compare with the current date and time
            $applicationDateTime = new DateTime($dbData['application_date']);

            date_default_timezone_set('Asia/Kathmandu');
            $currentDateTime = new DateTime(date('Y-m-d H:i:s'));

            // Calculate the difference
            $interval = $applicationDateTime->diff($currentDateTime);
            $seconds = ($interval->days * 24 * 60 * 60) + ($interval->h * 60 * 60) + ($interval->i * 60) + $interval->s;

            // Check if the difference is greater than 24 hours (86400 seconds)
            if ($seconds > 86400) {
                // set the flag to expired
                $this->expire($id);
            }
        }
    }

}