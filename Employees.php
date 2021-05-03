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
        <h1> Employees </h1>
    </div>

    <?php 
        // check if the user that is logged in is a manager
        // if not, then they cannot view or edit this table
        $db_connection = new mysqli('usersrv01.cs.virginia.edu', 'khb2jj', 'ProjectGroup2021!', 'khb2jj');

        if(mysqli_connect_errno()) {
            echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
            return null;
        }

        $username = $_SESSION['user'];
        $result = mysqli_query($db_connection, "SELECT * FROM employees WHERE username = '$username'");
        $row = mysqli_fetch_array($result);
        
        mysqli_close($db_connection);

        // if the user is not a manager
        if($row['is_manager'] == 0) {
    ?>

        <div class="container" style="text-align:center">
            <h5> Only managers can view the employees of John's Lights! </h5>
        </div>

    <?php 
        }
        // if the user is a manager, give them the table
        else {
    ?>

    <div class="w3-container">
        <div class="row">
            <div class="col-md-4">
                <form action="InsertEmployee.php" method="get">
                    <input type="submit" style="font-size: 20px; background-color:yellow; border: solid 2px; border-radius: 5px;" value="Insert New Employee"/>
                </form>
            </div>
            <div class="col-md-8" style="display: flex; justify-content: flex-end">
                <form action="Employees.php" method="post">
                    <label style="font-size: 20px;" for="store_id"> Search employees by store number: </label>
                    <input style="font-size: 20px;" type="text" name="store_id" placeholder="Store Number">
                    <input  type="submit" style="background-color:yellow; border: solid 2px; border-radius: 5px; font-size:20px" value="Go">
                </form>
            </div>
        </div>
        
        <br>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white" id="myTable">
            <tr>
                <th>Employee ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Store</th>
                <th>Wage</th>
                <th>Manager?</th>
                <th></th>
                <th></th>
            </tr>

            <?php
                $db_connection = new mysqli('usersrv01.cs.virginia.edu', 'khb2jj', 'ProjectGroup2021!', 'khb2jj');
                
                if(mysqli_connect_errno()) {
                    echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
                    return null;
                }
        
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $store = $_POST['store_id'];
                    $result = mysqli_query($db_connection, "SELECT * FROM employees WHERE store_id ='$store'");
                }
                else {
                    $result = mysqli_query($db_connection, "SELECT * FROM employees");
                }

                mysqli_close($db_connection);

                while ($row = mysqli_fetch_array($result)) {
            ?>

            <tr>
                <td> <?php echo $row["em_id"]; ?> </td>
                <td> <?php echo $row["username"]; ?> </td>
                <td> <?php echo $row["name"]; ?> </td>
                <td> <?php echo $row["phone"]; ?> </td>
                <td> <?php echo $row["store_id"]; ?> </td>
                <td> <?php echo $row["wage"]; ?> </td>
                <?php if($row["is_manager"] == 0) { ?> 
                    <td> No </td>
                <?php } else { ?>
                    <td> Yes </td>
                <?php } ?>
                <td>
                    <form action="UpdateEmployee.php" method="post">
                        <input type="hidden" name="emp_id" value="<?php echo $row["em_id"]; ?>" />
                        <input type="hidden" name="username" value="<?php echo $row["username"]; ?>" />
                        <input type="hidden" name="password" value="<?php echo $row["password"]; ?>" />
                        <input type="hidden" name="name" value="<?php echo $row["name"]; ?>" />
                        <input type="hidden" name="phone" value="<?php echo $row["phone"]; ?>" />
                        <input type="hidden" name="store_id" value="<?php echo $row["store_id"]; ?>" />
                        <input type="hidden" name="is_manager" value="<?php echo $row["is_manager"]; ?>" />
                        <input type="hidden" name="wage" value="<?php echo $row["wage"]; ?>" />
                        <input type="submit" name="edit" value="Edit" />
                    </form>
                </td>
                <td>
                    <form action="DeleteEmployee.php" method="post">
                        <input type="submit" name="delete" value="Delete" />
                        <p><input type="hidden" name="emp_id" value="<?php echo $row["em_id"]; ?>" /></p>
                    </form>
                </td>
            </tr>
        </div>

        <?php 
            } // close while
                } // close out else tag
                    } // close out else tag 
        ?>
        
        </table>
        <br>

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