<?php
session_start();

if(!isset($_SESSION['user']))
{
 header("Location: campuslogin.php");
}
else if(isset($_SESSION['user'])!="")
{
 header("Location: campushome.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['user']);
 header("Location: index.php");
}
?>