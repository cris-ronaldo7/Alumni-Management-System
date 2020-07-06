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
<title>Events - Delete Event</title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/add_forum_post.css"/>
<?php
include_once "setting/adminpage_navigation.php";
include_once "connect_database.php";
?>

</head>
<style>
table, th, td {
    border: 2px solid saddlebrown;
    border-collapse: collapse;
	font-size: 20px;
	text-align: center;
}
button.bt1
{
	border-radius:4px;
	font-size:16px;
	padding:5px 15px;
	font-weight:bold;
	border:2px;
	background-color:burlywood;
	color:saddlebrown;
}
button.bt1:hover
{
	background-color:sienna;
	color:navajowhite;
}
</style>
<body>
<form action="delete_events.php" method="post">
<table align="center" style="border:2px hidden;" cellspacing="20">
<caption style= "font-size:30px"> Insert Event ID for deletion: </caption>
<tr>
<th align="left" width="250" style="border:hidden;font-size:20px">Event ID: </th>
<td width="150" style="border:hidden"><input size="45" type="text" value="" name="evid"/></td>
</tr>
</tr>
<td colspan=3 align="right" style="border:hidden;"><button class="bt1" type="submit" name="deleteevent" >Delete</button></td>
</tr>
</table>
</form>
<br></br><br></br>
<table align="center">
<caption> Event Details: </caption>
<tr>
	<th> NO </th>
	<th> Event ID </th>
	<th> Event Name </th>
	<th> Event Date </th>
	<th> Event Time </th>
	<th> Event Description </th>
	<th> Event Venue </th>
	<th> Person in Charge </th>
</tr>

<?php
$sqlshowev= "SELECT * FROM event";
$resultev = $conn->query($sqlshowev);
$no = 1;

while ($row = mysqli_fetch_assoc($resultev))
{
	echo "<tr>";
	echo "<td>" . $no. "</td>";
	echo "<td>" . $row['e_id']. "</td>";
	echo "<td>" . $row['e_name']. "</td>";
	echo "<td>" . $row['e_date']. "</td>";
	echo "<td>" . $row['e_time']. "</td>";
	echo "<td>" . $row['e_desc']. "</td>";
	echo "<td>" . $row['e_venue']. "</td>";
	echo "<td>" . $row['e_pic']. "</td>";
	$no++;
}
?>

<?php
if(isset($_POST['deleteevent']))
{
	$ev_id=$_REQUEST['evid'];
	
	if ($ev_id=='')
	{
		echo "<br /><p class=p1>*****Please insert Event ID for deletion.*****</p>";
	}
	else
	{
				$sql = "DELETE FROM event WHERE e_id = '$ev_id'";
				if ($conn->query($sql) === TRUE) 
				{
	    			echo "<br /><p class=p1>*****Event Deletion Successful.*****</p>";
					echo "<br /><p class=p2><a href=events.php>View Events</a></p>";
				} 
				else 
				{
    				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		
	}	
}
?>
</body>
<script>

</script>
</html>