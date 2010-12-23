<?php
session_start(); 
if(!isset($_SESSION['validate'])){ 
header("location: entrar.php"); 
} else { 
session_unset(); 
session_destroy();
header("location: entrar.php"); 
} 
?>