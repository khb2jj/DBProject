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
    require('backend/stores.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];

        storesInsert($a, $b, $c);

        $status = "New Record Inserted Successfully.";
        echo "<script> window.location.assign('Stores.php'); </script>";
        $con->close();
    }
}
?>

    <div class="container" style="text-align:center">
        <h1>New Store</h1>
        <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <div class="form-group">
                <label for="a" style="font-size:20px">Store ID: </label>
                <input style="font-size:20px;" type="number" name="a" placeholder="Store ID" required/>
            </div>
            <div class="form-group">
                <label for="b" style="font-size:20px">Address: </label>
                <input style="font-size:20px;" type="text" name="b" placeholder="Address" required/>
            </div>
            <div class="form-group">
                <label for="a" style="font-size:20px">Manager ID: </label>
                <input style="font-size:20px;" type="number" name="c" placeholder="Manager ID" required/>
            </div>
            <input style="background-color:yellow; font-size:20px; border: black solid 2px; border-radius:5px; color:black" name="submit" type="submit" value="Submit" />
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