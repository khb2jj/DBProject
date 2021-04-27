<?php

include_once("./library.php");
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT * FROM manufacturers";

echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Manufacturer ID</font> </td> 
          <td> <font face="Arial">Name</font> </td> 
      </tr>';

if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["man_id"];
        $field2name = $row["name"];

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
              </tr>';
    }

mysqli_close($con);
}
