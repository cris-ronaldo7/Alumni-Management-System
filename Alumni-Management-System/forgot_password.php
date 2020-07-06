<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/forgot_password.css" />
<title>Forgot Password</title>
<?php 
include_once"connect_database.php";
?>
</head>

<body>
<div class="forgot_wrapper">
	<div class="forgot_container">
		<h1>Retrieve Password</h1>
		<form class="forgot_form" method="post">
			<input type="text" placeholder="Registration Number" name="forgot_userid">
			<input type="text" placeholder="Email" name="forgot_password">
			<button type="submit" name="retrieve">Retrieve Password</button>
            <br /><br /><a href="index.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="login.html">Login</a>
		</form>
	</div>
</body>

<?php
if(isset($_POST['retrieve']))
{
	$id=$_POST['forgot_userid'];
	$email=$_POST['forgot_password'];
	$sql = "SELECT pi_register FROM alumniinfo WHERE pi_register='$id' AND pi_email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
	while($row = $result->fetch_assoc()) 
	{
		$temp=$row['pi_register'];
		$sql2 = "SELECT al_password FROM alumnimember WHERE pi_register='$temp'";
		$result2=$conn->query($sql2);
		while($row = $result2->fetch_assoc()) 
		{
			echo "<script>alert('Your password is: ".$row["al_password"]."')</script>";
		}
	}
	}
	else
	{
		echo "<script>alert('ERROR: Please mail our administrator help_admin@techno.com to retrieve your password.')</script>";
	}
}
?>
</html>