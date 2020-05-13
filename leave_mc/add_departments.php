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

<?php
$department='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	$result=mysqli_query($conn,"select * from department where id='$id'");
	$row=mysqli_fetch_assoc($result);
	$department=$row['department'];
}
if(isset($_POST['department'])){
	$department=mysqli_real_escape_string($conn,$_POST['department']);
	if($id>0){
		$sql="update department set department='$department' where id='$id'";
	}else{
		$sql="insert into department(department) values('$department')";
	}
	mysqli_query($conn,$sql);
	header('location:view_departments.php');
	die();
}
?>
<html>
<head>
<link rel="stylesheet" href="css/add-department.css"> 
<title>Welcome - <?php echo $userRow['email']; ?></title>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

	<input type="checkbox" id="check">
	<label for="check">
	<i class="fas fa-bars" id="btn"></i>
	<i class="fas fa-bars" id="cancel"></i>
	</label>
		<div class="sidebar" style='overflow:auto'>
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
			<h2>CAMPUS </h2>
			</div>
	</div>

			
				<div class="right-side">
				<div class="right-inside">
				<div class="heading"><h3>ADD DEPARTMENT</h3></div>
                           <form method="post">
								<input type="text"  value="<?php echo $department?>" name="department"  placeholder="Enter your department name" required></br>
							   
							   <button  type="submit" name="submit">SUBMIT</button>
							  </form>
				</div>
				</div>
</div>
</body>
</html>