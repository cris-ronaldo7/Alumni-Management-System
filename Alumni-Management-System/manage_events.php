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
<title>Manage Events</title>

<link rel="stylesheet" href="css/header_navigationbar.css" />

<?php
include_once "setting/adminpage_navigation.php";
include "connect_database.php";
?>
</head>
<body>
<h1> Manage Events </h1>
<form method="post">
<h3> Please enter the following information: </h3>
Event ID: <input type="text" name="event_id"><br>
Event Name: <input type="text" name="event_name"><br>
Event Date: <input type="date" name="event_date" value="dd/mm/yyyy"> <br>
Event Time: <input type="time" name="event_time"> <br>
Event Venue: <input type="text" name="event_venue"> <br>
Event Details: <input type="text" name="event_desc"> <br>
<button type="submit" name="Insert" formaction="manage_events.php"> Submit </button>
</form>

<?php
if(isset($_POST['Insert'])
{
	$event_id=$_REQUEST['event_id'];
	$event_name=$_REQUEST['event_name'];
	$event_date=$_REQUEST['event_date'];
	$event_time=$_REQUEST['event_time'];
	$event_venue=$_REQUEST['event_venue'];
	$event_desc=$_REQUEST['event_desc'];
	
	$sql = "INSERT INTO event (event_id, event_name, event_date, event_time, event_venue, event_desc)
			VALUES (e_id, e_name, e_date, e_time, e_desc, e_venue)";
	
}
$conn->close()
?>

</body>
</html>