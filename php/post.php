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
    requ
}
?>