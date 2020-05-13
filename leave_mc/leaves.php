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
<link rel="stylesheet" href="css/view-all-leaves.css"> 
<title>Welcome - <?php echo $userRow['email']; ?></title>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
	if(window.XMLHttpRequest){
	xmlhttp=new XMLHttpRequest();
	}
	else{
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	function fun(){
	
	}
	function approve(v){
		xmlhttp.onreadystatechange=function(){
			if(this.readyState==4&&this.status==200){
				window.location.href='leaves.php';
			}
		};
		xmlhttp.open("GET","apply_leave.php?apply=true&leave="+v,true);
		xmlhttp.send();
	}
	</script>
</head>
<body>
	<input type="checkbox" id="check">
	<label for="check">
	<i class="fas fa-bars" id="btn"></i>
	<i class="fas fa-bars" id="cancel"></i>
	</label>
		<div class="sidebar"  style='overflow:auto'>
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
					<h2>CAMPUS MANAGEMENT</h2>
				</div>
		</div>
	<div class="right-side">
		<div class="right-inside"> 
				<div class="inbox">
					<table class="table">
						<form method='post'>
					<tr>
						<th width=5%>S No</th>
						<th width=15%>Leave Applicant</th>
						<th width=15%>From Date</th>
						<th width=15%>To Date</th>
						<th width=15%>Applied Date</th>
						<th width=15%>Leave Type</th>
						<th width=10%>Status</th>
						<th style="background-color:white;font-size:10px"></th>
					</tr>
					
					<tbody id='content'>
					<?php
					$get_leave=mysqli_query($conn,"select * from leave_log order by applied_date desc");
					$sno=0;
					while($row=mysqli_fetch_assoc($get_leave)){
						$sno=$sno+1;
						echo "<tr>";
						echo "<td>".$sno."</td>";
						$tid=$row['faculty_id'];
						$get_faculty_name=mysqli_query($conn,"select * from tprofile where id='$tid'");
						$fetch_faculty_name=mysqli_fetch_assoc($get_faculty_name);
						echo "<td>".$fetch_faculty_name['name']."</td>";
						echo "<td>".$row['from_date']."</td>";
						echo "<td>".$row['to_date']."</td>";
						echo "<td>".$row['applied_date']."</td>";
						echo "<td>".$row['leave_type']."</td>";
						echo "<td>".$row['status']."</td>";
						if($row['status']=='APPROVED'){
							// echo "<td><input type='button' value='check details'></td>";
						}else{
							echo "<td><input type='button' value='Approve' style='outline:none;font-size:18px;text-align:center' id='".$row['leave_id']."' onclick='approve(this.id)'></td>";
							echo "<td><input type='button' value='Rejected' style='outline:none;font-size:18px' id='".$row['leave_id']."' onclick='approve(this.id)'></td>";
						}
						
						echo "</tr>";
					}
					?>
					</tbody>
				</form>
			</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>