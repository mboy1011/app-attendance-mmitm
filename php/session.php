<?php
    require('config.php');
    session_start();  
    if(!isset($_SESSION['login_user'])){
      header("location:logout.php");
   }
?>