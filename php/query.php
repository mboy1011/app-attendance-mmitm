<?php
class Query {
    public function login($user, $pass){
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$user'");
        $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
        if($sql->num_rows>0){
            if(password_verify($pass,$row['password'])){
                session_start();
                $_SESSION['login_user']=$row['id'];
                header('location:php/dashboard.php');
            }else{
                return 'incorrect pass';
            }
        }else{
            return false;
        }
    }
    public function addUser($name,$uname,$passwd)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$uname'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $enc_pass = password_hash($passwd,PASSWORD_BCRYPT);
            $res = mysqli_query($db,"INSERT INTO users(`name`,username,`password`) VALUES ('".$name."','".$uname."','".$enc_pass."')");
            if (!$res) {
                return false;
            }else{
                return true;
            }
        }
    }
    public function addCourse($course_name,$course_desc)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$uname'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $enc_pass = password_hash($passwd,PASSWORD_BCRYPT);
           
            $res = mysqli_query($db,"INSERT INTO course(id,'course','description',date_created) VALUES ('".$course_name."','".$course_desc."','$date');
            if (!$res) {
                return false;
            }else{
                return true;
            }
        }
    }
}
?>