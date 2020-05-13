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
<link rel="stylesheet" href="css/display-messages.css"> 
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
                <hr>
                <table class="outer-table">
                    <tr><th>color</th><th>Status</th></tr>
                    <tr><td style='background-color:green' align='center'></td><td>APPROVED</td></tr>
                    <tr><td style='background-color:orange' align='center'></td><td>PENDING</td></tr>
                    <tr><td style='background-color:red' align='center'></td><td>REJECTED</td></tr>
                </table>
                <br>
                <hr>
                <br>
                <div>
                    <table class="inner-table">
                        <tr>
                            <th width=8%>Date</th><th width=5%>Day</th>
                            <?php
                        $get_period=mysqli_query($conn,"select * from sessions");
                        $period_value=mysqli_fetch_assoc($get_period);
                        for($i=1;$i<=$period_value['session'];$i++){
                            echo "<th> ".$i." Period</th>";
                        }
                        ?>
                        
                        </tr>
                        <?php
                        $selfId=$userRow['id'];
                        $get_assigned_dates=mysqli_query($conn,"SELECT * FROM `leave_timetable` where replaced_faculty_id='$selfId' GROUP BY `date` ORDER BY `date`");
                        while($row=mysqli_fetch_assoc($get_assigned_dates)){
                            echo "<tr><td>".$row['date']."</td><td>".$row['day']."</td>";

                            $get_period=mysqli_query($conn,"select * from sessions");
                            $period_value=mysqli_fetch_assoc($get_period);
                            $date=$row['date'];
                            $period=$row['period'];
                            for($i=1;$i<=$period_value['session'];$i++){
                                // echo "<td> ".$i." Period</td>";
                                if($period==$i){
                                    $get_assigned_timetable=mysqli_query($conn,"select * from leave_timetable where replaced_faculty_id='$selfId' and `date`='$date' and period='$period'");
                                    if(mysqli_num_rows($get_assigned_timetable)){
                                        $get_leave_timetable=mysqli_fetch_assoc($get_assigned_timetable);
                                        $leave_id=$get_leave_timetable['leave_id'];
                                        $get_leave_status=mysqli_query($conn,"select * from leave_log where leave_id='$leave_id'");
                                        $fetch_leave_status=mysqli_fetch_assoc($get_leave_status);
                                        if($fetch_leave_status['status']=='PENDING'){
                                            $color="orange";
                                        }
                                        if($fetch_leave_status['status']=='APPROVED'){
                                            $color="green";
                                        }
                                        if($fetch_leave_status['status']=='REJECTED'){
                                            $color="red";
                                        }

                                        $get_assigned_timetable=mysqli_query($conn,"select * from leave_timetable where replaced_faculty_id='$selfId' and `date`='$date' and period='$period'");
                                        $get_leave_timetable=mysqli_fetch_assoc($get_assigned_timetable);
                                        $actual_faculty_id=$fetch_leave_status['faculty_id'];
                                        $subject_id=$get_leave_timetable['subject_id'];
                                        $get_actual_facutly=mysqli_query($conn,"select * from tprofile where id='$actual_faculty_id'");
                                        $fetch_actual_faculty=mysqli_fetch_assoc($get_actual_facutly);
                                        $get_subject_details=mysqli_query($conn,"select * from subject where subject_id='$subject_id'");
                                        $fetch_subject_details=mysqli_fetch_assoc($get_subject_details);
                                        $branch=$get_leave_timetable['branch'];
                                        $get_branch=mysqli_query($conn,"select * from department where department='$branch'");
                                        $fetch_branch=mysqli_fetch_assoc($get_branch);
                                        echo "<td style='color:whitesmoke;background-color:".$color."' align='center' >".$fetch_actual_faculty['name']."<br>".$get_leave_timetable['year']."-".$fetch_branch['department_abbreviation']."-".$get_leave_timetable['section']."<br>".$fetch_subject_details['subject_name']."</td>";
                                    }
                                }else{
                                    echo "<td>---</td>";
                                }
                            }
                            echo "</td>";
                        }
                        ?>
                    </table>

                </div>
						 </div>
				</div>
				</div>
</div>
</body>
</html>
