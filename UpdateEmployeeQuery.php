<?php 
    // if the form has been submitted, update the employee's information
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $db_connection = new mysqli('usersrv01.cs.virginia.edu', 'khb2jj', 'ProjectGroup2021!', 'khb2jj');

        if(mysqli_connect_errno()) {
            echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
            return null;
        }

        $empid = $_POST['emp_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $store = $_POST['store_id'];
        $phone = $_POST['phone'];
        $wage = $_POST['wage'];
        if($_POST['is_manager'] == "yes") {
            $is_manager = 1;
        }
        else {
            $is_manager = 0;
        }

        $result = mysqli_query($db_connection, "UPDATE employees 
                SET username='$username', password='$password', name='$name', 
                store_id='$store', phone='$phone', wage='$wage', is_manager='$is_manager' 
                WHERE em_id = '$empid'");
        
        mysqli_close($db_connection);
        header("Location: Employees.php");
    }
?>