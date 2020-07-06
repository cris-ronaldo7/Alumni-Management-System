<?php
session_start();
if (!isset($_SESSION['id'])){
	header("location:login.html");
}
else
{
	$userid=$_SESSION['id'];
	$alusername=$_SESSION['alname'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alumni HomePage</title>
<link rel="stylesheet" href="css/alumni_home.css"
<?php
include_once"connect_database.php";
include_once"setting/alumnihome_navigation.php";
?>
</head>

<body>
<br />
<h2>My Profile</h2>
<br />
<table class="alumnihometable1" align="center" cellspacing="15px">
<?php
$sql="SELECT pi_register, pi_name, pi_gender, pi_address, pi_email, pi_session, pi_branch, pi_mobile, pi_picture 
FROM alumniinfo WHERE pi_register='$userid'";
$result=$conn->query($sql);
while($row = $result->fetch_assoc()) 
	{
		echo "<tr>";
		echo "<td colspan=2 align=center><img class=profile src=data:image/jpeg;base64,".base64_encode($row["pi_picture"])." align=center /></td>";
		echo "</tr>";
        echo "<tr>";
		echo "<th>Name:</th>";
		echo "<td class=alumnihometd1>".$row["pi_name"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Registration Number:</th>";
		echo "<td class=alumnihometd1>".$row["pi_register"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Gender:</th>";
		echo "<td class=alumnihometd1>".$row["pi_gender"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Address:</th>";
		echo "<td class=alumnihometd1>".$row["pi_address"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Mobile Number:</th>";
		echo "<td class=alumnihometd1>".$row["pi_mobile"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Email:</th>";
		echo "<td class=alumnihometd1>".$row["pi_email"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Session:</th>";
		echo "<td class=alumnihometd1>".$row["pi_session"]."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Branch:</th>";
		echo "<td class=alumnihometd1>".$row["pi_branch"]."</td>";
		echo "</tr>";
		echo "<tr>";
    }

?>
</table>
<br /><br /><br /><br />
</body>
</html>