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
    require('backend/inventory.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
        $d = $_REQUEST['d'];
        $e = $_REQUEST['e'];
        $f = $_REQUEST['f'];
        $h = $_REQUEST['h'];

        //$sql = "UPDATE inventory SET brand_name='$b', product_name='$c', price='$d', manufacturerID='$e' WHERE productID='$a'";

        $stmt = $con->prepare("UPDATE inventory SET brand_name=?, product_name=?, price=?, manufacturerID=? WHERE productID=?");
        $stmt->bind_param("ssdii", $b, $c, $d, $e, $a);
        $stmt->execute();
        $stmt->close();

        /*
        $sql = "UPDATE inventory_location inv_loc
                Join inventory inv 
                ON inv_loc.productID = inv.productID
                Join stores s
                ON s.store_id = inv_loc.store_ID
                SET inv.brand_name='$b', inv.product_name='$c', inv.price='$d', inv.manufacturerID='$e', s.address='$g', inv_loc.quantity='$h'
                WHERE (inv.productID='$a'
                AND s.store_id='$f')";
        */

        $stmt = $con->prepare("UPDATE inventory_location inv_loc
                                Join inventory inv 
                                ON inv_loc.productID = inv.productID
                                Join stores s
                                ON s.store_id = inv_loc.store_ID
                                SET inv.brand_name=?, inv.product_name=?, inv.price=?, inv.manufacturerID=?, inv_loc.quantity=?
                                WHERE (inv.productID=?
                                AND s.store_id=?)");
        $stmt->bind_param("ssdiiii", $b, $c, $d, $e, $h, $a, $f);
        $stmt->execute();
        $stmt->close();

        
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Inventory.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];

    $id2 = intval($_GET['temp']);
    $id2 = $_GET['temp'];

    $sql = "SELECT productID, brand_name, product_name, price, manufacturerID FROM inventory WHERE productID='$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $brand_name = mysqli_query($con, "SELECT brand_name FROM inventory Natural Join inventory_location Natural Join stores WHERE productID='$id' AND store_id='$id2'");
    $row1 = mysqli_fetch_array($brand_name);
    $product_name = mysqli_query($con, "SELECT product_name FROM inventory Natural Join inventory_location Natural Join stores WHERE productID='$id' AND store_id='$id2'");
    $row2 = mysqli_fetch_array($product_name);
    $price = mysqli_query($con, "SELECT price FROM inventory Natural Join inventory_location Natural Join stores WHERE productID='$id' AND store_id='$id2'");
    $row3 = mysqli_fetch_array($price);
    $manufacturerID = mysqli_query($con, "SELECT manufacturerID FROM inventory Natural Join inventory_location Natural Join stores WHERE productID='$id' AND store_id='$id2'");
    $row4 = mysqli_fetch_array($manufacturerID);

    $location = mysqli_query($con, "SELECT address FROM inventory Natural Join inventory_location Natural Join stores WHERE productID='$id' AND store_id='$id2'");
    $row5 = mysqli_fetch_array($location);
    $quantity = mysqli_query($con, "SELECT quantity FROM inventory Natural Join inventory_location Natural Join stores WHERE productID='$id' AND store_id='$id2'");
    $row6 = mysqli_fetch_array($quantity);

    $con->close();
?>

        <div class="container" style="text-align: center">
            <h1>Edit Inventory Item</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <div class="form-group">
                    <label style="font-size:20px" for="a">Product ID: </label>
                    <input style="font-size:20px;" type="number" name="a" value="<?php echo $id ?>" readonly />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="b">Brand Name: </label>
                    <input style="font-size:20px;" type="text" name="b" value="<?php echo $row1['brand_name'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="c">Product Name: </label>
                    <input style="font-size:20px;" type="text" name="c" value="<?php echo $row2['product_name'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="d">Price: </label>
                    <input style="font-size:20px;" type="text" name="d" value="<?php echo $row3['price'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="e">Manufacturer ID: </label>
                    <input style="font-size:20px;" type="number" name="e" value="<?php echo $row4['manufacturerID'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="f">Store ID: </label>
                    <input style="font-size:20px;" type="number" name="f" value="<?php echo $id2 ?>" readonly />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="h">Quantity: </label>
                    <input style="font-size:20px;" type="number" name="h" value="<?php echo $row6['quantity'] ?>" required />
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