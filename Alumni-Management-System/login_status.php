<?php
include_once"connect_database.php";

if(isset($_POST['login']))
{
 // Grab User submitted information
	$luserid = $_REQUEST["login_userid"];
	$lpassword = $_REQUEST["login_password"];
	$lusertype = $_POST["login_usertype"];
	

	if($lusertype=="alumni")
	{
		$al_result="SELECT * from alumnimember where 
		pi_register='$luserid' AND al_password='$lpassword'";
		$al_count=$conn->query($al_result);
		$al_result1="SELECT alumniinfo.pi_name FROM alumnimember, alumniinfo 
		WHERE  alumniinfo.pi_register='$luserid'";
		$al_count1=$conn->query($al_result1);
		if ($al_count->num_rows > 0) 
		{
			while($al_row = $al_count->fetch_assoc()) 
			{

				$al_status=$al_row['al_status'];
				if($al_status=="Not Approve")
				{
					echo "<br /><br />Login failed. <br /><br />Please contact our administrator to check your registration status.<br /><br />";
					header("refresh:3;url=index.php");
				}
				else
				{
					if ($al_count1->num_rows > 0)
					{
					while($al_row1 = $al_count1->fetch_assoc()) 
						{
							session_start();
							$_SESSION['id']=$al_row['pi_register'];
							$_SESSION['alname']=$al_row1['pi_name'];
							header("location:alumni_home.php");
						}
					}
   				}
			}
		}
		else
			{
				$al_message="Sorry Invalid Password or UserID. Please Try Again.";
				echo $al_message; 
				header("refresh:5;url=index.php");
			}
		
	}
	else
	{
		$sql2= "SELECT * from adminmember where ad_id='$luserid' AND ad_password='$lpassword'";
		$result2=$conn->query($sql2);
		if ($result2->num_rows > 0) 
		{	
			while($row = $result2->fetch_assoc()) 
			{
   				session_start();
				  $_SESSION['id']=$row['ad_id'];
				  $_SESSION['adname']=$row['ad_fullname'];
				header("location:admin_homepage.php");
   			}
		}
		else
		{
			$ad_message=  "<script language=javascript>alert(\"Sorry Invalid Password And User Name Please Try Again.\");</script>"; 
			echo $ad_message; 
			header("refresh:5;url=index.php");
		}
		$conn->close();
		}
	}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Status</title>
</head>
<link rel="stylesheet" href="css/registration_login_status.css" />

<body>

</body>
</html>