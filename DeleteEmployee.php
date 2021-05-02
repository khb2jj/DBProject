<?php 
    // if the form has been submitted, delete the employee
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $db_connection = new mysqli('usersrv01.cs.virginia.edu', 'khb2jj', 'ProjectGroup2021!', 'khb2jj');

        if(mysqli_connect_errno()) {
            echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
            return null;
        }

        $empid = $_POST['emp_id'];
        $result = mysqli_query($db_connection, "DELETE FROM employees WHERE em_id='$empid'");
        
        mysqli_close($db_connection);
        header("Location: Employees.php");
    }
?>