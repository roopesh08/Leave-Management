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
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	mysqli_query($conn,"delete from tprofile where id='$id'");
}
$result=mysqli_query($conn,"SELECT  `name`, `id`, `gender`, `dob`, `department`, `email`, `phno`, `address`  from tprofile");
?>
<html>
<head>
<link rel="stylesheet" href="css/view-profiles.css"> 
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
				<div class="inbox">
					<table class="table ">
                               <form method="post">  
                                    <tr>
                                    <th width=12%>Name</th>
									<th width=15%>ID No</th>
                                    <th width=15%>Email</th>
									<th>Gender</th>
									<th width=20%>Date Of Birth</th>
									<th width=8%>Department</th>
									<th width=12%>Phone No</th>
									<th width=18%>Address</th>
									<th width=5%></th>
                                       
                                    </tr>
                                 
                                    <?php
								
									while($row=mysqli_fetch_assoc($result)){?>
									<tr>
                                       <td><?php echo $row['name']?></td>
									   <td><?php echo $row['id']?></td>
									   <td><?php echo $row['email']?></td>
									   <td><?php echo $row['gender']?></td>
									   <td><?php echo $row['dob']?></td>
									   <td><?php echo $row['department']?></td>
									   <td><?php echo $row['phno']?></td>
									   <td><?php echo $row['address']?></td>
									<td><a href="editprofile.php?id=<?php echo $row['id']?>">Edit</a><a href="view_profiles.php?id=<?php echo $row['id']?>&type=delete">Delete</a></td>
         
									   
                                    </tr>
									<?php 
									
									} ?>
                                 </form>
                              </table>
							  </div>
				</div>
				</div>
</div>
</body>
</html>
