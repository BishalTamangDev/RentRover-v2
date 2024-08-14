<?php

require_once __DIR__ . '/../app/connection.php';

class Wishlist
{
    public $wishlistId;
    private $userId;
    public $roomId;
    public $list = [];

    // constructory
    public function __construct()
    {
        $this->userId = '';
        $this->roomId = '';
        $this->list = [''];
    }

    // setter
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    // getter
    public function getUserId()
    {
        return $this->userId;
    }

    // add to wishlist
    public function add($roomId)
    {
        global $conn;
        $query = "INSERT INTO wishlist_tb (user_id, room_id) VALUES ('$this->userId', '$roomId')";
        $result = $conn->query($query);
        return $result;
    }

    // remove from wishlist
    public function remove($roomId)
    {
        global $conn;
        $query = "DELETE FROM wishlist_tb WHERE user_id = '$this->userId' AND room_id = '$roomId'";
        $result = $conn->query($query);
        return $result;
    }

    //  check if in wishlist
    public function checkWish($roomId)
    {
        global $conn;
        $query = "SELECT room_id FROM wishlist_tb WHERE user_id = '$this->userId' AND room_id = '$roomId' LIMIT 1";
        $result = $conn->query($query);
        return $result->num_rows == 1 ? true : false;
    }

    // fetch wishlist
    public function fetchList()
    {
        global $conn;
        $list = [];
        $query = "SELECT room_id FROM wishlist_tb WHERE user_id = '$this->userId' ORDER BY room_id DESC";
        $result = $conn->query($query);
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $list[] = $row['room_id'];
        return $list;
    }

    // count wishlist
    public function count($userId)
    {
        global $conn;
        $count = 0;
        $query = "SELECT COUNT(*) AS total_rows FROM wishlist_tb WHERE user_id = '$userId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['total_rows'];
        }
        return $count;
    }
}