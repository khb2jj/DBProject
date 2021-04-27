<?php

include_once("./library.php");
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "SELECT * FROM manufacturers ORDER BY name");

while ($row = mysqli_fetch_array($result)) {
    echo $row['man_id'];
    echo " " . $row['name'];
    echo "<br>";
}

mysqli_close($con);
?>