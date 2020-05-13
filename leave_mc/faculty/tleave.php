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
<link rel="stylesheet" href="css/apply-leave.css"> 
<title>Welcome - <?php echo $userRow['email']; ?></title>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
function fun(){
	d1=document.getElementById("fromdate").value;
	d2=document.getElementById("todate").value;
	if(d2==''||d1==''){

	}else{
			var fromdate=new Date(d1);
			var todate=new Date(d2);
			if(fromdate>todate){
				alert(fromdate);
			}else{
				document.getElementById("showtimetable").innerHTML="<center>Please Wait....</center>";
				xmlhttp.onreadystatechange=function(){
					if(this.readyState==4&&this.status==200){
						document.getElementById("showtimetable").innerHTML=this.responseText;
					}
				};
				xmlhttp.open("GET","showtimetable.php?fromdate="+d1+"&todate="+d2,true);
				xmlhttp.send();
			}
	}

}

</script>
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
							<form method="post">
							<select name="subject"  >
							<option value="">--LEAVE TYPE--</option>
							<option value="sick">SICK</option>
							<option value="causal">CAUSAL</option>
							<option value="optional">OPTIONAL</option>
							</select>
							<br>
								<label for="from">FROM DATE</label>
								
								<input type="date" class="from" id='fromdate' name="fromdate" min='<?php echo date("Y-m-d");?>' onchange='fun();'>
								
								<label for="to">TO DATE</label>
								<input type="date" name="todate" id='todate' class="to" min='<?php echo date("Y-m-d");?>' onchange='fun();'>
								<div id='showtimetable'></div>
								<textarea rows="6" cols="50" name="body" placeholder="Body"></textarea></br>
								<button type="submit" name="apply_leave" >Submit</button>
							</form>
							
						</div>
					</div>
				</div>
</div>
<?php
		
	?> 
</body>
</html>
<?php
if(isset($_POST['apply_leave'])){
	echo "<script>alert('".$_POST['fromdate']."');</script>";
	if($_POST['fromdate']!=''&&$_POST['todate']!=''&&$_POST['subject']!=''&&$_POST['body']!=''){
		$fromdate=date_create($_POST['fromdate']);
		$todate=date_create($_POST['todate']);
	
		if($fromdate<$todate){
			$todate->modify('+1 day');
			$fromdate_value=date_format($fromdate,'Y-m-d');
			$todate_value=date_format($todate,'Y-m-d');
			$period=new DatePeriod(
				new DateTime($fromdate_value),
				new DateInterval('P1D'),
				new DateTime($todate_value)
			);
			$no_days=0;
			

			foreach($period as $value){
				
				$day_sno=$value->format('w');
				if($day_sno!=0){
					$no_days=$no_days+1;
					$get_day=mysqli_query($conn,"select * from days where sno='$day_sno'");
					echo mysqli_num_rows($get_day);
					$fetch_day=mysqli_fetch_assoc($get_day);
					$day=$fetch_day['name'];
					$self_id=$userRow['id'];
					$get_reserved_class=mysqli_query($conn,"select * from timetable where tid='$self_id' and day='$day' order by period");
					while($row=mysqli_fetch_assoc($get_reserved_class)){
						$get_post_value=$value->format('d-m-Y').$row['period'];
						if($_POST[$get_post_value]==''){
							echo "<script>alert('Please Fill The Details.....');</script>";
							header("Location:tleave.php");
						}
					}
				}
			}
			$fromdate1=date_create($_POST['fromdate']);
			$fromdate1_value=date_format($fromdate1,'Y-m-d');
			$todate1=date_create($_POST['todate']);
			$todate1_value=date_format($todate1,'Y-m-d');
			$current_date=date("Y-m-d");
			$body=$_POST['body'];
			$subject=$_POST['subject'];

			$apply_leave=mysqli_query($conn,"insert into `leave_log` values(null,'$self_id','$fromdate1_value','$todate1_value','PENDING','$no_days','$current_date','0000-00-00','$body','$subject')");
			$last_id=mysqli_insert_id($conn);
			foreach($period as $value){
				
				$day_sno=$value->format('w');
				if($day_sno!=0){
					$no_days=$no_days+1;
					$get_day=mysqli_query($conn,"select * from days where sno='$day_sno'");
					echo mysqli_num_rows($get_day);
					$fetch_day=mysqli_fetch_assoc($get_day);
					$day=$fetch_day['name'];
					$self_id=$userRow['id'];
					$get_reserved_class=mysqli_query($conn,"select * from timetable where tid='$self_id' and day='$day' order by period");
					while($row=mysqli_fetch_assoc($get_reserved_class)){
						$get_post_value=$value->format('d-m-Y').$row['period'];
						$replaced_faculty_id=$_POST[$get_post_value];
						$subject_id=$row['subject_id'];
						$date=$value->format('Y-m-d');
						$period_v=$row['period'];
						$year_v=$row['year'];
						$branch_v=$row['branch'];
						$section_v=$row['section'];
						echo "insert into leave_timetable values(null,'$last_id','$self_id','$replaced_faculty_id','$subject_id','$date','$day','$period_v','$year_v','$branch_v','$section_v')"."<br>";
						mysqli_query($conn,"insert into leave_timetable values(null,'$last_id','$self_id','$replaced_faculty_id','$subject_id','$date','$day','$period_v','$year_v','$branch_v','$section_v')");
						
					}
				}
			}
		
			
		}
	}

}

?>