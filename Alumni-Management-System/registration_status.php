<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Success Registration</title>
</head>

<link rel="stylesheet" href="css/registration_login_status.css" />

<body>
<?php
include_once"connect_database.php"
?>

<?php
if(isset($_REQUEST['register']))
{
	$name=$_REQUEST['pi_name'];
	$gender=$_REQUEST['pi_gender'];
	$registration=$_REQUEST['pi_register'];
	$branch=$_REQUEST['pi_branch'];
	$sessiona=$_REQUEST['pi_session'];
	$email=$_REQUEST['pi_email'];
	$mobile=$_REQUEST['pi_mobile'];
	$password=$_REQUEST['pi_password'];
	
	
	if ($name=='' || $gender=='' || $registration==""|| $branch=='' || $sessiona=="" || $password=="")
	{
		echo "<br><br>";
		echo "Incomplete information. Please try again.";
		echo "<br/><br/>"; 
		echo "Redirecting you back to main page in 10 seconds.";
		echo "<br/><br/>"; 
		echo "Or click <a href=index.php>here.</a>";
		header("refresh:10;url=index.php" );
	}
	else
	{
		$al_status="Not Approve";
		$register_sql = "INSERT INTO alumnimember (pi_register, al_password, al_status) 
		VALUES ('$registration', '$password', '$al_status')";

		if ($conn->query($register_sql) === TRUE) 
		{
			$register_sql = "INSERT INTO alumniinfo (pi_name,pi_gender,pi_register,pi_branch,pi_session,pi_email,pi_mobile) 
			VALUES ('$name', '$gender', '$registration','$branch', '$sessiona','$email', '$mobile')";
			$conn->query($register_sql);
	    	echo "<br><br>";
			echo "Registration successful. ";
			echo "<br/><br/>"; 
			echo "Redirecting you to login page in 5 seconds.";
			echo "<br/><br/>"; 
			echo "Or click <a href=login.html>here.</a>";
			header("refresh:5;url=login.html" );
		} 
		else 
		{
    		echo "Error: " . $register_sql . "<br>" . $conn->error;
			header("refresh:10;url=register.html" );
		}
	}
}
?>
</body>
</html>