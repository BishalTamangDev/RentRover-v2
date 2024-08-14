<?php

require_once __DIR__ . '/../app/connection.php';

class Tenancy
{
    public $tenancyId;
    private $roomId;
    private $tenantId;
    public $moveInDate;
    public $moveOutDate;

    // constructor
    public function __construct()
    {
        $this->tenancyId = '';
        $this->roomId = '';
        $this->tenantId = '';
        $this->moveInDate = '';
        $this->moveOutDate = '';
    }

    // setter
    public function setRoomId($id)
    {
        $this->roomId = $id;
    }

    public function setTenantId($id)
    {
        $this->tenantId = $id;
    }

    // getters
    public function getRoomId()
    {
        return $this->roomId;
    }

    public function getTenantId()
    {
        return $this->tenantId;
    }

    public function set($tenancyId, $tenantId, $roomId, $moveInDate, $moveOutDate)
    {
        $this->tenancyId = $tenancyId;
        $this->tenantId = $tenantId;
        $this->roomId = $roomId;
        $this->moveInDate = $moveInDate;
        $this->moveOutDate = $moveOutDate;
    }

    // add
    public function register()
    {
        global $conn;
        $query = "INSERT INTO tenancy_tb (tenant_id, room_id, move_in_date, move_out_date) VALUES ('$this->tenantId','$this->roomId','$this->moveInDate','$this->moveOutDate')";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch
    public function fetch($id)
    {
        global $conn;
        $query = "SELECT * FROM tenancy_tb WHERE tenancy_id = '$id' LIMIT 1";
        $result = $conn->query($query);
        $found = false;
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $found = true;
            $this->set($id, $data['tenant_id'], $data['room_id'], $data['move_in_date'], $data['move_out_date']);
        }
        return $found;
    }

    // fetch history of tenant
    public function fetchHistoryOfTenant($tenantId)
    {
        global $conn;
        $query = "SELECT * FROM tenancy_tb WHERE tenant_id = '$tenantId' ORDER BY tenancy_id DESC";
        $result = $conn->query($query);
        $list = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // fetch all room of landlord
    public function fetchHistoryForLandlord($roomList)
    {
        global $conn;
        $historyList = [];

        $arrayString = "'" . implode("','", $roomList) . "'";

        $query = "SELECT tenancy_id FROM tenancy_tb WHERE room_id IN ($arrayString) ORDER BY tenancy_id DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $historyList[] = $row['tenancy_id'];
            }
        }
        return $historyList;
    }

    // remove tenant
    public function removeTenant($roomId, $tenantId)
    {
        global $conn;
        date_default_timezone_set('Asia/Kathmandu');
        $moveOutDate = date('Y-m-d H:i:s');

        $query = "UPDATE tenancy_tb SET move_out_date = '$moveOutDate' WHERE room_id = '$roomId' AND tenant_id = '$tenantId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }
}