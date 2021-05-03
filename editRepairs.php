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
    require('backend/customers.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
        $d = $_REQUEST['d'];
        $e = $_REQUEST['e'];

        $stmt = $con->prepare("UPDATE repairs
                                SET customerID=?, employeeID=?, repair_description=?, repair_date=?
                                WHERE repairID=?");
        $stmt->bind_param("iissi", $b, $c, $d, $e, $a);
        $stmt->execute();

        $stmt->close();
        /*
        $sql = "UPDATE repairs
        SET customerID='$b', employeeID='$c', repair_description='$d', repair_date='$e'
        WHERE repairID='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        } */
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Repairs.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];
    $sql = "SELECT repairID, customerID, employeeID, repair_description, repair_date FROM repairs WHERE repairID='$id'";

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

        <div class="container" style="text-align:center">
            <h1>Edit Repair</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <div class="form-group">
                    <label style="font-size:20px" for="a">Repair ID: </label>
                    <input style="font-size:20px" type="number" name="a" value="<?php echo $id ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="b">Customer ID: </label>
                    <input style="font-size:20px" type="number" name="b" value="<?php echo $row1['customerID'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="c">Employee ID: </label>
                    <input style="font-size:20px" type="number" name="c" value="<?php echo $row2['employeeID'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="d">Repair Description: </label>
                    <input style="font-size:20px" type="text" name="d" size="50" value="<?php echo $row3['repair_description'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="e">Repair Date: </label>
                    <input style="font-size:20px" type="text" name="e"  value="<?php echo $row4['repair_date'] ?>" required />
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