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
<title>My Forum Post</title>
<link rel="stylesheet" href="css/alumni_mypostreply.css" />
<?php
include_once"connect_database.php";
include_once"setting/mypostreply_navigation.php";
?>
</head>

<body>
<br /><br />
<form method="post">
<center>
<h3>Click to view:</h3>
<button class="bt1" type="submit" name="posts">My Posts</button>
<button class="bt1" type="submit" name="replies">My Replies</button>
</center>
</form>
<br /><br />
<hr color="#050119" size="2" />
<?php
if(isset($_POST['posts']))
{
	echo "<p class=pp1>My Posts:</p>";
	echo "<table class=ptb1 cellspacing=15 align=center>";
	$sql="SELECT pi_name FROM alumniinfo WHERE pi_register='$userid'";
	$result=$conn->query($sql);
	if ($result->num_rows > 0) 
	{
		while($row=$result->fetch_assoc())
		{
			$fullname=$row['pi_name'];
			$sql2="SELECT * FROM forumdata WHERE eforum_author='$fullname'";
			$result2=$conn->query($sql2);
			while($row=$result2->fetch_assoc())
			{
				echo "<tr>";
			  	echo "<td class=ptd1><span class=psp1>".$row['eforum_title']."</span><br><br><span class=psp2>
				".$row['eforum_content']."</span><br><br><span class=psp3>Tags: ".$row['eforum_tags']." | Time: ".$row['eforum_time']."</span></td>";
			  	echo "</tr>";
			}
		}
	}
	else
	{
		echo "<p>No post yet. Join e-forum now!</p>";	
		echo $userid;
	}
	echo "</table>";
	echo "<p class=pp1>Replies to My Post:</p>";
	echo "<table class=ptb1 cellspacing=15 align=center>";
	$sql="SELECT eforum_title FROM forumdata WHERE eforum_author='$fullname'";
	$result=$conn->query($sql);
	if ($result->num_rows > 0) 
	{
		while($row=$result->fetch_assoc())
		{
			$topic=$row['eforum_title'];
			$sql2="SELECT * FROM forum_reply WHERE forum_topic='$topic'";
			$result2=$conn->query($sql2);
			while($row=$result2->fetch_assoc())
			{
				echo "<tr>";
			  	echo "<td class=ptd1><span class=psp1>".$row['forum_topic']."</span><br><br><span class=psp2>
				".$row['forum_message']."</span><br><br><span class=psp3>Sender: ".$row['forum_reply_name']." | Time: ".$row['forum_reply_time']."</span></td>";
			  	echo "</tr>";
			}
		}
	}
	else
	{
		echo "<p>No post yet. Join e-forum now!</p>";	
		echo $userid;
	}
	echo "</table>";
}
?>
<?php
if(isset($_POST['replies']))
{
	echo "<p class=pp1>My Replies:</p>";
	echo "<table class=ptb1 cellspacing=15 align=center>";
	$sql3="SELECT pi_name FROM alumniinfo WHERE pi_register='$userid'";
	$result3=$conn->query($sql3);
	if ($result3->num_rows > 0) 
	{
		while($row=$result3->fetch_assoc())
		{
			$fullname=$row['pi_name'];
			$sql4="SELECT * FROM forum_reply WHERE forum_reply_name='$fullname'";
			$result4=$conn->query($sql4);
			while($row=$result4->fetch_assoc())
			{
				echo "<tr>";
			  	echo "<td class=ptd1><span class=psp1>Topic: ".$row['forum_topic']."</span><br><span class=psp2>Reply:
				".$row['forum_message']."</span><br><br><span class=psp3>Date & Time: ".$row['forum_reply_time']."</span></td>";
			  	echo "</tr>";
			}
		}
	}
	else
	{
		echo "<p>No post yet. Join e-forum now!</p>";	
		echo $userid;
	}
	echo "</table>";
}
?>
<br /><br /><br /><br />
</body>
</html>