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
    require('backend/customers.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
        $d = $_REQUEST['d'];
        $e = $_REQUEST['e'];

        $sql = "UPDATE customers
        SET email='$b', phone='$c', address='$d', name='$e'
        WHERE customerID='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Customers.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];
    $sql = "SELECT customerID, email, phone, address, name FROM customers WHERE customerID = '$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $customerID = mysqli_query($con, "SELECT customerID FROM customers WHERE customerID = '$id'");
    $row = mysqli_fetch_array($customerID);

    $email = mysqli_query($con, "SELECT email FROM customers WHERE customerID = '$id'");
    $row1 = mysqli_fetch_array($email);
    $phone = mysqli_query($con, "SELECT phone FROM customers WHERE customerID = '$id'");
    $row2 = mysqli_fetch_array($phone);
    $address = mysqli_query($con, "SELECT address FROM customers WHERE customerID = '$id'");
    $row3 = mysqli_fetch_array($address);
    $name = mysqli_query($con, "SELECT name FROM customers WHERE customerID = '$id'");
    $row4 = mysqli_fetch_array($name);
    $con->close();
?>

    <head>
        <meta charset="utf-8">
        <title>Insert New Customer </title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>
        <div class="form">
            <h1>Insert New Record</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <p>Customer ID: <input type="text" name="a" value="<?php echo $row['customerID'] ?>" readonly /></p>
                <p>Email: <input type="text" name="b" value="<?php echo $row1['email'] ?>" required /></p>
                <p>Phone: <input type="text" name="c" value="<?php echo $row2['phone'] ?>" required /></p>
                <p>Address: <input type="text" name="d" value="<?php echo $row3['address'] ?>" required /></p>
                <p>Name: <input type="text" name="e" value="<?php echo $row4['name'] ?>" required /></p>

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