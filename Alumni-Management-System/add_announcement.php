<?php
session_start();
if (!isset($_SESSION['id'])){
	header("location:login.html");
}
else
{
	$userid=$_SESSION['id'];
	$username1=$_SESSION['adname'];
}
?>

<!DOCTYPE html> 
<html>
<head>
<title>Announcement - Add Announcement </title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/add_forum_post.css"/>

<?php
include_once "setting/adminpage_navigation.php";
include_once "connect_database.php";
?>
<style>
button.bt1
{
	border-radius:4px;
	font-size:15px;
	padding:5px 15px;
	font-weight:bold;
	border:2px;
	background-color:#050119;
	color:white;
}
button.bt1:hover
{
	background-color:red;
	color:white;
}
</style>
</head>
<body>
<form action="add_announcement.php" method="post">
<table width="910" align="center" style="border:2px hidden;" cellspacing="20">
<tr>
<th align="left" width="450" style="border:hidden;font-size:25px"> Details of the Announcement:</th>
<td> </td>
</tr>
<tr>
<th align="left" width="350" style="border:hidden;font-size:18px">Announcement ID: </th>
<td width="450" style="border:hidden"><input size="59" type="text" value="" name="aid"/></td>
</tr>
<tr>
<th align="left" width="350" style="border:hidden;font-size:18px">Announcement Name: </th>
<td width="450" style="border:hidden"><input type="text" value="" name="aname" size="59" /></td>
<tr>
<th align="left"  width="350" style="border:hidden;font-size:18px">Announcement Description: </label></th>
<td width="450" style="border:hidden"><textarea name="adesc" cols="60" rows="6" size="60"></textarea></td>
<tr>
<td colspan=2 align="right" style="border:hidden"><button class="bt1" type="submit" name="addann" >Add Announcement</button></td>
</tr>
</table>
</form>

<?php
if(isset($_POST['addann']))
{
	$annid=$_REQUEST['aid'];
	$annname=$_REQUEST['aname'];
	$anndesc=$_REQUEST['adesc'];
	date_default_timezone_set("Asia/Kolkata");
	$anntime=date("Y/m/d h:i:sa");
	
	if ($annid=='' || $annname=='' || $anndesc=='')
	{
		echo "<br /><p class=p1>*****Incomplete information. No announcement created.*****</p>";
	}
	else
	{
				$sql = "INSERT INTO announcement (ann_id, ann_name, ann_desc, ann_time) VALUES('$annid', '$annname', '$anndesc', '$anntime')";
				if ($conn->query($sql) === TRUE) 
				{
	    			echo "<br /><p class=p1>*****Topic successfully created.*****</p>";
					echo "<br /><p class=p2><a href=announcement.php>Go to Announcement</a></p>";
				} 
				else 
				{
    				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		
	}	
}
?>
</body>
</html>