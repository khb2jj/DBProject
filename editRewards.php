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
    require('backend/rewards.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
        $d = $_REQUEST['d'];

        $stmt = $con->prepare("UPDATE rewards
                                SET customerID=?, r_available=?, r_expiration=?
                                WHERE rewardsID=?");
        $stmt->bind_param("issi", $b, $c, $d, $a);
        $stmt->execute();

        $stmt->close();

        /*
        $sql = "UPDATE rewards
        SET customerID='$b', r_available='$c', r_expiration='$d'
        WHERE rewardsID='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
        */
        $status = "New Record Updated Successfully.";
        echo "<script> window.location.assign('Rewards.php'); </script>";
        $con->close();
    }

    $id = intval($_GET['edit']);
    $id = $_GET['edit'];
    $sql = "SELECT rewardsID, customerID, r_available, r_expiration FROM rewards WHERE rewardsID='$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $customerID = mysqli_query($con, "SELECT customerID FROM rewards WHERE rewardsID='$id'");
    $row1 = mysqli_fetch_array($customerID);
    $r_available = mysqli_query($con, "SELECT r_available FROM rewards WHERE rewardsID='$id'");
    $row2 = mysqli_fetch_array($r_available);
    $r_expiration = mysqli_query($con, "SELECT r_expiration FROM rewards WHERE rewardsID='$id'");
    $row3 = mysqli_fetch_array($r_expiration);
    $con->close();
?>

        <div class="container" style="text-align:center">
            <h1>Edit Reward</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <div class="form-group">
                    <label style="font-size:20px" for="a">Reward ID: </label>
                    <input style="font-size:20px" type="number" name="a" value="<?php echo $id ?>"  required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="b">Customer ID: </label>
                    <input style="font-size:20px" type="number" name="b" value="<?php echo $row1['customerID'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="c">Reward Available: </label>
                    <input style="font-size:20px" type="text" name="c" value="<?php echo $row2['r_available'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="d">Reward Expiration Date: </label>
                    <input style="font-size:20px" type="text" name="d" value="<?php echo $row3['r_expiration'] ?>" required />
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