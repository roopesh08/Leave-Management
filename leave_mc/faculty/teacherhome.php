<?php
session_start();
include_once 'conn.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($conn,"SELECT * FROM tprofile WHERE user_id=".$_SESSION['user']);
$user = $_SESSION['user'];
$userRow=mysqli_fetch_assoc($res);
?>
<html>
<head>
<link rel="stylesheet" href="css/teacherhome1.css"> 
<title>Welcome - <?php echo $userRow['email']; ?></title>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
	<input type="checkbox" id="check">
	<label for="check">
	<i class="fas fa-bars" id="btn"></i>
	<i class="fas fa-bars" id="cancel"></i>
	</label>
		<div class="sidebar">
			<header>HOME</header>
			<ul> 
			<li><a href="teacherhome.php">HOME</a></li>
			<li><a href="viewprofile.php">VIEW PROFILE</a></li>
			<li><a href="tleave.php">APPLY LEAVE</a></li>
			<li><a href="leavestatus.php">LEAVE STATUS</a></li>
			<li><a href="timetable.php">TIME TABLE</a></li>
			<li><a href="messages.php">MESSAGES</a></li>
			<li><a href="tlogout.php?logout">SIGN OUT</a></li>
			</ul>
			</div>
		 <div class="total">
			<div class="header">
			<div class="headerin">
			<h3>TEACHER LOGIN</h3>
			</div>
			</div>
			<div class="right-side">
			
			</div>
		</div>
			
</body>
</html>