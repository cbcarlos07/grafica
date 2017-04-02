<?php
include "../include/error.php";
 if(!isset($_SESSION['login'])  ){

     header("location: ../erro.php");
 }else{
     header("location: .");
   } 
 
?>