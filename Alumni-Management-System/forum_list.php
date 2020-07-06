<?php
session_start();
if (!isset($_SESSION['id'])){
	header("location:login.html");
}
else
{
	$userid=$_SESSION['id'];
	$username1=$_SESSION['adname'];
	$alusername=$_SESSION['alname'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/forum_list.css" /
<title>E-Forum</title>
<?php 
include_once"connect_database.php";
if (strchr("$userid","AD")==true)
	{
		include_once"setting/adminforumlist_navigation.php";
	}
	else
	{	
		include_once"setting/alumniforumlist_navigation.php";
	}
?>
</head>

<body>
<br /><br /><br />
<div align="center">
<table cellspacing="10" class="tb1">
<th class="th1" >E-FORUM</th>
<?php
	$sql = "SELECT * FROM forumdata";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) 
	{
        echo "<tr>";
		echo "<td class=td1><span class=sp3>#".$row["eforum_id"]."&nbsp;".$row["eforum_title"]."</span>";
		echo "<br /><br /><span class=sp2>".$row["eforum_content"]."</span>";
		echo "<br /><br /><span class=sp1>Tags: ".$row["eforum_tags"]." | Author: ".$row["eforum_author"]." | Time: ".$row["eforum_time"]."</span></td></tr>";
		echo "<tr><td class=td3><br /> | <a class=a1 href=#replyhere>reply</a> | <td></tr>";
    }
?>
</table><br /><br />
<hr style="padding:1px" color="sienna">
<div id="replyhere">
<form method="post" action="forum_list.php">
<table class="tb1" cellspacing="10px" style="border:hidden;border-radius:2px;border-color:sienna" width="500px">
<tr>
<th colspan="2" align="center" style="font-size:26px;text-decoration:underline">Reply:</th>
</tr>
<tr>
<td style="border:hidden;font-size:16px;font-weight:bold" width="150">Forum ID: </td>
<td style="border:hidden"><input class="i2" type="text" name="id" size="50" placeholder="eg: 1" value=""/><br /></td>
</tr>
<tr>
<td style="border:hidden;font-size:16px;font-weight:bold" width="150">Reply:</td>
<td style="border:hidden"><textarea class="ta1" type="text" name="replymessage" rows="5" cols="40"></textarea></td>
</tr>
<br />
<tr>
<td colspan="2" align="right"><button type="submit" name="replypost" class="bt1" >reply</button></td>
</tr>
</table>
</form>
</div>
<br />
<hr style="padding:1px" color="#050119">
<br />
<?php
if(isset($_POST['replypost']))
{
	$fid = $_REQUEST['id'];
	$freply = $_REQUEST['replymessage'];
	$userid=$_SESSION['id'];
	date_default_timezone_set("Asia/Kolkata");
	$ftime = date("Y/m/d h:i:sa");
	if($fid == "" || $freply=="")
	{
		echo "<script>alert('Incomplete information. No reply made. Please ensure no field is left blank.);</script>";
	}
	else
	{
		$sql2="SELECT pi_name FROM alumniinfo WHERE pi_register='".$userid."'";
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) 
		{
			while($row2 = $result2->fetch_assoc()) 
			{
				$fname=$row2['pi_name'];
				$sql3 = "SELECT eforum_title FROM forumdata WHERE eforum_id=$fid";
				$result3 = $conn->query($sql3);
				while($row3 = $result3->fetch_assoc()) 
				{
					$ftopic=$row3['eforum_title'];
				}	
				$sql4 ="INSERT INTO forum_reply (forum_topic, forum_message, forum_reply_name, forum_reply_time)
				 VALUES ('".$ftopic."','".$freply."', '".$fname."', '".$ftime."')";
				$result4 = $conn->query($sql4);
				if ($result4 = true) 
				{
		  			echo "<script>alert('Reply successfull.');</script>";
					echo "<br>";
				} 
				else 
				{
			    	echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
		else
		{
			$getauthor1="SELECT ad_fullname FROM adminmember WHERE ad_id='$userid'";
			$result1=$conn->query($getauthor1);
			while($row = $result1->fetch_assoc())
			{
					$fname=$row["ad_fullname"];
					$sql3 = "SELECT eforum_title FROM forumdata WHERE eforum_id=$fid";
					$result3 = $conn->query($sql3);
					while($row3 = $result3->fetch_assoc()) 
					{
						$ftopic=$row3['eforum_title'];
					}	
					$sql4 ="INSERT INTO forum_reply (forum_topic, forum_message, forum_reply_name, forum_reply_time)
					 VALUES ('".$ftopic."','".$freply."', '".$fname."', '".$ftime."')";
					$result4 = $conn->query($sql4);
					if ($result4 == true) 
					{
			  			echo "<script>alert('Reply successfull.');</script>";
						echo "<br>";
					} 
					else 
					{
				    	echo "Error: " . $sql . "<br>" . $conn->error;
					}
			}
		}	
	}
}
?>	
</body>
</html>