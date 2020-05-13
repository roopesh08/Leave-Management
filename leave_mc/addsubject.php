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

<?php
$department='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);
	$result=mysqli_query($conn,"select * from department where id='$id'");
	$row=mysqli_fetch_assoc($result);
	$department=$row['department'];
}
if(isset($_POST['department'])){
	$department=mysqli_real_escape_string($conn,$_POST['department']);
	if($id>0){
		$sql="update department set department='$department' where id='$id'";
	}else{
		$sql="insert into department(department) values('$department')";
	}
	mysqli_query($conn,$sql);
	header('location:view_departments.php');
	die();
}
?>
<html>
<head>
<link rel="stylesheet" href="css/add-subject.css"> 
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
                <div class="heading"><h3>ADD Subject</h3></div>
                    <form method="POST" class='first-select'>
                    <input type='text' name='subjectid' placeholder='SubjectId' required><br>
                    <input type='text' name='subjectname' placeholder='Subject Name' required><br>
                    <input type='text' name='subjectabb' placeholder='Subject Abbreviation' required><br>
					
					
					
                    <select name='year' '>
                    <option>-----SELECT  YEAR-----</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    </select><br>
					
					
                    <select name='branch''>
                    <option>-----SELECT BRANCH-----</option>
                            <?php
                            require 'conn.php';
                            $q=mysqli_query($conn,"select * from department");
                            while($row=mysqli_fetch_assoc($q)){
                                echo "<option >".$row['department']."</option>";
                            }
                            ?>
                    </select><br>
					
					
                    <select name='sem'>
                    <option>-----SELECT SEM-----</option>
                    <option>1</option>
                    <option>2</option>
                    </select><br>
                    <button  type="submit" name="submit">ADD SUBJECT</button>
                    </form>
                        </center>
				</div>
				</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    require 'conn.php';
    $subjectid=$_POST['subjectid'];
    $subjectname=$_POST['subjectname'];
    $subjectabb=$_POST['subjectabb'];
    $year=$_POST['year'];
    $branch=$_POST['branch'];
    $sem=$_POST['sem'];
    if(mysqli_query($conn,"insert into subject values(null,'$subjectid','$subjectname','$subjectabb',$year,'$branch','$sem')")){
        echo "<script>alert('Subject Add Successfully');</script>";
    }else{
        echo "<script>alert('Error while Adding the subject');</script>";
    }


}
?>