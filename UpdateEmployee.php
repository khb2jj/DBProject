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
        <h1> Update Employee </h1>
    </div>

    <div class="container" style="text-align: center;">
        <form action="UpdateEmployeeQuery.php" method="post">
            <div class="form-group">
                <input type="hidden" name="emp_id" value="<?php echo $_POST['emp_id'] ?>">
                <p style="font-size: 20px;"> Employee ID: <?php echo $_POST['emp_id'] ?> </p>
            </div>
            <div class="form-group">
                <label style="font-size: 20px;" for="username">Username: </label>
                <input style="font-size: 20px;" type="text" name ="username" size="20" value="<?php echo $_POST['username']?>"/> <br>
            </div>
            <div class="form-group">
                <label style="font-size: 20px;" for="password">Password: </label>
                <input style="font-size: 20px;" type="password" name="password" size="30" value="<?php echo $_POST['password']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="name">Name: </label>
                <input style="font-size: 20px;" type="text" name="name" size="30" value="<?php echo $_POST['name']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="store_id">Store Number: </label>
                <input style="font-size: 20px;" type="number" name="store_id" size="10" value="<?php echo $_POST['store_id']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="phone">Phone Number: </label>
                <input style="font-size: 20px;" type="text" name="phone" size="20" value="<?php echo $_POST['phone']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="wage">Hourly Wage: </label>
                <input style="font-size: 20px;" type="text" name="wage" size="20" value="<?php echo $_POST['wage']?>" />  <br>      
            </div> 
            <div class="form-group">
                <label style="font-size: 20px;" for="is_manager">Is this employee a manager? </label>
                <select class="dropdown" style="font-size: 20px;" name="is_manager" value="<?php echo $_POST['is_manager']?>"> 
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>  <br>      
            </div> 
            <input type="submit" value="Update" style="background-color:yellow; font-size:20px; border: solid 2px; border-radius:5px"/>    
        </form>
        <br>
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