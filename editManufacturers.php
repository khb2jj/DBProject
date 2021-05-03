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
    require('backend/manufacturers.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];

        $stmt = $con->prepare("UPDATE manufacturers
        SET name=?, phone=?
        WHERE manufacturerID=?");
        $stmt->bind_param("ssi", $b, $c, $a);
        $stmt->execute();

        $stmt->close();
        /*
        $sql = "UPDATE manufacturers
        SET name='$b', phone='$c'
        WHERE manufacturerID='$a'";

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
    $sql = "SELECT manufacturerID, name, phone FROM manufacturers WHERE manufacturerID='$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }

    $name = mysqli_query($con, "SELECT name FROM manufacturers WHERE manufacturerID='$id'");
    $row1 = mysqli_fetch_array($name);
    $phone = mysqli_query($con, "SELECT phone FROM manufacturers WHERE manufacturerID='$id'");
    $row2 = mysqli_fetch_array($phone);

    $con->close();
?>

        <div class="container" style="text-align:center">
            <h1>Edit Manufacturer</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <div class="form-group">
                    <label style="font-size:20px" for="a">Manufacturer ID: </label>
                    <input style="font-size:20px" type="number" size="5" name="a" value="<?php echo $id ?>" readonly />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="b">Name: </label>
                    <input style="font-size:20px" type="text" name="b" value="<?php echo $row1['name'] ?>" required />
                </div>
                <div class="form-group">
                    <label style="font-size:20px" for="c">Phone </label>
                    <input style="font-size:20px" type="text" name="c" value="<?php echo $row2['phone'] ?>" required />
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