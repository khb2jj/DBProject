<?php
require('db.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $ssn =$_REQUEST['ssn'];
    $name = $_REQUEST['name'];
    $sql="insert into customers
    (`ssn`,`name`)values
    ('$ssn','$name')";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    $status = "New Record Inserted Successfully.
    </br></br><a href='view.php'>View Inserted Record</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> 
| <a href="view.php">View Records</a> 
| <a href="logout.php">Logout</a></p>
<div>
<h1>Insert New Record</h1>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<p><input type="text" name="ssn" placeholder="Enter Last Four Digits of SSN" required /></p>
<p><input type="text" name="name" placeholder="Enter Name" required /></p>
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</div>
</body>
</html>