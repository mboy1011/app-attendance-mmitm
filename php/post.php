<?php
// require('session.php');
$data = json_decode(file_get_contents("php://input"),true);
$req = $data['req'];
if($req=='addUser'){
    $name = $data['nm'];
    $un = $data['un'];
    $pw = $data['pw'];
    require("query.php");
    $oop = new Query();
    $sql = $oop->addUser($name,$un,$pw);
    if ($sql==1) {
        echo 'exists';
    }else if(!$sql){
        echo 'failed';
    }else{
        echo 'success';
    }
}else if($req=='addCourse'){
    $course_name=$data['course_name'];
    $course_desc=$data['course_desc'];
    require("query.php");
    $oop=new Query();
    $sql=$oop->addCourse($course_name,$course_desc);
     if(!$sql){
        echo 'failed';
    }else{
        echo 'success';
    }

}else if($req=='getSubject'){
    $id = $data['fa'];
    require("query.php");
    $oop = new Query();
    $sql = $oop->getSubject($id);
    echo $sql;
}else if($req=='getStudents'){
    require("query.php");
    $oop = new Query();
    $id = $data['cid'];
    $sql = $oop->getStudents($id);
    echo $sql;    
}else if($req=='addStudent'){
    $id_number=$data['id_number'];
    $name=$data['name'];
    $class_id=$data['class_id'];
    require("query.php");
    $oop=new Query();
    $sql=$oop->addStudent($id_number,$name,$class_id);
     if(!$sql){
        echo 'failed';
    }else{
        echo 'success';
    }
?>