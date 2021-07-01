<?php
require('session.php');
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
    
    if($sql==1){
        echo $sql;
    }else if($sql==2){
        echo $sql;
    }else {
        $_SESSION['addUser']='suc';
        echo $sql;
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
        $_SESSION['addCor']='suc';
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
    $addr = $data['addr'];
    require('query.php');
    $oop = new Query();
    $sql = $oop->addFaculty($idno,$fac,$em,$con,$addr);
    if($sql==1){
        echo 'dup';
    }else if($sql==3){
        $_SESSION['addFac']='suc';
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    } 
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


}else if($req=="checkStat"){
    require('query.php');
    $cid=$data['cid'];
    $oop=new Query();
    $sql=$oop->checkStat($cid);
    echo $sql;
}else if($req=='updateUser'){
    $user=$data['user'];
    $pass=$data['pass'];
    $type=$data['type'];
    $auth=$data['auth'];
    $id=$data['id'];
    
    require("query.php");
    $oop=new Query();
    $sql=$oop->updateUser($user,$pass,$type,$auth,$id);
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
}else if(isset($_POST['mulDel'])){
    require("query.php");
    $oop = new Query();
    $arr = json_decode($_POST['arrData']);
    $sql = $oop->remFac($arr);
    $_SESSION['mulDel']=$sql;
    header("location:view_faculty.php");
}else if(isset($_POST['mulDelSub'])){
    require("query.php");
    $oop = new Query();
    $arr = json_decode($_POST['arrData']);
    $sql = $oop->remSub($arr);
    $_SESSION['mulDelSub']=$sql;
    header("location:view_subject.php");
}else if(isset($_POST['mulDelUser'])){
    require("query.php");
    $oop = new Query();
    $arr = json_decode($_POST['arrData']);
    $sql = $oop->remUser($arr);
    $_SESSION['mulDelUser']=$sql;
    header("location:view_user.php");
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
        $_SESSION['addClassSubject']=$sql;
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
        $_SESSION['addSub']='suc';
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=='updateFaculty'){
    $fn=$data['fn'];
    $email=$data['email'];
    $cont=$data['cont'];
    $add=$data['add'];
    $id=$data['id'];
    $idno=$data['idno'];
    
    require("query.php");
    $oop=new Query();
    $sql=$oop->updateFaculty($fn,$email,$cont,$add,$id,$idno);
    if($sql=='fuc'){
        $_SESSION['upFac']='suc';
        echo $sql;
    }else{
        $_SESSION['upFac']='fai';
        echo $sql;
    }
    
}else if($req=='updateCourse'){
    $id=$data['id'];
    $course=$data['course'];
    $desc=$data['desc'];
    
    require("query.php");
    $oop=new Query();
    $sql=$oop->updateCourse($id,$course,$desc);
    if($sql=='fuc'){
        $_SESSION['upFac']='suc';
        echo $sql;
    }else{
        $_SESSION['upFac']='fai';
        echo $sql;
    }
}else if($req=='updateSubject'){
    $id=$data['id'];
    $sub=$data['sub'];
    $desc=$data['desc'];


    
    require("query.php");
    $oop=new Query();
    $sql=$oop->updateSubject($id,$sub,$desc);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=='updateClass'){
    $id=$data['id'];
    $course=$data['course'];
    $level=$data['level'];
    $sect=$data['sect'];
    require("query.php");
    $oop=new Query();
    $sql=$oop->updateClass($id,$course,$level,$sect);
     if($sql==1){
        echo 'dup';
    }else if($sql==3){
        echo 'suc';
    }else if($sql==2){
        echo 'fai';
    }
}else if($req=='getCSC'){
    require("query.php");
    $oop = new Query();
    $sql = $oop->get_viewCSC();
    echo $sql;
}else if($req=='viewDetails'){
    require("query.php");
    $id=$data['atlid'];
    $oop = new Query();
    $sql = $oop->viewDetails($id);
    echo $sql;
}else if($req=='getFacStudList'){
    require("query.php");
    $fid = $data['fac_id'];
    $cid = $data['cl_id'];
    $sid = $data['sub_id'];
    $oop = new Query();
    $sql = $oop->getFacStudList($fid,$cid,$sid);
    echo $sql;
}
?>