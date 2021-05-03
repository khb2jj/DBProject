<?php 
    // if the form has been submitted, add the employee to the database
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

        //$result = mysqli_query($db_connection, "INSERT INTO employees VALUES ('$empid','$username','$password','$name','$store','$phone','$wage','$is_manager')");
        
        $stmt = $db_connection->prepare("INSERT INTO employees VALUES
                             (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isssisdi", $empid, $username, $password, $name, $store, $phone, $wage, $is_manager);
        $stmt->execute();

        $stmt->close();

        //mysqli_close($db_connection);
        header("Location: Employees.php");
    }
?>


<!DOCTYPE html>
<html>
    <?php
        // header begins body tag
        include('Header.php');
        echo "<br>";
        
        // make the user login first 
        if(!isset($_SESSION['user'])) {
            header('location: Home.php');
        }
        // if the user is logged in, display the home page content
        else {
    ?>
    
    <div class="container" style="text-align:center">
        <h1> Insert New Employee </h1>
    </div>

    <div class="container" style="text-align: center;">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label style="font-size: 20px;" for="emp_id">Employee ID: </label>
                <input style="font-size: 20px;" type="number" name ="emp_id" size="15" placeholder="Enter Employee ID" value="<?php if(!empty($_POST['emp_id'])) echo $_POST['emp_id']?>"/> <br>
            </div>
            <div class="form-group">
                <label style="font-size: 20px;" for="username">Username: </label>
                <input style="font-size: 20px;" type="text" name ="username" size="20" placeholder="Enter Username" value="<?php if(!empty($_POST['username'])) echo $_POST['username']?>"/> <br>
            </div>
            <div class="form-group">
                <label style="font-size: 20px;" for="password">Password: </label>
                <input style="font-size: 20px;" type="password" name="password" size="30" placeholder="Enter Password" value="<?php if(!empty($_POST['password'])) echo $_POST['password']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="name">Name: </label>
                <input style="font-size: 20px;" type="text" name="name" size="30" placeholder="Enter Name" value="<?php if(!empty($_POST['name'])) echo $_POST['name']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="store_id">Store Number: </label>
                <input style="font-size: 20px;" type="number" name="store_id" size="10" placeholder="Enter Store Number" value="<?php if(!empty($_POST['store_id'])) echo $_POST['store_id']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="phone">Phone Number: </label>
                <input style="font-size: 20px;" type="text" name="phone" size="20" placeholder="Enter Phone Number" value="<?php if(!empty($_POST['phone'])) echo $_POST['phone']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="wage">Hourly Wage: </label>
                <input style="font-size: 20px;" type="text" name="wage" size="20" placeholder="Enter Hourly Wage" value="<?php if(!empty($_POST['wage'])) echo $_POST['wage']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="is_manager">Is this employee a manager? </label>
                <select class="dropdown" style="font-size: 20px;" name="is_manager" value="<?php if(!empty($_POST['is_manager'])) echo $_POST['is_manager']?>"> 
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>  <br>      
            </div> 
            <input type="submit" value="Add Employee" style="background-color:yellow; font-size:20px; border: solid 2px; border-radius:5px"/>    
        </form>
    </div>

    <?php } // close out else ?>
    
    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>
    </body>
</html>