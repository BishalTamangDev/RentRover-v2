<?php

require_once __DIR__ . '/../app/connection.php';

class Feedback
{
    public $feedbackId;
    private $userId;
    public $feedback;
    public $rating;
    public $feedbackDate;

    // constructor
    public function __construct()
    {
        $this->feedbackId = '';
        $this->userId = '';
        $this->feedback = '';
        $this->rating = '';
        $this->feedbackDate = '';
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
    public function set($feedbackId, $userId, $feedback, $rating, $feedbackDate)
    {
        $this->feedbackId = $feedbackId;
        $this->userId = $userId;
        $this->feedback = $feedback;
        $this->rating = $rating;
        $this->feedbackDate = $feedbackDate;
    }

    // register
    public function register()
    {
        global $conn;
        date_default_timezone_set('Asia/Kathmandu');
        $this->feedbackDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO feedback_tb (user_id, feedback, rating, feedback_date) VALUES ('$this->userId','$this->feedback','$this->rating','$this->feedbackDate')";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch
    public function fetch($feedbackId)
    {
        global $conn;
        $query = "SELECT * FROM feedback_tb WHERE feedback_id = '$feedbackId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $this->set($data['feedback_id'], $data['user_id'], $data['feedback'], $data['rating'], $data['feedback_date']);
        }
    }

    // delete
    public function delete($feedbackId)
    {
        global $conn;
        $query = "DELETE FROM feedback_tb WHERE feedback_id = '$feedbackId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch all feedbacks
    public function fetchAll()
    {
        global $conn;
        $query = "SELECT * FROM feedback_tb";
        $result = $conn->query($query);
        $list = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // fetch latest feedbacks :: 3
    public function fetchLatest()
    {
        global $conn;
        $query = "SELECT * FROM feedback_tb ORDER BY feedback_id DESC LIMIT 2";
        $result = $conn->query($query);
        $list = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // fetch feedback for user :: 3
    public function fetchForUser()
    {
        global $conn;
        $query = "SELECT * FROM feedback_tb ORDER BY feedback_id DESC";
        $result = $conn->query($query);
        $list = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        return $list;
    }

    // count feedbacks
    public function count()
    {
        global $conn;
        $count = 0;
        $query = "SELECT COUNT(feedback_id) AS total FROM feedback_tb";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $count = $data['total'];
        }
        return $count;
    }
}