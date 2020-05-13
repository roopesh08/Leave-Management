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
<link rel="stylesheet" href="css/facutaly-assgin.css"> 
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
                    <center>
				<div class="heading"><h3>Map Faculty Class Subject</h3></div>
                    <form method="post" class="first-select">
                    <input type='text' name='facultyid' placeholder='FacultyId' required><br>
                    <input type='text' name='subjectid' placeholder='SubjectId' required><br>
                    <select name='year'>
                    <option>------SELECT  YEAR------</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    </select><br>
                    <select name='branch'>
                    <option>------SELECT BRANCH------</option>
                            <?php
                            require 'conn.php';
                            $q=mysqli_query($conn,"select * from department");
                            while($row=mysqli_fetch_assoc($q)){
                                echo "<option>".$row['department']."</option>";
                            }
                            ?>
                    </select><br>
                    <select name='section'>
                    <option>-----SELECT  SECTION-----</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    </select><br>
                    <button  type="submit" name="submit">MAP</button>
                    </form>
                </div>
                </center>
				</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $facultyid=$_POST['facultyid'];
    $subjectid=$_POST['subjectid'];
    $year=$_POST['year'];
    $branch=$_POST['branch'];
    $section=$_POST['section'];
    $faculty=mysqli_query($conn,"select * from tprofile where id='$facultyid'");
    $faculty_exist=mysqli_num_rows($faculty);
    if($faculty_exist==0){
        echo "<script>alert('Invalid Faculty Id. Please Enter the Valid Details...');</script>";
        unset($_POST['submit']);
        echo "<script>window.location.href='map_faculty_class_subject.php';</script>";
    }
    $subject=mysqli_query($conn,"select * from subject where `subject_id`='$subjectid'");
    $subject_exist=mysqli_num_rows($subject);
    if($subject_exist==0){
        echo "<script>alert('Invalid Subject Id. Please Enter the Valid Details...');</script>";
        unset($_POST['submit']);
        echo "<script>window.location.href='map_faculty_class_subject.php';</script>";
    }
    $class=mysqli_query($conn,"select * from class where `year`=$year and `branch`='$branch' and `section`='$section'");
    $class_exit=mysqli_num_rows($class);
    if($class_exit==0){
        echo "<script>alert('Invalid Class. Please Enter the Valid Details...');</script>";
        unset($_POST['submit']);
        echo "<script>window.location.href='map_faculty_class_subject.php';</script>";
    }else{
        $row=mysqli_fetch_assoc($class);
        $c=$row['sno'];
        if(mysqli_query($conn,"insert into `faculty_subject_class` values(null,'$facultyid','$subjectid','$c')")){
            echo "<script>alert('Teacher Class Subject Mapped Successfully');</script>";
        }else{
            echo "<script>alert('Error while Mapping');</script>";
        }
    }
}
?>