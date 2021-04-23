<?php
require 'config.php';
session_start();
if(session_destroy()){
	header("location:../index.php");
}
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
mysqli_close($db);
?>