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
<link rel="stylesheet" href="css/manual-timetable.css"> 
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
                <button  class='manual' onclick='window.location.href="timetable.php"'><h2>Manual</h2></button>
                <!-- <button style='margin:10px' onclick='window.location.href="timetablef.php"'><h2>Through Faculty</h2></button> -->
                <button class='through-class' onclick='window.location.href="timetablec.php"'><h2>Through Class</h2></button>
                <form method="POST" class="first-select">
                <table>
                    <tr>
                        <td class='name'>Faculty Id</td>
                        <td class='inp'><input type='text' name='faculty_id'></td>
                    </tr>
                    <tr>
                        <td class='name'>Subject Id</td>
                        <td class='inp'><input type='text' name='subject_id'></></td>
                    </tr>
                    <tr>
                        <td class='name'>Year</td>
                        <td>
                            <select class= name='year'>
                                <option>----SELECT----</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class='name'>Branch</td>
                        <td>
                            <select name='branch'>
                            <option>----SELECT----</option>
                            <?php
                            require 'conn.php';
                            $q=mysqli_query($conn,"select * from department");
                            while($row=mysqli_fetch_assoc($q)){
                                echo "<option >".$row['department']."</option>";
                            }
                            ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class='name'>Section</td>
                        <td>
                            <select name='section'>
                                <option>----SELECT----</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class='name'>Period</td>
                        <td>
                            <select name='period'>
                                <option>----SELECT----</option>
                                <?php
                                require 'conn.php';
                                $q_period=mysqli_query($conn,"select * from sessions");
                                $row=mysqli_fetch_assoc($q_period);
                                for($i=1;$i<=$row['session'];$i++){
                                    echo "<option>".$i."</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td  class='name'>Day</td>
                        <td>
                            <select name='day'>
                                <option>----SELECT----</option>
                                <option>Monday</option>
                                <option>Tuesday</option>
                                <option>Wednesday</option>
                                <option>Thrusday</option>
                                <option>Friday</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type='submit' class='first-btn' name='submit' >
                </form>
                </center>
				
				</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    require 'conn.php';
    $faculty_id=$_POST['faculty_id'];
    $subject_id=$_POST['subject_id'];
    $year=$_POST['year'];
    $branch=$_POST['branch'];
    $section=$_POST['section'];
    $period=$_POST['period'];
    $day=$_POST['day'];
    $faculty=mysqli_query($conn,"select * from tprofile where id='$faculty_id'");
    $faculty_exist=mysqli_num_rows($faculty);
    if($faculty_exist==0){
        echo "<script>alert('Invalid Faculty Id. Please Enter the Valid Details...');</script>";
        unset($_POST['submit']);
        echo "<script>window.location.href='timetable.php';</script>";
    }
    $subject=mysqli_query($conn,"select * from subject where `subject_id`='$subject_id'");
    $subject_exist=mysqli_num_rows($subject);
    if($subject_exist==0){
        echo "<script>alert('Invalid Subject Id. Please Enter the Valid Details...');</script>";
        unset($_POST['submit']);
        echo "<script>window.location.href='timetable.php';</script>";
    }
    $class=mysqli_query($conn,"select * from class where `year`=$year and `branch`='$branch' and `section`='$section'");
    $class_exit=mysqli_num_rows($class);
    if($class_exit==0){
        echo "<script>alert('Invalid Class. Please Enter the Valid Details...');</script>";
        unset($_POST['submit']);
        echo "<script>window.location.href='timetable.php';</script>";
    }
    if(mysqli_query($conn,"insert into timetable values(null,'$faculty_id','$subject_id',$period,$year,'$branch','$section','$day')")){
        echo "<script>alert('Break Session Updated Successfully');</script>";
    }else{
        echo "<script>alert('Break Session ');</script>";
    }
}
?>