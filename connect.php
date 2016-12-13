<?php

class connect {

    public $hostname = "localhost";
    public $username = "root";
    public $password = "";
    public $db = "usermodule";
    public $conn;
    static $instance;

    function __construct() {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->db);
        if (!$this->conn) {
            echo mysqli_connect_error();
        }
        return $this->conn;
    }

    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function selectUser() {
        $selectUser_query = "select * from user_info where isActive=1";
        $selectUser_result = mysqli_query($this->conn, $selectUser_query);
        return $selectUser_result;
    }

    function selectHistory() {
        $selectHistory_query = "select * from user_info where isActive=0";
        $selectHistory_result = mysqli_query($this->conn, $selectHistory_query);
        return $selectHistory_result;
    }

    function createOrUpdate($username, $contact, $email) {
        $checkData_query = "select id from user_info where username='$username'";
        $checkData_result = mysqli_query($this->conn, $checkData_query);
        if (mysqli_num_rows($checkData_result) == 1) {
            $update_query = "update user_info set contact=$contact , email='$email' where username='$username'";
            mysqli_query($this->conn, $update_query);
            echo "Data is available. Data updated successfully";
        } else if (mysqli_num_rows($checkData_result) == 0) {
            $insert_query = "insert into user_info(username,contact,email) values('$username',$contact,'$email')";
            mysqli_query($this->conn, $insert_query);
            echo "Data inserted successfully";
        }
    }

    function delete($id) {
        $delete_query = "delete from user_info where id=$id";
        $delete_result = mysqli_query($this->conn, $delete_query);
        return $delete_result;
    }

    function restoreOrTrash($id, $action) {
        $result = null;
        if ($action == 'restore') {
            $restore_query = "update user_info set isActive=1 where id=$id";
            $result = mysqli_query($this->conn, $restore_query);
            return $result;
        } else if ($action == 'trash') {
            $trash_query = "update user_info set isActive=0 where id=$id";
            $result = mysqli_query($this->conn, $trash_query);
            return $result;
        }
    }

    function typeHead($searchTerm) {
        $search_query = "SELECT * FROM user_info WHERE username LIKE '$searchTerm%' and isActive=1 ORDER BY username ASC";
        $search_result = mysqli_query($this->conn, $search_query);
        while ($row = mysqli_fetch_assoc($search_result)) {
            $data[] = $row['username'];
        }
        return $data;
    }
}

?>
