<!DOCTYPE html>
<html>
    <?php
        // header begins body tag
        include('Header.php');
        echo "<br>";
        
        // make the user login first 
        if(!isset($_SESSION['user'])) {
            header('location: Home.php');
        }
        // if the user is logged in, display the home page content
        else {
    ?>
    
    <!-- PUT PAGE CONTENT HERE -->
    <div class="container" style="text-align:center">
        <h1> Stores </h1>
    </div>
    <div class="w3-container">
        <button style="font-size: 20px; background-color:yellow; border: solid 2px; border-radius: 5px;" onClick='location.href="addStores.php"'>Insert Stores  <i class="fa fa-arrow-right"></i></button>
        <input class="contentcontainer med left" style="font-size: 20px; float: right; border: solid 2px; border-radius: 5px;" type="text" id="myInput" onkeyup="filterTable()" placeholder="Search...">

        <br></br>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white" id="myTable">
            <tr>
                <th>Store ID</th>
                <th>Store Address</th>
                <th>Manager ID</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            include('backend/db.php');
            include('backend/Stores.php');
            $sql = "SELECT * FROM stores";
            $result = $con->query($sql);

            if (isset($_POST['button1'])) {
                $a = $_REQUEST['a'];

                repairsDelete($a);
                $status = "New Record Deleted Successfully.";
                echo "<script> window.location.assign('Stores.php'); </script>";
                $con->close();
            }

            if (isset($_POST['button2'])) {
                $a = $_REQUEST['a'];
                echo "<script> window.location.assign('editStores.php?edit=" . $a . "'); </script>";
                $con->close();
            }

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td> <?php echo $row["store_id"]; ?> </td>
                        <td> <?php echo $row["address"]; ?> </td>
                        <td> <?php echo $row["managerID"]; ?> </td>
                        <td>
                            <form method="POST">
                                <input type="submit" name="button2" value="Edit" />
                                <p><input type="hidden" name="a" value="<?php echo $row["store_id"]; ?>" /></p>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="submit" name="button1" value="Delete" />
                                <p><input type="hidden" name="a" value="<?php echo $row["store_id"]; ?>" /></p>
                            </form>
                        </td>
                    </tr>
    <?php } // close out else tag 
    } else {
        echo "0 results";
    }
    $con->close();?>
            </table><br>

</div>

<div class="container" style="text-align:center">
        <h1> Manufacturers </h1>
    </div>
    <div class="w3-container">
        <button style="font-size: 20px; background-color:yellow; border: solid 2px; border-radius: 5px;" onClick='location.href="addManufacturers.php"'>Insert Manufacturers  <i class="fa fa-arrow-right"></i></button>
        <input class="contentcontainer med left" style="font-size: 20px; float: right; border: solid 2px; border-radius: 5px;" type="text" id="myInput" onkeyup="filterTable()" placeholder="Search...">

        <br></br>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white" id="myTable">
            <tr>
                <th>Manufacturer ID</th>
                <th>Manufacturer Name</th>
                <th>Manufacturer Phone</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            include('backend/db.php');
            include('backend/manufacturers.php');
            $sql = "SELECT * FROM manufacturers";
            $result = $con->query($sql);

            if (isset($_POST['button1'])) {
                $a = $_REQUEST['a'];

                repairsDelete($a);
                $status = "New Record Deleted Successfully.";
                echo "<script> window.location.assign('Stores.php'); </script>";
                $con->close();
            }

            if (isset($_POST['button2'])) {
                $a = $_REQUEST['a'];
                echo "<script> window.location.assign('editManufacturers.php?edit=" . $a . "'); </script>";
                $con->close();
            }

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td> <?php echo $row["manufacturerID"]; ?> </td>
                        <td> <?php echo $row["name"]; ?> </td>
                        <td> <?php echo $row["phone"]; ?> </td>
                        <td>
                            <form method="POST">
                                <input type="submit" name="button2" value="Edit" />
                                <p><input type="hidden" name="a" value="<?php echo $row["manufacturerID"]; ?>" /></p>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="submit" name="button1" value="Delete" />
                                <p><input type="hidden" name="a" value="<?php echo $row["manufacturerID"]; ?>" /></p>
                            </form>
                        </td>
                    </tr>
    <?php } // close out else tag 
    } else {
        echo "0 results";
    }
    $con->close();?>
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
    </script>
    </body>
    </html>