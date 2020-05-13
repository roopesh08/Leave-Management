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
<?php
$result=mysqli_query($conn,"SELECT  `name`, `id`, `gender`, `dob`, `department`, `email`, `phno`, `address` FROM `tprofile` WHERE  user_id='$user'");
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
		<div class="sidebar">
			<header>HOME</header>
			<ul> 
			<li><a href="teacherhome.php">HOME</a></li>
			<li><a href="viewprofile.php">VIEW PROFILE</a></li>
			<li><a href="tleave.php">APPLY LEAVE</a></li>
			<li><a href="leavestatus.php">LEAVE STATUS</a></li>
			<li><a href="messages.php">MESSAGES</a></li>
			<li><a href="tlogout.php?logout">SIGN OUT</a></li>
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
					<table class="table ">
                               <form method="post">  
                                    <tr>
                                      <th width=12%>Name</th>
									   <th width=10%>ID No</th>
                                      <th width=20%>Email</th>
									  <th>Gender</th>
									  <th width=20%>Date Of Birth</th>
									  <th width=15%>Department</th>
									  <th width=10%>Phone No</th>
									  <th width=20%>Address</th>
                                 
                                    </tr>
                                 
                                    <?php 
									
									$row=mysqli_fetch_assoc($result); 
									if($row!=null)
									{ 
									?>
									<tr>
                                      <td><?php echo $row['name']?></td>
									   <td><?php echo $row['id']?></td>
									   <td><?php echo $row['email']?></td>
									   <td><?php echo $row['gender']?></td>
									   <td><?php echo $row['dob']?></td>
									   <td><?php echo $row['department']?></td>
									   <td><?php echo $row['phno']?></td>
									   <td><?php echo $row['address']?></td>
									   
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
