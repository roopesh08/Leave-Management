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
$result=mysqli_query($conn,"SELECT tprofile.name  ,  leave_timetable.date , leave_timetable.day , leave_timetable.period , leave_timetable.section, leave_timetable.year FROM tprofile , leave_timetable WHERE  leave_timetable.replaced_faculty_id=$user and tprofile.user_id=leave_timetable.actual_faculty_id");
$unread_msg=mysqli_num_rows($result);
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
			<li><a href="message.php">MESSAGES</a></li>
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
                                      <th width=25%>Name</th>
                                      <th width=20%>Date</th>
									   <th width=15%>Day</th>
									  <th width=15%>Period</th>
									  <th width=15%>Year </th>
									  <th  width=15%> Section</th>
                                    </tr>
                                 
                                    <?php 
									
									
                                    if($unread_msg>0)
                                    while($row=mysqli_fetch_assoc($result))
                                    {
									{ 
									?>
									<tr>
                                      <td><?php echo $row['name']?></td>
									   <td><?php echo $row['date']?></td>
									   <td><?php echo $row['day']?></td>
									   <td><?php echo $row['period']?></td>
									   <td><?php echo $row['year']?></td>
									   <td><?php echo $row['section']?></td>
									
                                    </tr>
									<?php 
                                    }
                                    }
									?>
                         </form>
                         </table>
						 </div>
				</div>
				</div>
</div>
</body>
</html>
