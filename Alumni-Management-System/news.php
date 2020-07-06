<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>News</title>
<link rel="stylesheet" href="css/n3.css" />
<?php
include_once"connect_database.php";
include_once"setting/news_navigation.php";
?>
</head>

<body >
<div id="announcements">
<p class="np1">Announcements</p>
<table class="tb1" cellspacing="15" align="center">
<?php
	echo "<tr>
	<th class=nth1>ANNOUNCEMENTS</th>
	<th class=nth1>DESCRIPTION</th>
	<th class=nth1>TIME</th></tr>";
	$sql = "SELECT * FROM announcement ORDER BY ann_time";
	$result = $conn->query($sql);
	if($result==true)
	{
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr>";
			echo "<td class=ntd1>".$row["ann_name"]."</td>
				<td class=ntd1>".$row["ann_desc"]."</td>
				<td class=ntd1>".$row["ann_time"]."</td>";
			echo "</tr>";
		}
	}
	else
	{
		echo "<p>No events</p>";	
	}
?>
</table>
</div>
<br><br><br>
<br /><hr color="#050119" size="4"/>

<div id="events">
<p class="np1">Events</p>
<br />
<?php
	$sql2 = "SELECT * FROM event ORDER BY e_date, e_time";
	$result2 = $conn->query($sql2);
	
	if($result2==true)
	{
		echo "<table class=tb1 align=center cellspacing=10>";
		echo "<tr><th class=nth1>EVENT</th>
		<th class=nth1>DATE</th>
		<th class=nth1>TIME</th>
		<th class=nth1>VENUE</th>
		<th class=nth1>DESCRIPTION</th></tr>";
		while($row =$result2->fetch_assoc()){
			echo "<tr>";
			echo "<td class=ntd1>".$row["e_name"]."</td>
					<td class=ntd1>".$row["e_date"]."</td>
					<td class=ntd1>".$row["e_time"]."</td>
					<td class=ntd1>".$row["e_venue"]."</td>
					<td class=ntd1>".$row["e_desc"]."</td>";
			echo "<tr>";
		}
		echo "</table>";
	}
	else
	{
		echo "<p>No events</p>";	
	}
?>
</div>

<br><br><br><br><br />
</body>
</html>