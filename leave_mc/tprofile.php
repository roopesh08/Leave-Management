<?php
session_start();
include_once 'conn.php';
if(!isset($_SESSION['user']))
{
 header("Location: campuslogin.php");
}
$res=mysqli_query($conn,"SELECT * FROM campususers WHERE user_id=".$_SESSION['user']);
$user = $_SESSION['user'];
$userRow=mysqli_fetch_assoc($res);
?>

<html>
<head>
<link rel="stylesheet" href="css/add-profile.css"> 
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
			<header>OPTIONS</header>
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
			<h2>CAMPUS</h2>
			</div>
	</div>
				<div class="right-side">
					<div class="right-inside">
						<div class="inbox">
							<form method="post">
							
							<input type="text" name="name" placeholder="Name"  required>
							<input type="text" name="id" placeholder="ID no"  required>
							<br>
						
							
							<label for="dat" >  Date Of Birth</label>
							<input type="date" class="dat" name="dob" placeholder="Date Of Birth" required>
							<input type="radio" class ="rad" name="gender"  value="male"required>
						   	<label for="rad">Male</label>
							<input type="radio" name="gender" class="rad" value="female"required>
							<label for="rad">Female</label>
							<br>
							
							
							<input type="password" name="pass" placeholder="Password"  required>
							
							<input type="text" name="email" placeholder="Email"  required><br>
							<input type="text" name="phno" placeholder="Mobile No" required>
							<select name="department"  class="sel"required>
							<option value="">--Select Department--</option>
							<?php
							$result=mysqli_query($conn,"SELECT * from department");
							while($row=mysqli_fetch_assoc($result))
							{
								echo "<option value=".$row['department'].">".$row['department']."</option>";
							}
						
							?>
							</select>
							<br>
							<textarea rows="6" cols="50"  name="address" placeholder="Address" ></textarea><br>
							<button type="submit" name="update">SUBMIT</button>   
							
							</form>
							</div>
					</div>
				</div>
</div>

	<?php
		if(isset($_POST["update"]))
		{
			require 'conn.php';
			$name = $_POST['name'];
			$id = $_POST['id'];
			$dob =$_POST['dob'];
			$gender = $_POST['gender'];
			$pass=$_POST['pass'];
			$department=$_POST['department'];
			$email = $_POST['email'];
			$phno = $_POST['phno'];
			$address = $_POST['address'];
		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "teacher";
			
			//$conn=mysqli_connect($servername,$username,$password,$database);

			if(!$conn)
				die("Unable to connect to the database: ".mysqli_error());
			else
			{
			$sql = "INSERT INTO tprofile(`name`,id,dob,gender,pass,department,email,phno,`address`,`role`) VALUES('$name','$id','$dob','$gender','$pass','$department','$email','$phno','$address',1)";
			if(mysqli_query($conn,$sql))
			header("location:view_profiles.php");
			else{
				echo $sql;
			}
			// echo"<script>alert('NOT UPDATED');</script>";
			}
		}
	?>
</body>
</html>