<!DOCTYPE html>
<html>
    <?php
        // header begins body tag
        include('Header.php');
        echo "<br> <br> <br> <br>";
        
        // make the user login first 
        if(!isset($_SESSION['user'])) {
            include('Login.php');
        }
        else {
    ?>
    
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