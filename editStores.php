<!DOCTYPE html>
<html>
<?php
include('header.php');
echo "<br>";

// make the user login first 
if (!isset($_SESSION['user'])) {
    header('location: Home.php');
}
// if the user is logged in, display the home page content
else {
    require('backend/db.php');
    require('backend/stores.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
       
        $stmt = $con->prepare("UPDATE stores
        SET address=?, managerID=?
        WHERE store_id=?");
        $stmt->bind_param("sii", $b, $c, $a);
        $stmt->execute();

        $stmt->close();
        /*    
        $sql = "UPDATE stores
        SET address='$b', managerID='$c'
        WHERE store_id='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
        */
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Stores.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];
    $sql = "SELECT store_id, address, managerID FROM stores WHERE store_id='$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $address = mysqli_query($con, "SELECT address FROM stores WHERE store_id='$id'");
    $row1 = mysqli_fetch_array($address);
    $managerID = mysqli_query($con,  "SELECT managerID FROM stores WHERE store_id='$id'");
    $row2 = mysqli_fetch_array($managerID);

    $con->close();
?>

        <div class="container" style="text-align:center">
            <h1>Edit Store</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <div class="form-group">
                    <label for="a" style="font-size:20px;">Store ID: </label>
                    <input style="font-size:20px;" type="number" name="a" value="<?php echo $id ?>" readonly />
                </div>
                <div class="form-group">
                    <label for="b" style="font-size:20px;">Address: </label>
                    <input style="font-size:20px;" type="text" name="b" value="<?php echo $row1['address'] ?>" required />
                </div>  
                <div class="form-group">
                    <label for="c" style="font-size:20px;">Manager ID: </label>
                    <input style="font-size:20px;" type="number" name="c" value="<?php echo $row2['managerID'] ?>" required />
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

<?php
}
?>