<!DOCTYPE html>
<html>
<?php
// header begins body tag
include('Header.php');
echo "<br>";

// make the user login first 
if (!isset($_SESSION['user'])) {
    header('location: Home.php');
}
// if the user is logged in, display the home page content
else {
?>

<?php
    require('backend/db.php');
    require('backend/returns.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
        $d = $_REQUEST['d'];

        returnsInsert($a, $b, $c, $d);

        $status = "New Record Inserted Successfully.";
        echo "<script> window.location.assign('Returns.php'); </script>";
        $con->close();
    }
}
?>
    <div class="container" style="text-align:center">
        <h1>New Return</h1>
        <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <div class="form-group">
                <label style="font-size:20px" for="a">Return ID: </label>
                <input style="font-size:20px" type="number" name="a" placeholder="Return ID" required />
            </div>
            <div class="form-group">
                <label style="font-size:20px" for="b">Customer ID: </label>
                <input style="font-size:20px" type="number" name="b" placeholder="Customer ID" required />
            </div>
            <div class="form-group">
                <label style="font-size:20px" for="c">Product ID: </label>
                <input style="font-size:20px" type="number" name="c" placeholder="Product ID" required />
            </div>
            <div class="form-group">
                <label style="font-size:20px" for="d">Return Date: </label>
                <input style="font-size:20px" type="text" name="d" placeholder="Return Date" required />
            </div>
            
            <p><input style="background-color:yellow; font-size:20px; border: black solid 2px; border-radius:5px; color:black" name="submit" type="submit" value="Submit" /></p>
            <p style="color:#FF0000;"><?php echo $status; ?></p>
        </form>
    </div>
    
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