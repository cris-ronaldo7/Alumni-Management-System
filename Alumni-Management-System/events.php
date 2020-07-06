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
<title>Events</title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/event&ann.css" />

<?php
include_once "setting/adminpage_navigation.php";
include_once "connect_database.php";
?>

</head>

<body>
<div align="center">
<br><br><br>
<?php
	$sql = "SELECT * FROM event ";
	$result = $conn->query($sql);
	$sql2 ="SELECT e_name FROM event";
	$result2 = $conn->query($sql2);
	$rowcount=mysqli_num_rows($result2);
	$r=0;
	echo "<table class=tb1 cellspacing=10>";
	echo "<th class=th1>Events</th>";
	while($row = mysqli_fetch_assoc($result)) 
	{
        echo "<tr>";
		echo "<td class=td1><span class=sp3>".$row["e_name"]."</span>";
		echo "<br /><span class=sp2>".$row["e_desc"]."</span>";
		echo "<br /><br /><span class=sp1>Event date: ".$row["e_date"]." | Event Time: ".$row["e_time"]." </span>";
		echo "<br /><br /><span class=sp1>Event Venue: ".$row["e_venue"]." </span>";
		echo "<br /><br /><span class=sp1>Person in charge: ".$row["e_pic"]." </span>";
		echo "<hr class=line>";
		echo "</td></tr>";
    }
    echo "</table><br /><br />";
	echo "<a href=add_event.php> Add Event </a> &nbsp;&nbsp;&nbsp; <a href=delete_events.php> Delete Event </a>";
?>
</div>
<br><br><br>
</body>

</html>