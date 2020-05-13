<?php
if(!($conn=mysqli_connect("localhost","root","","lev")))
{
     die('oops connection problem ! --> '.mysqli_connect_error());
}
?>