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
// if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
// 	$id=mysqli_real_escape_string($conn,$_GET['id']);
// 	mysqli_query($conn,"delete from `leave_type` where id='$id'");
// }
// $result=mysqli_query($conn,"select * from `leave_type` where empolyee_id=".$_SESSION['user']);


?>
<html>
<head>
<link rel="stylesheet" href="css/leave-status.css"> 
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
				<div class="inbox"><?php
				?>
				<table class="table">
					<tr>
						<th width=5%>S No</th>
						<th width=20%>From Date</th>
						<th width=20%>To Date</th>
						<th width=20%>Applied Date</th>
						<th width=20%>Leave Type</th>
						<th width=20%>Status</th>
					</tr>
					<tbody id='content'>
					<?php
					$get_self=mysqli_query($conn,"select * from tprofile where user_id='$user'");
					$fetch_self=mysqli_fetch_assoc($get_self);
					$self_id=$fetch_self['id'];
					$get_leave=mysqli_query($conn,"select * from leave_log where faculty_id='$self_id' order by applied_date desc");
					$sno=0;
					while($row=mysqli_fetch_assoc($get_leave)){
						$sno=$sno+1;
						echo "<tr>";
						echo "<td>".$sno."</td>";
						$tid=$row['faculty_id'];
						
						echo "<td>".$row['from_date']."</td>";
						echo "<td>".$row['to_date']."</td>";
						echo "<td>".$row['applied_date']."</td>";
						echo "<td>".$row['leave_type']."</td>";
						echo "<td>".$row['status']."</td>";
						
						
						echo "</tr>";
					}
					?>
					</tbody>
					</table>
				</div>
				</div>
</div>
</body>
</html>