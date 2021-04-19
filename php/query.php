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
<<<<<<< HEAD
    public function getSubject($id)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT class_subject.id as 'class_id',subjects.sub_name FROM class_subject join subjects on class_subject.subject_id=subjects.id left join faculty on faculty.id=class_subject.faculty_id WHERE faculty_id='$id'");
        $data=array();
        while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
            array_push($data,$row);
        }
        return json_encode($data);
=======
    public function addCourse($course_name,$course_desc)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$uname'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $enc_pass = password_hash($passwd,PASSWORD_BCRYPT);
           
            $res = mysqli_query($db,"INSERT INTO courses('course','description') VALUES ('".$course_name."','".$course_desc."');
            if (!$res) {
                return false;
            }else{
                return true;
            }
        }
>>>>>>> d6727dc91f206dc22c1f7524f72f93f5070ece5d
    }
}
?>