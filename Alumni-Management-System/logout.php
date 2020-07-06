<?php
// logout.php
session_start();
session_destroy();
echo "<br /><br />Logout successful. Back to main page in 3 seconds";
header("refresh:3;url=index.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<link rel="stylesheet" href="css/logout.css" />
<body>

</body>
</html>