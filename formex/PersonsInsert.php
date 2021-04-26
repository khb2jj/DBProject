<?php

include_once("./library.php");
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "INSERT INTO Persons (FirstN, LastN, Age)
VALUES
('$_POST[firstname]','$_POST[lastname]','$_POST[age]')";

if (!mysqli_query($con, $sql)) {
    die('Error: ' . mysqli_error($con));
}
$result = mysqli_query($con, "SELECT * FROM Persons ORDER BY LastN");

while ($row = mysqli_fetch_array($result)) {
    echo $row['FirstN'];
    echo " " . $row['LastN'];
    echo " " . $row['Age'];
    echo "<br>";
}

mysqli_close($con);
