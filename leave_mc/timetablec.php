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
			<h2>Time table</h2>
			</div>
	</div>
				<div class="right-side">
                <center>
                <button class='manual' onclick='window.location.href="timetable.php"'><h2>MANUAL</h2></button>
                <!-- <button style='margin:10px' onclick='window.location.href="timetablef.php"'><h2>Through Faculty</h2></button> -->
                <button class='through-class' onclick='window.location.href="timetablec.php"'><h2>THROUGH CLASS</h2></button>
                <form method='post' class="first-select">
                <select name='year'  required>
                    <option value=''>----SELECT  YEAR----</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    </select><br>
                    <select name='branch' required>
                    <option value=''>----SELECT BRANCH----</option>
                            <?php
                            require 'conn.php';
                            $q=mysqli_query($conn,"select * from department");
                            while($row=mysqli_fetch_assoc($q)){
                                echo "<option>".$row['department']."</option>";
                            }
                            ?>
                    </select><br>
                    <select name='section'required>
                    <option value=''>----SELECT  SECTION----</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    </select><br>
                    <button  class='first-btn' type="submit" name="submit">SUBMIT</button>
                </form>
                <?php
                if(isset($_POST['submit'])){
                    $year=$_POST['year'];
                    $branch=$_POST['branch'];
                    $section=$_POST['section'];
                    $class_query=mysqli_query($conn,"select * from `class`,`department` where class.year='$year' and class.branch='$branch' and class.section='$section' and department.department='$branch'");
                    $class_sno_fetch=mysqli_fetch_assoc($class_query);
                    $branch_a=$class_sno_fetch['department_abbreviation'];
                    echo "<h3 style='font-size:22px;font-family:consolas'>".$year."-".$branch_a."-".$section."</h3>";
                    $class_sno=$class_sno_fetch['sno'];
                    ?>
                <form method='post'>
                <table class="outer-class">
                    <tr>
                        <th>Days</th>
                        <?php
                        $periods=mysqli_query($conn,"select * from sessions");
                        $period_value=mysqli_fetch_assoc($periods);
                        for($i=1;$i<=$period_value['session'];$i++){
                            echo "<th> ".$i." PERIOD</th>";
                        }
                        ?>
                    </tr>
                    <?php
                    $days=mysqli_query($conn,"select * from days");
                    while($row=mysqli_fetch_assoc($days)){
                        ?>
                        <tr>
                        <th><?php echo $row['name'];?></th>
                        <?php
                        $periods=mysqli_query($conn,"select * from sessions");
                        $period_value=mysqli_fetch_assoc($periods);
                        for($i=1;$i<=$period_value['session'];$i++){
                            echo "<td class='sel'><select class='sel-inside' name='".$row['name'].$i."' required><option value='0'>----SELECT----</option>";

                                $find_facult_query=mysqli_query($conn,"select * from faculty_subject_class where class='$class_sno'");
                                while($row1=mysqli_fetch_assoc($find_facult_query)){
                                    echo "<option value='".$row1['sno']."'>";
                                    $subjectid=$row1['subject_id'];
                                    $subject=mysqli_query($conn,"select * from subject where subject_id='$subjectid'");
                                    $subject_name=mysqli_fetch_assoc($subject);
                                    echo $subject_name['subject_name'];
                                    echo "</option>";
                                }
                            echo "<option value='NONE'>NONE</option></select></td>";
                        }
                        ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <button type='submit' class="outer-btn"  name='timetable_submit' value='Submit'>Submit</button>
                </form>
                <table class="inner-class">
                    <tr><th>Subject</th><th>Faculty</th></tr>
                    <?php
                    $find_facult_queryy=mysqli_query($conn,"select * from faculty_subject_class where class='$class_sno'");
                    while($row1=mysqli_fetch_assoc($find_facult_queryy)){
                        echo "<tr>";
                        $subjectid=$row1['subject_id'];
                        $subject=mysqli_query($conn,"select * from subject where subject_id='$subjectid'");
                        $subject_name=mysqli_fetch_assoc($subject);
                        echo "<td>";
                        echo $subject_name['subject_abbreviation'];
                        echo "</td>";
                        $facultyid=$row1['faculty_id'];
                        $faculty=mysqli_query($conn,"select * from tprofile where id='$facultyid'");
                        

                        echo "<td>";
                        if(mysqli_num_rows($faculty)!=0){
                            $faculty_name=mysqli_fetch_assoc($faculty);
                            echo $faculty_name['name'];
                        }
                        echo "</td>";
                        echo "</tr>";
                        
                    }
                    ?>
                </table>
                <?php
                }
                ?>
               
                </center>
				
				</div>
</div>
</body>
<?php
if(isset($_POST['timetable_submit'])){
    unset($_POST['timetable_submit']);
    $days=mysqli_query($conn,"select * from days");
    $sessions=mysqli_query($conn,"select * from sessions");
    $period_value=mysqli_fetch_assoc($sessions);
    while($row=mysqli_fetch_assoc($days)){
        for($i=1;$i<=$period_value['session'];$i++){
            
                echo $_POST[$row['name'].$i];
                if($_POST[$row['name'].$i]!='NONE'&&$_POST[$row['name'].$i]!='0'){

                $faculty_subject_class=$_POST[$row['name'].$i];
                $get_faculty_subject_class=mysqli_query($conn,"select * from faculty_subject_class where sno='$faculty_subject_class'");
                $fetch_faculty_subject_class=mysqli_fetch_assoc($get_faculty_subject_class);
                $faculty_id=$fetch_faculty_subject_class['faculty_id'];
                $subject_id=$fetch_faculty_subject_class['subject_id'];
                $class_id=$fetch_faculty_subject_class['class'];
               
                $get_class=mysqli_query($conn,"select * from `class` where sno='$class_id'");
                $fetch_class=mysqli_fetch_assoc($get_class);
                $session_value=$i;
                $year_value=$fetch_class['year'];
                $branch_value=$fetch_class['branch'];
                $section_value=$fetch_class['section'];
                $day_value=$row['name'];
                mysqli_query($conn,"insert into timetable value(null,'$faculty_id','$subject_id','$session_value','$year_value','$branch_value','$section_value','$day_value')");
            }
        }
    }
    echo "<script>window.location.href='timetablec.php';</script>";
    
}
?>
</html>