<?php

require_once __DIR__ . '/../app/connection.php';

class Review
{
    public $reviewId;
    private $userId;
    public $roomId;
    public $review;
    public $rating;
    public $reviewDate;

    // constructor
    public function __construct()
    {
        $this->reviewId = '';
        $this->userId = '';
        $this->roomId = '';
        $this->review = '';
        $this->rating = '';
        $this->reviewDate = '';
    }

    // setter
    public function setUserId($id)
    {
        $this->userId = $id;
    }

    // getter
    public function getUserId()
    {
        return $this->userId;
    }

    // set
    public function set($reviewId, $roomId, $userId, $review, $rating, $reviewDate)
    {
        $this->reviewId = $reviewId;
        $this->roomId = $roomId;
        $this->userId = $userId;
        $this->review = $review;
        $this->rating = $rating;
        $this->reviewDate = $reviewDate;
    }

    // register
    public function register()
    {
        global $conn;
        date_default_timezone_set('Asia/Kathmandu');
        $this->reviewDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO review_tb (room_id, user_id, review, rating, review_date) VALUES ('$this->roomId','$this->userId','$this->review','$this->rating','$this->reviewDate')";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch
    public function fetch($reviewId)
    {
        global $conn;
        $query = "SELECT * FROM review_tb WHERE review_id = '$reviewId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $this->set($data['review_id'], $data['room_id'], $data['user_id'], $data['review'], $data['rating'], $data['review_date']);
        }
    }

    // fetch all review of the room
    public function fetchRoomReviews($roomId)
    {
        global $conn;
        $list = [];
        $query = "SELECT * FROM review_tb WHERE room_id = '$roomId' ORDER BY review_id DESC ";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // delete
    public function delete($reviewId)
    {
        global $conn;
        $query = "DELETE FROM review_tb WHERE review_id = '$reviewId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // get rating
    public function calculateRating($roomId)
    {
        global $conn;
        $rating = 0;
        $query = "SELECT * FROM review_tb WHERE room_id = '$roomId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $total = 0;
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                $total += $row['rating'];
                $count++;
            }
            $rating = $total / $count;
        }

        return $rating;
    }
}