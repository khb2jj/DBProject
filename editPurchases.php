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
    require('backend/purchases.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
        $d = $_REQUEST['d'];
        $e = $_REQUEST['e']; // store ID

        $stmt = $con->prepare("UPDATE purchases
                            SET customerID=?, productID=?, storeID=?, date=?
                            WHERE purchaseID=?");
        $stmt->bind_param("iiisi", $b, $c, $e, $d, $a);
        $stmt->execute();

        $stmt->close();

        /*
        $sql = "UPDATE purchases
        SET customerID='$b', productID='$c', date='$d'
        WHERE purchaseID='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
        */
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Purchases.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];
    $sql = "SELECT purchaseID, customerID, productID, date FROM purchases WHERE purchaseID='$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $customerID = mysqli_query($con, "SELECT customerID FROM purchases WHERE purchaseID='$id'");
    $row1 = mysqli_fetch_array($customerID);
    $productID = mysqli_query($con, "SELECT productID FROM purchases WHERE purchaseID='$id'");
    $row2 = mysqli_fetch_array($productID);
    $date = mysqli_query($con, "SELECT date FROM purchases WHERE purchaseID='$id'");
    $row3 = mysqli_fetch_array($date);
    $storeID = mysqli_query($con, "SELECT storeID FROM purchases WHERE purchaseID='$id'");
    $row4 = mysqli_fetch_array($storeID);
    $con->close();
?>
        <div class="container" style="text-align:center">
            <h1>Edit Purchase Record</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <div class="form-group">
                    <label style="font-size:20px" for="a">Purchase ID: </label>
                    <input style="font-size:20px" type="number" name="a" value="<?php echo $id ?>" readonly />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="b">Customer ID: </label>
                    <input style="font-size:20px" type="number" name="b" value="<?php echo $row1['customerID'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="c">Product ID: </label>
                    <input style="font-size:20px" type="number" name="c" value="<?php echo $row2['productID'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="e">Store ID: </label>
                    <input style="font-size:20px" type="number" name="e" value="<?php echo $row4['storeID'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="d">Purchase Date: </label>
                    <input style="font-size:20px" type="text" name="d" value="<?php echo $row3['date'] ?>" required />
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