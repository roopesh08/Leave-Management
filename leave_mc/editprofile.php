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
$name='';
$id='';
$gender='';
$dob='';
$department='';
$email='';
$phno='';
$address='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	$result=mysqli_query($conn,"select `name`, `id`, `gender`, `dob`, `department`, `email`, `phno`, `address` from tprofile where id='$id'");
	$row=mysqli_fetch_assoc($result);
	if($row!=null){
	$name=$row['name'];
	$id=$row['id'];
	$gender=$row['gender'];
	$dob=$row['dob'];
	$department=$row['department'];
	$email=$row['email'];
	$phno=$row['phno'];
	$address=$row['address'];
	}
}
if(isset($_POST['update'])){
	$name=mysqli_real_escape_string($conn,$_POST['name']);
	$gender=mysqli_real_escape_string($conn,$_POST['gender']);
	$dob=mysqli_real_escape_string($conn,$_POST['dob']);
	$department=mysqli_real_escape_string($conn,$_POST['department']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$phno=mysqli_real_escape_string($conn,$_POST['phno']);
	$address=mysqli_real_escape_string($conn,$_POST['address']);
	if($id>0){
		$sql="update tprofile set name='$name',gender='$gender',dob='$dob',department='$department',email='$email',phno='$phno',address='$address' where id='$id'";
	}else{
		$sql="insert into tprofile(name,gender,dob,department,email,phno,address) values('$name','$gender','$dob','$department','$email','$phno','$address')";
	}
	mysqli_query($conn,$sql);
	header('location:view_profiles.php');
	die();
}
?>
<html>
<head>
<link rel="stylesheet" href="css/edit-profile.css"> 
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
			<li><a href="campushome.php">HOME</a></li>
			<li><a href="view_profiles.php">PROFILE'S</a></li>
			<li><a href="tprofile.php">ADD PROFILE</a></li>
			<li><a href="leaves.php">LEAVES</a></li>
			<li><a href="add_departments.php">ADD DEPARTMENT</a></li>
			<li><a href="view_departments.php">VIEW DEPARTMENT</a></li>
			<li><a href="timetable.php">TIME TABLE</a></li>
            <li><a href="timetable.php">ADD SUBJECTS</a></li>
            <li><a href="timetable.php">ADD CLASSES</a></li>
            <li><a href="map_faculty_class_subject.php">MAP TEACHERS</a></li>
			<li><a href="clogout.php?logout">SIGN OUT</a></li>
			</ul>
			</div>

<div class="total">
	<div class="header">
			<div class="headerin">
			<h2>TEACHER LOGIN</h2>
			</div>
	</div>
				<div class="right-side">
					<div class="right-inside">
						<div class="inbox">
							<form method="post">
							
							<input type="text" name="name" placeholder="Name" value="<?php echo $name?>" required>
							<input type="text" name="id" placeholder="ID no" value="<?php echo $id?>" required>
							<br>
						
							
							<label for="dat" >  Date Of Birth</label>
							<input type="date" class="dat" name="dob" placeholder="Date Of Birth" required>
							<input type="radio" class ="rad" name="gender"  value="male"required>
						   <label for="rad">Male</label>
							<input type="radio" name="gender" class="rad" value="female"required>
							<label for="rad">Female</label>
							<br>
							
							
							
							<input type="text" name="email" placeholder="Email" value="<?php echo $email?>" required>
							<input type="text" name="phno" placeholder="Mobile No" value="<?php echo $phno?>"required>
							<select name="department"  class="sel"required>
							<option value="">--Select  Proffesion--</option>
							<?php
							$result=mysqli_query($conn,"SELECT * from department");
							while($row=mysqli_fetch_assoc($result))
							{
								echo "<option value=".$row['department'].">".$row['department']."</option>";
							}
						
							?>
							</select>
							<br>
							<textarea rows="6" cols="50"  name="address" placeholder="Address" value="<?php echo $address?>"></textarea><br>
							<button type="submit" name="update">SUBMIT</button>   
							</form>
							</div>
					</div>
				</div>
</div>
</body>
</html>