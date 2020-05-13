<?php
session_start();
include_once 'conn.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($conn,"SELECT * FROM campususers WHERE user_id=".$_SESSION['user']);
$user = $_SESSION['user'];
$userRow=mysqli_fetch_assoc($res);
?>
<html>
<head>
<link rel="stylesheet" href="css/campus_home.css"> 
<title>Welcome - <?php echo $userRow['email']; ?></title>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

	<input type="checkbox" id="check">
	<label for="check">
	<i class="fas fa-bars" id="btn"></i>
	<i class="fas fa-bars" id="cancel"></i>
	</label>
		<div class="sidebar" >
			<header>HOME</header>
			<ul> 
			<li><a href="campushome.php">HOME</a></li>
			<li><a href="view_profiles.php">PROFILE'S</a></li>
			<li><a href="tprofile.php">ADD PROFILE</a></li>
			<li><a href="leaves.php">LEAVES</a></li>
			<li><a href="add_departments.php">ADD DEPARTMENT</a></li>
			<li><a href="view_departments.php">VIEW DEPARTMENT</a></li>
			<li><a href="timetable.php">TIME TABLE</a></li>
            <li><a href="addsubject.php">ADD SUBJECTS</a></li>
            <li><a href="addclass.php">ADD CLASSES</a></li>
            <li><a href="map_faculty_class_subject.php">MAP TEACHERS</a></li>
			<li><a href="clogout.php?logout">SIGN OUT</a></li>
			</ul>
			</div>
<div class="total">
	<div class="header">
			<div class="headerin">
			<h2>CAMPUS LEAVE MANAGEMENT</h2>
			</div>
	</div>
		<div class="right-side">
			
				<div class="outer">
				<h1>Add Sessions</h1>
				<form method="POST">
				<table>
					<tr> 
						<td>Sessions
							<?php
							require 'conn.php';
							$q=mysqli_query($conn,"select * from sessions");
							$n=mysqli_num_rows($q);
							if($n==0){
								mysqli_query($conn,"insert into sessions values(null,0,0)");
							}
							$q=mysqli_query($conn,"select * from sessions");
							while($row=mysqli_fetch_assoc($q)){
								echo "<input type='text' disabled value='".$row['session']."'>";
							}

							echo "<input type='submit' value='ADD' name='add'>";
							?>

						</td>
						
						
					</tr>
					<tr></tr>
				</table>
				</form>
				</div>
				<div class="inner">
				<h1>Break Timing</h1>
				<form method="POST">
				<table>
					<tr> 
						<td>Select Breack after
							<?php
							require 'conn.php';
							$q=mysqli_query($conn,"select * from sessions");
							$n=mysqli_num_rows($q);
							if($n==0){
								mysqli_query($conn,"insert into sessions values(null,0,0)");
							}
							$q=mysqli_query($conn,"select * from sessions");
							while($row=mysqli_fetch_assoc($q)){
								$s=$row['session'];
							}
							echo "<select name='session'>";
							for($i=1;$i<=$s;$i++){
								echo "<option>".$i."</option>";
							}
							echo "</select>";
							echo "<input type='submit' value='Update' name='update'>";
							?>

						</td>
						
						
					</tr>
					<tr></tr>
				</table>
				</form>
				</div>
		</div>
</div>
</body>
<?php



if(isset($_POST['add'])){
	require 'conn.php';
	$q=mysqli_query($conn,"select * from sessions");
	while($row=mysqli_fetch_assoc($q)){
		$sno=$row['id'];
		$session=$row['session']+1;
	}
	if(mysqli_query($conn,"update sessions set session='$session' where id='$sno'")){
		echo "<script>alert('Session Added Successfully');</script>";
		header("Location:campushome.php");
	}else{
		echo "<script>alert('Error while adding the Session');</script>";
	}
}





if(isset($_POST['update'])){
	require 'conn.php';
	$s=$_POST['session'];
	echo "<script>alert('".$s."');</script>";
	$q=mysqli_query($conn,"select * from sessions");
	$row=mysqli_fetch_assoc($q);
	if($row['session']>=$s){
		if(mysqli_query($conn,"update `sessions` set `break`=$s where id=".$row['id'].""))
		echo "<script>alert('Break Session Updated Successfully');</script>";
		else
		echo "<script>alert('Break Session Not Updated');</script>";
	}
}
?>
</html>
