<!DOCTYPE html>
<html>
<?php
// header begins body tag
include('Header.php');
echo "<br>";

// make the user login first 
if (!isset($_SESSION['user'])) {
    header('location: Home.php');
}
// if the user is logged in, display the home page content
else {
?>

    <div class="container" style="text-align:center">
        <h1> Repairs </h1>
    </div>

    <div class="w3-container">
        <button style="font-size: 20px; background-color:yellow; border: solid 2px; border-radius: 5px;" onClick='location.href="addRepairs.php"'>Insert Repairs  <i class="fa fa-arrow-right"></i></button>
        <div style="float:right">
            <label style="font-size: 20px;" for="myInput">Search by Description, Date</label>
            <input class="contentcontainer med left" style="font-size: 20px; border: solid 2px; border-radius: 5px;" type="text" id="myInput" onkeyup="filterTable()" placeholder="Search...">
        </div>
        <br></br>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white" id="myTable">
            <tr>
                <th>Repair ID</th>
                <th>Customer ID</th>
                <th>Employee ID</th>
                <th>Description</th>
                <th>Date</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            include('backend/db.php');
            include('backend/repairs.php');
            $sql = "SELECT * FROM repairs";
            $result = $con->query($sql);

            if (isset($_POST['button1'])) {
                $a = $_REQUEST['a'];

                repairsDelete($a);
                $status = "New Record Deleted Successfully.";
                echo "<script> window.location.assign('Repairs.php'); </script>";
                $con->close();
            }

            if (isset($_POST['button2'])) {
                $a = $_REQUEST['a'];
                echo "<script> window.location.assign('editRepairs.php?edit=" . $a . "'); </script>";
                $con->close();
            }

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td> <?php echo $row["repairID"]; ?> </td>
                        <td> <?php echo $row["customerID"]; ?> </td>
                        <td> <?php echo $row["employeeID"]; ?> </td>
                        <td> <?php echo $row["repair_description"]; ?> </td>
                        <td> <?php echo $row["repair_date"]; ?> </td>
                        <td>
                            <form method="POST">
                                <input type="submit" name="button2" value="Edit" />
                                <p><input type="hidden" name="a" value="<?php echo $row["repairID"]; ?>" /></p>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="submit" name="button1" value="Delete" />
                                <p><input type="hidden" name="a" value="<?php echo $row["repairID"]; ?>" /></p>
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

    function filterTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                cell = tr[i].getElementsByTagName("td")[j];
                if (cell) {
                    if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }
</script>
</body>

</html>