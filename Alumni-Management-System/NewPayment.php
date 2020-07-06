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
<title>Financial Record - New Payment</title>

<link rel="stylesheet" href="css/header_navigationbar.css" />
<link rel="stylesheet" href="css/add_forum_post.css"/>

<?php
include_once "setting/adminpage_navigation.php";
include_once "connect_database.php";
?>

</head>
<style>
.dropbtn {
    background-color: cornsilk;
    color: #050119;
    padding: 5px 116px;
    font-size: 15px;
	border: 2px solid #050119;
    cursor: pointer;
}

input.i1{
padding: 3px 119px;
    font-size: 15px;
}
	
</style>
<body>
<form action="NewPayment.php" method="post">
<table width="710" align="center" style="border:2px hidden;" cellspacing="20">
<tr>
<th align="left" width="450" style="border:hidden;font-size:25px"> Details of Payment: </th>
<td> </td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Payment ID: </th>
<td width="450" style="border:hidden"><input size="45" type="text" value="" name="pid"/></td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Alumni Registration Number: </th>
<td width="450" style="border:hidden"><input size="45" type="text" value="" name="aid"/></td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Payment Purpose </th>
<td width="450" style="border:hidden">
		<select class="dropbtn" name="pp" >
            <option value="Yearly Membership">Yearly Membership</option>
            <option value="Life-time Membership"> Life-time Membership</option>
			<option value="Cash Donation">Cash Donation</option>
			<option value="Registration Fee"> Registration Fee </option>
			</td>
</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Payment Date: </th>
<td width="450" style="border:hidden">
<input class="i1" type="date" name="pd" max="2020-06-08"required /></td>

</tr>
<tr>
<th align="left" width="450" style="border:hidden;font-size:18px">Payment Amount: </th>
<td width="450" style="border:hidden"><input size="45" type="text" value="" name="pa"></td>
</tr>
<td colspan=2 align="right" style="border:hidden"><button type="submit" name="addpayment" >Add Payment</button></td>
</tr>
</table>
</form>
<?php
if(isset($_POST['addpayment']))
{
	$paymentid=$_REQUEST['pid'];
	$paymentpurpose=$_REQUEST['pp'];
	$paymentdate=$_REQUEST['pd'];
	$paymentpaid=$_REQUEST['pa'];
	$alid=$_REQUEST['aid'];
	
	if ($paymentid=='' || $paymentpurpose=='' || $paymentdate==''|| $paymentpaid=='' || $alid=='')
	{
		echo "<br /><p class=p1>*****Incomplete information. No payment inserted.*****</p>";
	}
	else
	{
		$sql1 = "INSERT INTO financialdata (payment_id, total_payment, payment_purpose, payment_date, pi_register) VALUES('$paymentid', '$paymentpaid', '$paymentpurpose', '$paymentdate', '$alid')";

		if ($conn->query($sql1) === TRUE) 
		{
	    	echo "<br /><p class=p1>*****Payment successfully inserted.*****</p>";
			echo "<br /><p class=p2><a href=Financial_Record.php>Go to Financial Record</a></p>";
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