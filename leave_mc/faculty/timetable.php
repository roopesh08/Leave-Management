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
<link rel="stylesheet" href="css/time-table.css"> 
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
            <li><a href="timetable.php">Time Table</a></li>
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
			<div>
                <center>
                <table class="table">
                    <tr>
                        <th>Day</th>
                        <?php
                        $get_period=mysqli_query($conn,"select * from sessions");
                        $period_value=mysqli_fetch_assoc($get_period);
                        for($i=1;$i<=$period_value['session'];$i++){
                            echo "<th align='center'> ".$i." Period</th>";
                        }
                        ?>
                    </tr>
                    <?php
                    $faculty_id=$userRow['id'];
                    $days=mysqli_query($conn,"select * from days");
                    while($row=mysqli_fetch_assoc($days)){
                        ?>
                        <tr>
                        <td><?php echo $row['name'];?></td>
                        <?php
                        $get_period=mysqli_query($conn,"select * from sessions");
                        $period_value=mysqli_fetch_assoc($get_period);
                        for($i=1;$i<=$period_value['session'];$i++){
                            echo "<td align='center'>";
                            $day=$row['name'];
                            $get_timetable=mysqli_query($conn,"select * from timetable where tid='$faculty_id' and period='$i' and day='$day'");
                            if(mysqli_num_rows($get_timetable)!=0){
                                while($timetable=mysqli_fetch_assoc($get_timetable)){
                                    $branch=$timetable['branch'];
                                    $sub_id=$timetable['subject_id'];
                                    $get_branch=mysqli_query($conn,"select * from department where department='$branch'");
                                    $fetch_branch=mysqli_fetch_assoc($get_branch);
                                    $get_subject=mysqli_query($conn,"select * from subject where subject_id='$sub_id'");
                                    $fetch_subject=mysqli_fetch_assoc($get_subject);
                                    echo $timetable['year']."-".$fetch_branch['department_abbreviation']."-".$timetable['section']."<br>";
                                    echo $fetch_subject['subject_abbreviation'];
                                }
                             }else{
                                 echo "---";
                             }
                            echo "</td>";
                        }
                    }
                    ?>
                    </table>
                    </center>
                </div>
                
			</div>
		</div>
			
</body>
</html>