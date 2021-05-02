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
    require('backend/rewards.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];
        $d = $_REQUEST['d'];

        $sql = "UPDATE rewards
        SET customerID='$b', r_available='$c', r_expiration='$d'
        WHERE rewardsID='$a'";

        if (!mysqli_query($con, $sql)) {
            die('Error: ' . mysqli_error($con));
        }
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

    <head>
        <meta charset="utf-8">
        <title>Insert New Reward </title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>
        <div class="form">
            <h1>Insert New Record</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <p><input type="text" name="a" value="<?php echo $id ?>" readonly /></p>
                <p><input type="text" name="b" value="<?php echo $row1['customerID'] ?>" required /></p>
                <p><input type="text" name="c" value="<?php echo $row2['r_available'] ?>" required /></p>
                <p><input type="text" name="d" value="<?php echo $row3['r_expiration'] ?>" required /></p>

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