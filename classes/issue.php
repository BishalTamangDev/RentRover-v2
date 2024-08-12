<?php

require_once __DIR__ . '/../app/connection.php';

class Issue
{
    public $issueId;
    private $tenantId;
    private $roomId;
    public $issue;
    public $date = [
        'issued' => '',
        'solved' => ''
    ];
    public $flag;

    // constructor
    public function __construct()
    {
        $this->issueId = '';
        $this->tenantId = '';
        $this->roomId = '';
        $this->issue = '';
        $this->date = [
            'issued' => '',
            'solved' => ''
        ];
    }

    // setter
    public function setTenantId($id)
    {
        $this->tenantId = $id;
    }

    public function setRoomId($id)
    {
        $this->roomId = $id;
    }

    // getter
    public function getTenantId()
    {
        return $this->tenantId;
    }

    public function getRoomId()
    {
        return $this->roomId;
    }

    // set
    public function set($issueId, $roomId, $tenantId, $issue, $issuedDate, $solvedDate, $flag)
    {
        $this->issueId = $issueId;
        $this->roomId = $roomId;
        $this->tenantId = $tenantId;
        $this->issue = $issue;
        $this->date = [
            'issued' => $issuedDate,
            'solved' => $solvedDate
        ];
        $this->flag = $flag;
    }

    // register
    public function register()
    {
        global $conn;
        date_default_timezone_set('Asia/Kathmandu');
        $issuedDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO issue_tb (room_id, tenant_id, issue, issued_date, flag) VALUES ('$this->roomId','$this->tenantId','$this->issue','$issuedDate', 'unsolved')";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch
    public function fetch($issueId)
    {
        global $conn;
        $found = false;
        $query = "SELECT * FROM issue_tb WHERE issue_id = '$issueId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $found = true;
            $data = $result->fetch_assoc();
            $this->set($data['issue_id'], $data['room_id'], $data['tenant_id'], $data['issue'], $data['issued_date'], $data['solved_date'], $data['flag']);
        }
        return $found;
    }

    // delete
    public function delete($issueId)
    {
        global $conn;
        $query = "DELETE FROM issue_tb WHERE issue_id = '$issueId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch all issues
    public function fetchIssueForRoom($roomId)
    {
        global $conn;
        $query = "SELECT * FROM issue_tb WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        $list = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // fetch all issues for landlord
    public function fetchIssuesForLanlord($roomIdList)
    {
        global $conn;
        $list = [];
        $arrayString = "'" . implode("','", $roomIdList) . "'";
        $query = "SELECT * FROM issue_tb WHERE room_id IN ($arrayString) ORDER BY issue_id DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }

        return $list;
    }

    // fetch issue for tenant
    public function fetchIssueForTenant($tenantId)
    {
        global $conn;
        $query = "SELECT * FROM issue_tb WHERE tenant_id = '$tenantId'";
        $result = $conn->query($query);
        $list = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // solve issue
    public function solve($issueId)
    {
        global $conn;

        date_default_timezone_set('Asia/Kathmandu');
        $solvedDate = date('Y-m-d H:i:s');

        $query = "UPDATE issue_tb SET flag = 'solved', solved_date = '$solvedDate' WHERE issue_id = '$issueId'";
        $result = $conn->query($query);

        return $result ? true : false;
    }
}