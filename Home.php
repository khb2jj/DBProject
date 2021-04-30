<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        authenticate();
    }

    // need some actual authentication code here that looks in the database and verifies that the user exists
    function authenticate() {
        session_start();
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['pwd'] = $_POST['password'];  // in reality, don't save password directly, hash instead
        header("Location: Home.php");
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
        <br> <br> <br>
        <div class="container" style="text-align: center;">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" name ="username" size="20" placeholder="Enter Username" value="<?php if(!empty($_POST['username'])) echo $_POST['username']?>"/> <br>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" size="30" placeholder="Enter Password" value="<?php if(!empty($_POST['password'])) echo $_POST['password']?>" />  <br>      
                </div> 
                <input type="submit" value="Login"/>    
            </form>
        </div>
    
    <?php        
        }
        // if the user is logged in, display the home page content
        else {
    ?>
    
    <div class="container" style="text-align:center">
        <h1> Home page </h1>
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