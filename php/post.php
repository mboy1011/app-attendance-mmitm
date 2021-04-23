<?php
// require('session.php');
$data = json_decode(file_get_contents("php://input"),true);
$req = $data['req'];
if($req=='addUser'){
    $name = $data['nm'];
    $un = $data['un'];
    $pw = $data['pw'];
    $id = $data['id'];
    $ty = $data['ty'];
    require("query.php");
    $oop = new Query();
    $sql = $oop->addUser($name,$un,$pw,$id,$ty);
    if ($sql==1) {
        echo 'exists';
    }else if($sql==2){
        echo 'failed';
    }else if($sql==3){
        echo 'success';
    }
}else if($req=='addCourse'){
    $course_name=$data['course_name'];
    $course_desc=$data['course_desc'];
    require("query.php");
    $oop=new Query();
    $sql=$oop->addCourse($course_name,$course_desc);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
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
}else if($req=='addClass'){
    require("query.php");
    $id = $data['id'];
    $yr = $data['yr'];
    $sec = $data['sec'];
    $oop=new Query();
    $sql=$oop->addClass($id,$yr,$sec);
    if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=="addFaculty"){
    $idno = $data['id'];
    $fac = $data['fac'];
    $em = $data['em'];
    $con = $data['con'];
    require('query.php');
    $oop = new Query();
    $sql = $oop->addFaculty($idno,$fac,$em,$con);
    if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
    // // $oop = new Query();
    // $course_name = $data['course_name'];
    // $year = $data['year'];
    // $section = $data['section'];
    // $sql = $oop->addClass($course_name, $year, $section);
    // echo $sql;    
}else if($req=="addAttend"){
    require('query.php');
    $oop = new Query();
    $ls = $data['data'];
    $sql = $oop->addAttend($ls);
    echo $sql;
}else if($req=='addStudent'){
    $id_no=$data['id_no'];
    $name=$data['name'];
    $class_id=$data['class_id'];
    require("query.php");
    $oop=new Query();
    $sql=$oop->addStudent($id_no,$class_id,$name);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=='updateStudent'){
    $id_no=$data['id_no'];
    $name=$data['name'];
    $class_id=$data['class_id'];
    require("query.php");
    $oop=new Query();
    $sql=$oop->updateStudent($id_no,$class_id,$name);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=='updateUser'){
    require("query.php");
    $user=$data['user'];
    $pass=$data['pass'];
    $type=$data['type'];
    $auth=$data['auth'];
    $id=$data['id'];
    $oop=new Query();
    $sql=$oop->updateStudent($user,$pass,$type,$auth,$id);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=="checkStat"){
    require('query.php');
    $cid=$data['cid'];
    $oop=new Query();
    $sql=$oop->checkStat($cid);
    echo $sql;
}else if($req=='addClassSubject'){
    $c=$data['c'];
    $f=$data['f'];
    $s=$data['s'];
    require("query.php");
    $oop=new Query();
    $sql=$oop->addClassSubject($c,$s,$f);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=='addSubject'){
    $subject_name=$data['subject_name'];
    $subject_desc=$data['subject_desc'];

    require("query.php");
    $oop=new Query();
    $sql=$oop->addSubject($subject_name,$subject_desc);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}

?>