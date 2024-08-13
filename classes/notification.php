<?php

require_once __DIR__ . '/../app/connection.php';

class Notification
{
    public $notificationId;
    public $whose; // user || admin 
    public $type;
    public $date;
    public $status; // seen || unseen
    public $userId;
    public $tenantId;
    public $roomId;
    public $houseId;
    public $applicationId;
    public $leaveApplicationId;
    public $issueId;
    public $noticeId;
    public $feedbackId;

    // constructor
    public function __construct()
    {
        $this->notificationId = 0;
        $this->whose = '';
        $this->type = '';
        $this->date = '';
        $this->status = '';
        $this->userId = 0;
        $this->tenantId = 0;
        $this->roomId = 0;
        $this->houseId = 0;
        $this->applicationId = 0;
        $this->leaveApplicationId = 0;
        $this->issueId = 0;
        $this->noticeId = 0;
        $this->feedbackId = 0;
    }

    // set notification
    public function set($notificationId, $whose, $type, $date, $status, $userId, $tenantId, $roomId, $houseId, $applicationId, $leaveApplicationId, $issueId, $noticeId, $feedbackId)
    {
        $this->notificationId = $notificationId;
        $this->whose = $whose;
        $this->type = $type;
        $this->date = $date;
        $this->status = $status;
        $this->userId = $userId;
        $this->tenantId = $tenantId;
        $this->roomId = $roomId;
        $this->houseId = $houseId;
        $this->applicationId = $applicationId;
        $this->leaveApplicationId = $leaveApplicationId;
        $this->issueId = $issueId;
        $this->noticeId = $noticeId;
        $this->feedbackId = $feedbackId;
    }

    // set
    public function applyForVerification($userId)
    {
        $this->userId = $userId;
        $this->whose = "admin";
        $this->type = "account-verification-apply";
    }



    // register
    public function register()
    {
        global $conn;
        date_default_timezone_set('Asia/Kathmandu');
        $this->date = date('Y-m-d H:i:s');
        $this->status = 'unseen';
        $query = "INSERT INTO notification_tb (whose, user_id, tenant_id, house_id, room_id, application_id, issue_id, leave_application_id, notice_id, type, status, date) 
        VALUES ('$this->whose', '$this->userId', '$this->tenantId', '$this->houseId', '$this->roomId', '$this->applicationId, ', '$this->issueId', '$this->leaveApplicationId', '$this->noticeId', '$this->type', '$this->status', '$this->date')";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch
    public function fetch($notificationId)
    {
        global $conn;
        $query = "SELECT * FROM notification_tb WHERE notification_id = '$notificationId' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $this->set($data['notification_d'], $data['whose'], $data['type'], $data['date'], $data['status'], $data['user_id'], $data['tenant_id'], $data['room_id'], $data['house_id'], $data['application_id'], $data['leave_application_id'], $data['issue_id'], $data['notice_id'], $data['feedback_id']);
        }
    }

    // delete
    public function delete($notificationId)
    {
        global $conn;
        $query = "DELETE FROM notification_tb WHERE notification_id = '$notificationId'";
        $result = $conn->query($query);
        return $result ? true : false;
    }

    // fetch notifcation for admin
    public function fetchAdminNotification()
    {
        $list = [];
        global $conn;
        $query = "SELECT * FROM notification_tb WHERE whose = 'admin'";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $list[] = $row;
        }
        return $list;
    }

    // fetch notifcation for admin
    public function fetchUserNotification($userId)
    {
        $list = [];
        global $conn;
        $query = "SELECT * FROM notification_tb WHERE user_id = '$userId' AND whose = 'user'";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $list[] = $row;
        }
        return $list;
    }

    // count unseen notifcation for admin
    public function countAdminUnseenNotification()
    {
        global $conn;
        $count = 0;
        $query = "SELECT COUNT(notification_id) AS total FROM notification_tb WHERE whose = 'admin' AND status = 'unseen'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['total'];
        }
        return $count;
    }

    // count unseen notifcation for admin
    public function countUserUnseenNotification($userId)
    {
        global $conn;
        $count = 0;
        // $query = "SELECT * FROM notification_tb";
        $query = "SELECT COUNT(notification_id) AS total FROM notification_tb WHERE whose = 'user' AND status = 'unseen' AND user_id = '$userId'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['total'];
        }
        return $count;
    }

    // make seen admin notification
    public function setSeenAdminNotification($notificationId)
    {
        global $conn;
        $query = "UPDATE notification_tb SET status = 'seen' WHERE whose = 'admin' AND status = 'unseen' AND 'notification_id' = '$notificationId'";
        $result = mysqli_query($conn, $query);
        return $result ? true : false;
    }

    // make seen user notification
    public function setSeenUserNotification($userId, $notificationId)
    {
        global $conn;
        $query = "UPDATE notification_tb SET status = 'seen' WHERE whose = 'user' AND user_id = '$userId' AND status = 'unseen' AND 'notification_id' = '$notificationId'";
        $result = mysqli_query($conn, $query);
        return $result ? true : false;
    }

    // make all admin notifications seen
    public function setAllAdminNotificationSeen()
    {
        global $conn;
        $query = "UPDATE notification_tb SET status = 'seen' WHERE whose = 'admin' AND status = 'unseen'";
        $result = mysqli_query($conn, $query);
        return $result ? true : false;
    }

    // make all admin notification seen
    public function setAllUserNotificationSeen($userId)
    {
        global $conn;
        $query = "UPDATE notification_tb SET status = 'seen' WHERE whose = 'user' AND status = 'unseen' AND user_id = '$userId'";
        $result = mysqli_query($conn, $query);
        return $result ? true : false;
    }
}