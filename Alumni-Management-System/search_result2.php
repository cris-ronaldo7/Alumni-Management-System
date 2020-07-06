<?php
session_start();
include_once"connect_database.php";
if (!isset($_SESSION['id'])){
	header("location:login.html");
}
else
{
  $userid=$_SESSION['id'];
  if (strchr("$userid","AD")==true)
	{
    $username1=$_SESSION['adname'];
		include_once"setting/adminsearchlist_navigation.php";
	}
	else
	{	
    $alusername=$_SESSION['alname'];
		include_once"setting/alumnisearchlist_navigation.php";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Alumni</title>
<link rel="stylesheet" href="css/index.css" />
</head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 90%;
	background-color: #F9E79F;
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 5px;
}

#button1 {
	padding: 5px 20px;
    background-color: #F9E79F;
    color: black;
    border: 2px solid #FEF9E7;
}
	
</style>
<body>
<br>
<?php
include_once"connect_database.php";
?>

<center><h1 style="padding-left:100px"> View Alumni Members </h1></center>
<br>
<table id="alumni" align="center">
<tr>
    <th> Serial Number </th>     
    <th onclick="sortTable(0)"> Registration Number </th>
    <th> Name </th>
    <th> Gender</th>
    <th> Branch</th>
    <th> Session </th>
    <th> Email </th>
    <th> Mobile </th>
    <th> Works At </th>
</tr>
<?php
$name=$_REQUEST['pid'];
$regis=$_REQUEST['aid'];
$bran=$_REQUEST['pp'];
$sess=$_REQUEST['sp'];
if($name!='')
{$sqlshowAWA= "SELECT alumnimember.pi_register, alumniinfo.pi_name,alumniinfo.pi_branch, 
alumniinfo.pi_session,alumniinfo.pi_email, alumniinfo.pi_gender, alumniinfo.pi_company, alumniinfo.pi_mobile FROM alumnimember, alumniinfo 
WHERE alumnimember.pi_register = alumniinfo.pi_register AND alumniinfo.pi_name = '$name'";}
if($regis!='')
{$sqlshowAWA= "SELECT alumnimember.pi_register, alumniinfo.pi_name,alumniinfo.pi_branch, 
  alumniinfo.pi_session,alumniinfo.pi_email, alumniinfo.pi_gender, alumniinfo.pi_company, alumniinfo.pi_mobile FROM alumnimember, alumniinfo 
  WHERE alumnimember.pi_register = alumniinfo.pi_register AND alumniinfo.pi_register = '$regis'";}
if($sess!='')
  {$sqlshowAWA= "SELECT alumnimember.pi_register, alumniinfo.pi_name,alumniinfo.pi_branch, 
  alumniinfo.pi_session,alumniinfo.pi_email ,  alumniinfo.pi_gender, alumniinfo.pi_company, alumniinfo.pi_mobile FROM alumnimember, alumniinfo 
  WHERE alumnimember.pi_register = alumniinfo.pi_register AND alumniinfo.pi_session = '$sess'";}
if($bran!='')
  {$sqlshowAWA= "SELECT alumnimember.pi_register, alumniinfo.pi_name,alumniinfo.pi_branch, 
    alumniinfo.pi_session,alumniinfo.pi_email,  alumniinfo.pi_gender, alumniinfo.pi_company, alumniinfo.pi_mobile FROM alumnimember, alumniinfo 
  WHERE alumnimember.pi_register = alumniinfo.pi_register AND alumniinfo.pi_branch = '$bran'";}

$resultAWA = $conn->query($sqlshowAWA);
$no = 1;
while ($row = mysqli_fetch_assoc($resultAWA))
{
	echo "<tr>";
	echo "<td>" . $no++. "</td>";
	echo "<td>" . $row['pi_register']. "</td>";
    echo "<td>" . $row['pi_name']. "</td>";
    echo "<td>" . $row['pi_gender']. "</td>";
    echo "<td>" . $row['pi_branch']. "</td>";
    echo "<td>" . $row['pi_session']. "</td>";
    echo "<td>" . $row['pi_email']. "</td>";
    echo "<td>" . $row['pi_mobile']. "</td>";
    echo "<td>" . $row['pi_company']. "</td>";
	echo "</tr>";
}
?>
</table>
<center><width="450" style="border:hidden;font-size:20px;color:black"><a href="search_alumni2.php"> Back To Seach Page</a></center>
<br><br><br><br>


<script>

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("alumni");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}	


</script>
</body>
</html>