<?php
class Query {
    public function login($user, $pass){
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM ");
    }
    public function addUser($name,$uname,$passwd,$type,$fid)
    {
        require('config.php');
        $enc_pass = password_has($pass,PASSWORD_BCRYPT);
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username=$uname");
        if($sql->num_rows>0){
            return false;
        }else{
            $res = mysqli_query($db,"INSERT INTO users(`name`,username,`password`,`type`,faculty_id) VALUES ('".$name."','".$uname."','".$passwd."','".$unatypeme."','".$fid."')");
            if (!$res) {
                return false;
            }else{
                return true;
            }
        }
    }
}
?>