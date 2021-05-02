<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        authenticate();
    }

    // need some actual authentication code here that looks in the database and verifies that the user exists
    function authenticate() {
        $db_connection = new mysqli('usersrv01.cs.virginia.edu', 'khb2jj', 'ProjectGroup2021!', 'khb2jj');

        if(mysqli_connect_errno()) {
            echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error());
            return null;
        }

        $username = $_POST['username'];
        $result = mysqli_query($db_connection, "SELECT * FROM employees WHERE username = '$username'");
        $row = mysqli_fetch_array($result);
        
        mysqli_close($db_connection);

        // if there is no user with this username, alert
        if($row['username'] == $_POST['username'] && $row['password'] == $_POST['password']) {
            session_start();
            $_SESSION['user'] = $_POST['username'];
            $_SESSION['pwd'] = $_POST['password'];  // in reality, don't save password directly, hash instead
            header("Location: Home.php");
        } 
        else { 
            echo "<script> alert('Username and/or password do not match our record'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <?php
        // header begins body tag
        include('Header.php');
        echo "<br> <br> <br> <br>";
        
        // make the user login first 
        if(!isset($_SESSION['user'])) {
    ?>

        <img src="images/tlogo.png" style="width:500px" class="center">
        <br> <br>
        <div class="container" style="text-align: center;">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <label style="font-size: 20px;" for="username">Username: </label>
                    <input style="font-size: 20px;" type="text" name ="username" size="20" placeholder="Enter Username" value="<?php if(!empty($_POST['username'])) echo $_POST['username']?>"/> <br>
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;" for="password">Password: </label>
                    <input style="font-size: 20px;" type="password" name="password" size="30" placeholder="Enter Password" value="<?php if(!empty($_POST['password'])) echo $_POST['password']?>" />  <br>      
                </div> 
                <input type="submit" value="Login" style="background-color:yellow; font-size:20px;"/>    
            </form>
        </div>
    
    <?php        
        }
        // if the user is logged in, display the home page content
        else {
    ?>
    
    <div class="container" style="text-align:center">
    <img src="images/tlogo.png" style="width:500px" class="center">
        <h1> Welcome <?php if(isset($_SESSION['user'])) echo $_SESSION['user'] . "!"?> </h1>
    </div>

    <?php } // close out else tag ?>
    


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