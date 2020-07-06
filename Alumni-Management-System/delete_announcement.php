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
<title>Announcement - Delete Announcement </title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/add_forum_post.css"/>
<?php
include_once "setting/adminpage_navigation.php";
include_once "connect_database.php";
?>

</head>
<style>
table, th, td {
    border: 2px solid #050119;
    border-collapse: collapse;
	font-size: 20px;
	width : 900px;
	text-align: center;
}
button.bt1
{
	border-radius:4px;
	font-size:16px;
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
<body>
<br ><br>
<form action="delete_announcement.php" method="post">
<table align="center" style="border:2px hidden;" cellspacing="20">
<caption style= "font-size:30px"> Insert Announcement ID for deletion: </caption>
<tr>
<th align="left" width="250" style="border:hidden;font-size:20px">Announcement ID: </th>
<td width="150" style="border:hidden"><input size="45" type="text" value="" name="annmtid"/></td>
</tr>
</tr>
<td colspan=3 align="right" style="border:hidden;"><button class="bt1" type="submit" name="deleteann" >Delete</button></td>
</tr>
</table>
</form>
<br></br><br></br>
<table align="center">
<caption> Announcement Details: </caption>
<tr>
	<th> NO </th>
	<th> Announcement ID </th>
	<th> Announcement Name </th>
	<th> Announcement Description </th>
	<th> Announcement Time </th>
</tr>

<?php
$sqlshowann= "SELECT * FROM announcement";
$resultannmt = $conn->query($sqlshowann);
$no = 1;

while ($row = mysqli_fetch_assoc($resultannmt))
{
	echo "<tr>";
	echo "<td>" . $no. "</td>";
	echo "<td>" . $row['ann_id']. "</td>";
	echo "<td>" . $row['ann_name']. "</td>";
	echo "<td>" . $row['ann_desc']. "</td>";
	echo "<td>" . $row['ann_time']. "</td>";
	$no++;
}
?>
</table>
<br><br><br>
<?php
if(isset($_POST['deleteann']))
{
	$annmt_id=$_REQUEST['annmtid'];
	
	if ($annmt_id=='')
	{
		echo "<br /><p class=p1>*****Please insert Announcement ID for deletion.*****</p>";
	}
	else
	{
				$sql = "DELETE FROM announcement WHERE ann_id = '$annmt_id'";
				if ($conn->query($sql) === TRUE) 
				{
	    			echo "<br /><p class=p1>*****Announcement Deletion Successfull.*****</p>";
					echo "<br /><p class=p2><a href=announcement.php>View Announcement</a></p>";
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