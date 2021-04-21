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
  public function addStudent($id_number,$class_id,$name,)
  {
      require('config.php');
      $sql = mysqli_query($db,"SELECT * FROM students WHERE id_no='$id_number'");
      if($sql->num_rows>0){
          return 1;
      }else{
          $res = mysqli_query($db,"INSERT INTO students(`id_no`,`class_id`,`name`) VALUES ('".$id_number."','".$class_id."','".$name."')");
          if (!$res) {
              return 2;
          }else{
              return 3;
          }
      }
    }




}

?>