<?php
class Query {
    public function login($user, $pass){
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM ");
    }
    public function addUser($name,$uname,$passwd)
    {
        require('config.php');
        $enc_pass = password_hash($passwd,PASSWORD_BCRYPT);
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$uname'");
        if($sql->num_rows>0){
            return 'exists';
        }else{
            $res = mysqli_query($db,"INSERT INTO users(`name`,username,`password`) VALUES ('".$name."','".$uname."','".$enc_pass."')");
            if (!$res) {
                return false;
            }else{
                return true;
            }
        }
    }
}
?>