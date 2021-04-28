<?php
class Query {
    public function login($user, $pass){
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$user'");
        $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
        if($sql->num_rows>0){
            if($row['type']==2){
                session_start();
                $_SESSION['login_user']=$row['id'];
                $_SESSION['utype']=$row['type'];
                header('location:php/user/check_attendance.php');
            }else if(password_verify($pass,$row['password'])){
                session_start();
                $_SESSION['login_user']=$row['id'];
                $_SESSION['utype']=$row['type'];
                header('location:php/dashboard.php');
            }else{
                return 'incorrect pass';
            }
        }else{
            return false;
        }
    }
    public function addUser($name,$uname,$passwd,$id,$ty)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM users WHERE username='$uname'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $enc_pass = password_hash($passwd,PASSWORD_BCRYPT);
            $res = mysqli_query($db,"INSERT INTO users(`name`,username,`password`,`faculty_id`,`type`) VALUES ('".$name."','".$uname."','".$enc_pass."','".$id."','".$ty."')");
            if (!$res) {
                return 2;
            }else{
                return 3;
            }
        }
    }
    public function getSubject($id)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT class_subject.id as 'class_id',subjects.sub_name FROM class_subject join subjects on class_subject.subject_id=subjects.id left join faculty on faculty.id=class_subject.faculty_id WHERE faculty_id='$id'");
        $data=array();
        while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
            array_push($data,$row);
        }
        return json_encode($data);
    }
    public function getStudents($id)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT s.id as 'sid',s.class_id as 'cid',s.name  FROM students as s join class_subject as cs on cs.id=s.class_id where s.class_id='$id'");
        $data=array();
        while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
            array_push($data,$row);
        }
        return json_encode($data);
    }
    public function addCourse($course_name,$course_desc)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM courses WHERE course='$course_name'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $res = mysqli_query($db,"INSERT INTO courses(`course`,`description`) VALUES ('".$course_name."','".$course_desc."')");
            if (!$res) {
                return 2;
            }else{
                return 3;
            }
        }
    }
    public function addClass($id,$yr, $sec)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM class WHERE course_id='$id' AND `level`='$yr' AND `section`='$sec'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $res = mysqli_query($db,"INSERT INTO class(`course_id`,`level`,`section`) VALUES ('".$id."','".$yr."','".$sec."')");
            if (!$res) {
                return 2;
            }else{
                return 3;
            }
        }
    }
    public function addFaculty($idno,$fac,$em,$con)
    {
        require("config.php");
        $sql = mysqli_query($db,"SELECT * FROM faculty WHERE id_no='$idno' AND email='$em'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $res = mysqli_query($db,"INSERT INTO faculty(`id_no`,`name`,`email`,`contact`) VALUES ('".$idno."','".$fac."','".$em."','".$con."')");
            if (!$res) {
                return 2;
            }else{
                return 3;
            }
        }
    }
    public function addAttend($ls)
    {
        require('config.php');
        $cid = $ls[0]['class_id'];
        $sql = mysqli_query($db,"SELECT * FROM `attendance_list` WHERE class_subject_id='$cid' AND DATE_FORMAT(date_created,'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')");
        if($sql->num_rows>0){
            return 1;
        }else{
            $values = array();
            $res = mysqli_query($db,"INSERT INTO attendance_list(`class_subject_id`) VALUES ('".$cid."')");
            $at_id = $db->insert_id;
            for ($i=0; $i < count($ls); $i++) { 
                $mulres = $this->addRecord($at_id,$ls[$i]['stud_id'],$ls[$i]['type']);
                $values[] = $mulres;
            }
            return json_encode($values);
        }
    }
    public function checkStat($cid)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM `attendance_list` WHERE class_subject_id='$cid' AND DATE_FORMAT(date_created,'%Y%c%d')=DATE_FORMAT(now(),'%Y%c%d')");
        if($sql->num_rows>0){
            return 1;
        }else{
            return 0;
        }
    }
    public function remFac($arr)
    {
        require("config.php");
        $values = array();
        for ($i=0; $i < count($arr); $i++) { 
            $mdel = $this->deleteFaculty($arr[$i]);
            $values[] = $mdel;
        }
        return json_encode($values);
    }
    public function deleteFaculty($id)
    {
        require("config.php");
        $sql = mysqli_query($db,"DELETE FROM faculty WHERE id='$id'");
        if(!$sql){
            return 'fai';
        }else{
            return 'suc';
        }
    }
    public function addRecord($at_id,$sid,$ty)
    {
        require('config.php');
        $query = mysqli_query($db,"INSERT INTO attendance_record(`attendance_id`,`student_id`,`type`) VALUES ('".$at_id."','".$sid."','".$ty."')");   
        if(!$query){
            return 'fai';
        }else{
            return 'suc';
        }
    }
    public function addStudent($id_no,$class_id,$name){

        require('config.php');
            $sql = mysqli_query($db,"SELECT * FROM students WHERE id_no='$id_no'");
            if($sql->num_rows>0){
                return 1;
            }else{
                $res = mysqli_query($db,"INSERT INTO students(`id_no`,`class_id`,`name`) VALUES ('".$id_no."','".$class_id."','".$name."')");
                if (!$res) {
                    return 2;
                }else{
                    return 3;
                }
            }
    }

    public function updateStudent($id_no,$class_id,$name){
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM students WHERE id_no='$id_no'");
        if(empty($id_no)){
            $save = $this->db->query("INSERT INTO students set $data");
        }else{
            $save = $this->db->query("UPDATE students set $data where id = $id_no");
        }
        if($save){
            return 1;
        }
    }
    public function addClassSubject($c,$s,$f){
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM class_subject where class_id='$c'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $res = mysqli_query($db,"INSERT INTO class_subject(`class_id`,`subject_id`,`faculty_id`) VALUES ('".$c."','".$s."','".$f."')");
            if (!$res) {
                return 2;
            }else{
                return 3;
            }
        }
        
    }
    public function addSubject($subject_name,$subject_desc)
    {
        require('config.php');
        $sql = mysqli_query($db,"SELECT * FROM subjects WHERE sub_name='$subject_name'");
        if($sql->num_rows>0){
            return 1;
        }else{
            $res = mysqli_query($db,"INSERT INTO subjects(`sub_name`,`description`) VALUES ('".$subject_name."','".$subject_desc."')");
            if (!$res) {
                return 2;
            }else{
                return 3;
            }
        }
    }
    public function updateUser($user,$pass,$type,$id,$test,$auth){
        require('config.php');
        $query = mysqli_query($db,"UPDATE users SET username = $user WHERE id=$id");   
        if(!$query){
            return 'fai';
        }else{
            return 'suc';
        }
    }
}
?>