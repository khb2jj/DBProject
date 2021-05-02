<!DOCTYPE html>
<html>
<?php
include('header.php');
echo "<br> <br> <br> <br>";

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

        $sql = "UPDATE inventory
        SET brand_name='$b', product_name='$c', price='$d', manufacturerID='$e'
        WHERE productID='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Inventory.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];
    $sql = "SELECT productID, brand_name, product_name, price, manufacturerID FROM inventory WHERE productID='$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $brand_name = mysqli_query($con, "SELECT brand_name FROM inventory WHERE productID='$id'");
    $row1 = mysqli_fetch_array($brand_name);
    $product_name = mysqli_query($con, "SELECT product_name FROM inventory WHERE productID='$id'");
    $row2 = mysqli_fetch_array($product_name);
    $price = mysqli_query($con, "SELECT price FROM inventory WHERE productID='$id'");
    $row3 = mysqli_fetch_array($price);
    $manufacturerID = mysqli_query($con, "SELECT manufacturerID FROM inventory WHERE productID='$id'");
    $row4 = mysqli_fetch_array($manufacturerID);
    $con->close();
?>

    <head>
        <meta charset="utf-8">
        <title>Insert New Inventory </title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>
        <div class="form">
            <h1>Insert New Record</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <p><input type="text" name="a" value="<?php echo $id ?>" readonly /></p>
                <p><input type="text" name="b" value="<?php echo $row1['brand_name'] ?>" required /></p>
                <p><input type="text" name="c" value="<?php echo $row2['product_name'] ?>" required /></p>
                <p><input type="text" name="d" value="<?php echo $row3['price'] ?>" required /></p>
                <p><input type="text" name="e" value="<?php echo $row4['manufacturerID'] ?>" required /></p>

                <p><input name="submit" type="submit" value="Submit" /></p>
                <p style="color:#FF0000;"><?php echo $status; ?></p>
        </div>
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