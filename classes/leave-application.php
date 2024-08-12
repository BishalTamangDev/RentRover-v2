<?php

require_once __DIR__ . '/../app/connection.php';

class Leave
{
    public $leaveId;
    private $tenantId;
    public $roomId;
    public $note;
    public $moveOutDate;

    public $submittedDate;

    // constructor
    public function __construct()
    {
        $this->leaveId = '';
        $this->tenantId = '';
        $this->roomId = '';
        $this->note = '';
        $this->moveOutDate = '';
        $this->submittedDate = '';
    }

    // setter
    public function setTenantId($id)
    {
        $this->tenantId = $id;
    }

    // getter
    public function getTenantId()
    {
        return $this->tenantId;
    }

    // set
    public function set($leaveId, $roomId, $tenantId, $note, $moveOutDate, $submittedDate)
    {
        $this->leaveId = $leaveId;
        $this->roomId = $roomId;
        $this->tenantId = $tenantId;
        $this->note = $note;
        $this->moveOutDate = $moveOutDate;
        $this->submittedDate = $submittedDate;
    }

    // register
    public function register()
    {
        global $conn;
        date_default_timezone_set('Asia/Kathmandu');
        $this->submittedDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO leave_application_tb (room_id, tenant_id, note, move_out_date, submitted_date) VALUES ('$this->roomId','$this->tenantId','$this->note','$this->moveOutDate','$this->submittedDate')";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch
    public function fetch($leaveId)
    {
        global $conn;
        $exists = false;
        $query = "SELECT * FROM leave_application_tb WHERE leave_id = '$leaveId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $exists = true;
            $data = $result->fetch_assoc();
            $this->set($data['leave_id'], $data['room_id'], $data['tenant_id'], $data['note'], $data['move_out_date'], $data['submitted_date']);
        }
        return $exists;
    }

    // delete
    public function delete($leaveId)
    {
        global $conn;
        $query = "DELETE FROM leave_application_tb WHERE leave_id = '$leaveId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch all the leave application for landlord
    public function fetchAllLeaveApplicationForLandlord($roomIdList)
    {
        global $conn;
        $list = [];

        $arrayString = "'" . implode("','", $roomIdList) . "'";

        $query = "SELECT * FROM leave_application_tb WHERE room_id IN ($arrayString) ORDER BY leave_id DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // fetch applications of tenant
    public function fetchTenantLeaveApplications($tenantId)
    {
        global $conn;
        $list = [];
        $query = "SELECT * FROM leave_application_tb WHERE tenant_id = '$tenantId' ORDER BY leave_id DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // check of tenant has already applied
    public function checkApplicantionForTenantAndRoom($tenantId, $roomId)
    {
        global $conn;
        $alreadyApplied = false;
        $query = "SELECT * FROM leave_application_tb WHERE tenant_id = '$tenantId' AND room_id = '$roomId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $alreadyApplied = true;
        }
        return $alreadyApplied;
    }
}