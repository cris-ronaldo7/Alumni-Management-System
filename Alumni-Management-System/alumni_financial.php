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
<title>My Financial Record</title>
<link rel="stylesheet" href="css/alumni_financial.css"
<?php
include_once"connect_database.php";
include_once"setting/alumnihome_navigation.php";
?>
</head>

<body>
<div>
<br />
<h2>Financial Record</h2>
<br />
<form method="post">
<table class="alumnifinancialtable" align="center" cellspacing="15px">
<?php
	$sql="SELECT * FROM financialdata where pi_register='$userid'";
	$result=$conn->query($sql);
	echo "<tr>";
	echo "<th>Payment ID</th>";
	echo "<th>Payment Purpose</th>";
	echo "<th>Total Payment</th>";
	echo "<th>Payment Date</th>";
	echo "</tr>";
	if(isset($_POST['sort']))
	{
		$sql="SELECT * FROM financialdata where pi_register='$userid' ORDER BY payment_purpose ASC";
		$result=$conn->query($sql);
		while($row = $result->fetch_assoc())
		{
			echo "<tr>";
			echo "<td class=alumnifinancialtd>".$row['payment_id']."</td>";
			echo "<td class=alumnifinancialtd>".$row['payment_purpose']."</td>";
			echo "<td class=alumnifinancialtd>".$row['total_payment']."</td>";
			echo "<td class=alumnifinancialtd>".$row['payment_date']."</td>";
			echo "</tr>";
		}
	}
	else if(isset($_POST['unsort']))
	{
		while($row = $result->fetch_assoc())
		{
			echo "<tr>";
			echo "<td class=alumnifinancialtd>".$row['payment_id']."</td>";
			echo "<td class=alumnifinancialtd>".$row['payment_purpose']."</td>";
			echo "<td class=alumnifinancialtd>".$row['total_payment']."</td>";
			echo "<td class=alumnifinancialtd>".$row['payment_date']."</td>";
			echo "</tr>";
		}
	}
	else
	{
		while($row = $result->fetch_assoc())
		{
			echo "<tr>";
			echo "<td class=alumnifinancialtd>".$row['payment_id']."</td>";
			echo "<td class=alumnifinancialtd>".$row['payment_purpose']."</td>";
			echo "<td class=alumnifinancialtd>".$row['total_payment']."</td>";
			echo "<td class=alumnifinancialtd>".$row['payment_date']."</td>";
			echo "</tr>";
		}
	}
?>
<tr>
	<td align="right" colspan="4">
    	<br /><button class="alumnifinancialbt" type="submit" name="unsort">Unsort</button>&nbsp;&nbsp;&nbsp;
		<button class="alumnifinancialbt" type="submit" name="sort">Sort by Payment Purpose</button><br /> 
	</td>
</tr>
</table>
</form>
</div>
<br /><br /><br /><br />
</body>
</html>