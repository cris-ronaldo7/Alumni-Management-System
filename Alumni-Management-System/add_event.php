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
<title>Event - Add Event</title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/add_forum_post.css"/>
<link rel="stylesheet" href="css/event&ann.css">

<?php
include_once "setting/adminpage_navigation.php";
include "connect_database.php";
?>
<style>
input.i2{
padding: 3px 175px;
    font-size: 15px;
}

input.i3{
padding: 3px 204px;
    font-size: 15px;
}
button.bt1
{
	border-radius:4px;
	font-size:16px;
	padding:5px 15px;
	font-weight:bold;
	border:2px;
	background-color:red;
	color:white;
}
button.bt1:hover
{
	background-color:#050119;
	color:white;
}
</style>
</head>
<form action="add_event.php" method="post">
<table width="850" align="center" style="border:2px hidden;" cellspacing="10">
<tr>
<th align="left" width="6000" style="border:hidden;font-size:25px"> Details of the event:</th>
<td></td>
</tr>
<tr>
<th align="left" width="6000" style="border:hidden;font-size:18px">Event ID: </th>
<td width="350" style="border:hidden"><input size="59" type="text" value="" name="eventid"/></td>
</tr>
<tr>
<th align="left" width="300" style="border:hidden;font-size:18px">Event Name:</th>
<td width="350" style="border:hidden"><input type="text" value="" name="eventname" size="59" /></td>
<tr>
<th align="left"  width="300" style="border:hidden;font-size:18px">Event Date: </label></th>
<td width="350" style="border:hidden"><input class="i2" type="date" value="" name="eventdate" size="59"min="2020-06-06"required /></td>
<tr>
<tr>
<th align="left"  width="300" style="border:hidden;font-size:18px">Event Time:</label></th>
<td width="350" style="border:hidden"><input class="i3" type="time" value="" name="eventtime" size="59" /></td>
<tr> 
<tr>
<th align="left"  width="300" style="border:hidden;font-size:18px">Event Description: </label></th>
<td width="350" style="border:hidden"><textarea name="eventdesc" cols="60" rows="6" size="60"></textarea></td>
<tr>
<tr>
<th align="left"  width="300" style="border:hidden;font-size:18px">Event Venue: </label></th>
<td width="350" style="border:hidden"><input type="text" value="" name="eventvenue" size="59" /></td>
<tr>
<tr>
<th align="left"  width="300" style="border:hidden;font-size:18px">Person in charge of the event: </label></th>
<td width="350" style="border:hidden"><input type="text" value="" name="epic" size="59" /></td>
<tr>
<td colspan=2 align="right" style="border:hidden"><button class="bt1" type="submit" name="addEvent" >Add Event</button></td>
</tr>
</table>
</form>

<?php
if(isset($_POST['addEvent']))
{
	$EID=$_REQUEST['eventid'];
	$ENAME=$_REQUEST['eventname'];
	$EDATE=$_REQUEST['eventdate'];
	$ETIME=$_REQUEST['eventtime'];
	$EDESC=$_REQUEST['eventdesc'];
	$EVENUE=$_REQUEST['eventvenue'];
	$EPIC=$_REQUEST['epic'];
	
	if ($EID==''||$ENAME=='' || $EDATE=='' || $ETIME==''|| $EDESC=='' || $EVENUE=='' || $EPIC == '')
	{
		echo "<br /><p class=p1>*****Incomplete information. No Event Created.*****</p>";
	}
	else
	{
				$sql = "INSERT INTO event (e_id, e_name, e_date, e_time, e_desc, e_venue, e_pic) VALUES('$EID', '$ENAME', '$EDATE', '$ETIME', '$EDESC', '$EVENUE', '$EPIC')";
				if ($conn->query($sql) === TRUE) 
				{
	    			echo "<br /><p class=p1>*****Event successfully created.*****</p>";
					echo "<br /><p class=p2><a href=events.php>Go to Event</a></p>";
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