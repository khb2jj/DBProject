<!DOCTYPE html>
<html>
<?php
// header begins body tag
include('Header.php');
echo "<br> <br> <br> <br>";

// make the user login first 
if (!isset($_SESSION['user'])) {
    header('location: Home.php');
}
// if the user is logged in, display the home page content
else {
?>

    <div class="container" style="text-align:center">
        <h1> Customers Page </h1>
    </div>

    <div class="w3-container">
        <button class=" w3-button w3-dark-grey" onClick='location.href="customerupdate.php"'>Insert Customers  <i class="fa fa-arrow-right"></i></button>
        <br></br>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <tr>
                <td>Customer ID</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Address</td>
                <td>Name</td>
            </tr>
            <?php
            include('backend/db.php');
            include('backend/customers.php');
            $sql = "SELECT * FROM customers";
            $result = $con->query($sql);

            if (isset($_POST['button1'])) {
                $a = $_REQUEST['a'];

                customerDelete($a);
                $status = "New Record Deleted Successfully.";
                echo "<script> window.location.assign('Customers.php'); </script>";
            }

            if (isset($_POST['button2'])) {
                $a = $_REQUEST['a'];
                echo "<script> window.location.assign('editCustomer.php?edit=".$a."'); </script>";
            }

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td> <?php echo $row["customerID"]; ?> </td>
                        <td> <?php echo $row["email"]; ?> </td>
                        <td> <?php echo $row["phone"]; ?> </td>
                        <td> <?php echo $row["address"]; ?> </td>
                        <td> <?php echo $row["name"]; ?> </td>
                        <td>
                            <form method="POST">
                                <input type="submit" name="button2" value="Edit" />
                                <p><input type="hidden" name="a" value="<?php echo $row["customerID"]; ?>" /></p>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="submit" name="button1" value="Delete" />
                                <p><input type="hidden" name="a" value="<?php echo $row["customerID"]; ?>" /></p>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "0 results";
            }
            $con->close();
            ?>
        </table><br>

    </div>

<?php } // close out else tag 
?>

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