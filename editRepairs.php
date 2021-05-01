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
        SET customerID='$b', employeeID='$c', repair_description='$d', repair_date='$e'
        WHERE repairID='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Repairs.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];
    $sql = "SELECT customerID, employeeID, repair_description, repair_date FROM repairs WHERE repairID='$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $customerID = mysqli_query($con, "SELECT customerID FROM repairs WHERE repairID='$id'");
    $row1 = mysqli_fetch_array($customerID);
    $employeeID = mysqli_query($con, "SELECT employeeID FROM repairs WHERE repairID='$id'");
    $row2 = mysqli_fetch_array($employeeID);
    $repair_description = mysqli_query($con, "SELECT repair_description FROM repairs WHERE repairID='$id'");
    $row3 = mysqli_fetch_array($repair_description);
    $repair_date = mysqli_query($con, "SELECT repair_date FROM repairs WHERE repairID='$id'");
    $row4 = mysqli_fetch_array($repair_date);
    $con->close();
?>

    <head>
        <meta charset="utf-8">
        <title>Insert New Repair </title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>
        <div class="form">
            <h1>Insert New Record</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <p><input type="text" name="a" value="<?php echo $id ?>" readonly /></p>
                <p><input type="text" name="b" value="<?php echo $row1['customerID'] ?>" required /></p>
                <p><input type="text" name="c" value="<?php echo $row2['employeeID'] ?>" required /></p>
                <p><input type="text" name="d" value="<?php echo $row3['repair_description'] ?>" required /></p>
                <p><input type="text" name="e" value="<?php echo $row4['repair_date'] ?>" required /></p>

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