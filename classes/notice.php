<?php

require_once __DIR__ . '/../app/connection.php';

class Notice
{
    public $noticeId;
    private $houseId;
    private $roomId;
    private $tenantId;
    private $title;
    private $description;
    public $noticeDate;

    // constructor
    public function __construct()
    {
        $this->noticeId = '';
        $this->houseId = '';
        $this->roomId = '';
        $this->tenantId = '';
        $this->title = '';
        $this->description = '';
        $this->noticeDate = '';
    }

    // setter
    public function setHouseId($id)
    {
        $this->houseId = $id;
    }

    public function setRoomId($id)
    {
        $this->roomId = $id;
    }

    public function setTenantId($id)
    {
        $this->tenantId = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    // getter
    public function getHouseId()
    {
        return $this->houseId;
    }

    public function getRoomId()
    {
        return $this->roomId;
    }

    public function getTenantId()
    {
        return $this->tenantId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }


    // set
    public function set($noticeId, $houseId, $roomId, $tenantId, $title, $description, $date)
    {
        $this->noticeId = $noticeId;
        $this->houseId = $houseId;
        $this->roomId = $roomId;
        $this->tenantId = $tenantId;
        $this->title = $title;
        $this->description = $description;
        $this->noticeDate = $date;
    }

    // register
    public function register()
    {
        global $conn;
        date_default_timezone_set('Asia/Kathmandu');
        $currentDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO notice_tb (house_id, room_id, tenant_id, title, description, notice_date) VALUES ('$this->houseId','$this->roomId','$this->tenantId','$this->title', '$this->description', '$currentDate')";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch
    public function fetch($noticeId)
    {
        global $conn;
        $found = false;
        $query = "SELECT * FROM notice_tb WHERE notice_id = '$noticeId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $found = true;
            $data = $result->fetch_assoc();
            $this->set($data['noticeId'], $data['houseId'], $data['roomId'], $data['tenantId'], $data['title'], $data['description'], $data['date']);
        }
        return $found;
    }

    // delete
    public function delete($noticeId)
    {
        global $conn;
        $query = "DELETE FROM notice_tb WHERE notice_id = '$noticeId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }


    // fetch notice for a room for landlord
    public function fetchRoomNoticeForLandlord($roomList)
    {
        global $conn;
        $noticeList = [];
        $arrayString = "'" . implode("','", $roomList) . "'";
        $query = "SELECT * FROM notice_tb WHERE room_id IN ($arrayString) ORDER BY notice_id DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $noticeList[] = $row;
            }
        }
        return $noticeList;
    }


    // fetch notice for a room for landlord
    public function fetchRoomNoticeForTenant($tenantId)
    {
        global $conn;
        $noticeList = [];
        $query = "SELECT * FROM notice_tb WHERE tenant_id = '$tenantId' ORDER BY notice_id DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $noticeList[] = $row;
            }
        }
        return $noticeList;
    }
}