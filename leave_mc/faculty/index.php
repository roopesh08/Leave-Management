<?php
session_start();
include_once 'conn.php';
if(isset($_SESSION['user'])!="" )
{
 header("Location: teacherhome.php");
}
?>
<?php
$msg="";
if(isset($_POST['email']) && isset($_POST['pass']))
{
$email=mysqli_real_escape_string($conn,$_POST['email']);
$pass=mysqli_real_escape_string($conn,$_POST['pass']);
$res=mysqli_query($conn,"SELECT * from tprofile where  email='$email' and pass='$pass'");
$count=mysqli_num_rows($res);
if($count>0)
{
$row=mysqli_fetch_assoc($res);
$_SESSION['user']=$row['user_id'];
$_SESSION['role']=$row['role'];
header("location:teacherhome.php");
}
else
{
	 $msg="please enter correct details";
}
}
?>
<head>
<title>TEACHER LOGIN</title>
<style>
body{
	padding:0px;
	margin:0px;
}
.back{
	width:700px;
	height:500px;
	margin:80px;
	padding-right:60px;
	float:right;
	margin-bottom:20px;
}
.total
{
	margin:20px;
	border:6px solid;
	box-shadow:0 5px 25px rgba(0,0,0.5);
	border-radius:10px;
	padding:40px;
	width:350px;
	position:absolute;
	top:45%;
	left:60%;
	transform:translate(-50%,-50%);
}
.total h2
{
	font-family:'Montserrat',sans-serif;
	color:black;
	font-size:40px;
	border-bottom:6px solid #4caf50;
	margin-bottom:40px;
	padding:10px;
	padding-bottom:20px;
}
.inside
{
	width:100%;
	overflow:hidden;
	font-size:20px;
	padding:10px 0;
	margin:10px 0;
	border-bottom:2px solid #4caf50;
}
.inside input
{
	border:none;
	outline:none;
	background:none;
	color:black;
	font-size:18px;
	width:80%;
	float:left;
	margin:0 10px;
}
.total button
{
	outline:none;
	background:black;
	width:100%;
	background:none;
	border-radius:10px;
	border:2px solid #4caf50;
	color:black;
	padding:10px;
	font-size:22px;
	cursor:pointer;
	margin:12px 0;
	font-family:'Montserrat',sans-serif;
	font-weight:bold;
}
.ar 
{
	outline:none;
	padding:10px;
	float:center;
	width:100px;
	height:20px;
}
.ar a
{
	color:black;
	font-family:consolas;
	font-weight:bold;
	font-size:20px;
	text-decoration:none;
}
.login
{
	border:2px solid green;
	float:left;
	background-color:#4caf50;
	width:20%;
	height:100%;
}
.logini
{
	margin-top:80%;
	color:#4caf50;
}
.arch a
{
	margin:33px;
	color:black;
	font-size:20px;
	outline:none;
	padding:10px;
	text-decoration:none;
	font-family:consolas;
}
.arch
{
	border:2px solid green;
	background-color:#eee;
	width:91%;
	padding:10px;
}
</style>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<div class="login">
	<div class="logini">
		<div class="arch">
		<a href="../index.php">CAMPUS LOGIN</a>
		</div>
	</div>
</div>
<center>
<div class="back">
<div class="total">
<h2>TEACHER LOGIN</h2>
<form  method="post">
<div class="inside">
<input type="text" name="email" placeholder="Your Email" required id="text"/>
</div>
<div class="inside">
<input type="password" name="pass" placeholder="Your Password" required />
</div>
<button input type="submit">LOGIN </button>
<div class="ar">
<?php echo $msg ?>
</div>


</form>
</div>
</div>
</center>
</body>
</html>