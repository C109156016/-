<?php
session_start();
if(isset($_SESSION['email']))
{
        $uid=$_SESSION['uid'];    
        $email=$_SESSION['email'];
        $username=$_SESSION['username'];
        $loadlogin=$_SESSION['loadlogin'];
}
else
    {
        include('basic.php');
        switchto("index.php");
    }
?>