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
<title>Announcement </title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/event&ann.css" />

<?php
include_once "setting/adminpage_navigation.php";
include_once "connect_database.php";
?>

</head>
<body>
<div align="center">
<br><br><br><br>
<?php
	$sql = "SELECT * FROM announcement ";
	$result = $conn->query($sql);
	$sql2 ="SELECT ann_name FROM announcement";
	$result2 = $conn->query($sql2);
	$rowcount=mysqli_num_rows($result2);
	$r=0;
	echo "<table class=tb1 cellspacing=10>";
	echo "<th class=th1>Announcement</th>";
	while($row = mysqli_fetch_assoc($result)) 
	{
        echo "<tr>";
		echo "<td class=td1><span class=sp3>".$row["ann_name"]."</span>";
		echo "<br /><span class=sp2>".$row["ann_desc"]."</span>";
		echo "<br /><br /><span class=sp1>Announcement Time: ".$row["ann_time"]." </span>";
		echo "<hr class=line>";
		echo "</td></tr>";
    }
    echo "</table><br /><br />";
	echo "<a href=add_announcement.php> Add Announcement </a> &nbsp;&nbsp;&nbsp; <a href=delete_announcement.php> Delete Announcement </a>";
?>
</div>
<br><br><br><br>
</body>

</html>