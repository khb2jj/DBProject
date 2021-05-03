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
    
    <div class="container" style="text-align:center">
        <h1> Inventory </h1>
    </div>

    <div class="w3-container">
        <button style="font-size: 20px; background-color:yellow; border: solid 2px; border-radius: 5px;" onClick='location.href="addInventory.php"'>Insert Inventory  <i class="fa fa-arrow-right"></i></button>
        <div style="float:right">
            <label style="font-size: 20px;" for="myInput">Search by Brand, Product, Price, Location</label>
            <input class="contentcontainer med left" style="font-size: 20px; border: solid 2px; border-radius: 5px;" type="text" id="myInput" onkeyup="filterTable()" placeholder="Search...">
        </div>
        <br></br>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white" id="myTable">
            <tr>
                <th>Product ID</th>
                <th>Brand Name</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Manufacturer ID</th>
                <th>Store ID</th>
                <th>Location</th>
                <th>Quantity</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            include('backend/db.php');
            include('backend/inventory.php');
            $sql = "SELECT * FROM (inventory Natural Join inventory_location Natural Join stores)";
            $result = $con->query($sql);

            if (isset($_POST['button1'])) {
                $a = $_REQUEST['a'];
                $b = $_REQUEST['b'];

                $sql = "DELETE inventory_location
                FROM inventory_location 
                Join inventory inv
                ON inventory_location.productID = inv.productID
                Join stores s
                ON s.store_id = inventory_location.store_ID
                WHERE inv.productID='$a'
                AND s.store_id='$b'";

                if (!mysqli_query($con, $sql)) {
                    die('Error: ' . mysqli_error($con));
                }
                $status = "New Record Deleted Successfully.";
                echo "<script> window.location.assign('Inventory.php'); </script>";
                $con->close();
            }

            if (isset($_POST['button2'])) {
                $a = $_REQUEST['a'];
                $b = $_REQUEST['b'];
                echo "<script> window.location.assign('editInventory.php?edit=" . $a . "&temp=" . $b . "'); </script>";
                $con->close();
            }

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td> <?php echo $row["productID"]; ?> </td>
                        <td> <?php echo $row["brand_name"]; ?> </td>
                        <td> <?php echo $row["product_name"]; ?> </td>
                        <td> <?php echo $row["price"]; ?> </td>
                        <td> <?php echo $row["manufacturerID"]; ?> </td>
                        <td> <?php echo $row["store_ID"]; ?> </td>
                        <td> <?php echo $row["address"]; ?> </td>
                        <td> <?php echo $row["quantity"]; ?> </td>
                        <td>
                            <form method="POST">
                                <input type="submit" name="button2" value="Edit" />
                                <p><input type="hidden" name="a" value="<?php echo $row["productID"]; ?>" /></p>
                                <p><input type="hidden" name="b" value="<?php echo $row["store_ID"]; ?>" /></p>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type="submit" name="button1" value="Delete" />
                                <p><input type="hidden" name="a" value="<?php echo $row["productID"]; ?>" /></p>
                                <p><input type="hidden" name="b" value="<?php echo $row["store_ID"]; ?>" /></p>
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

    <?php } // close out else tag ?>
    
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

        // for (var i = 0; i < tr.length; i++) {
        //     var firstCol = tds[0].textContent.toUpperCase();
        //     var secondCol = tds[1].textContent.toUpperCase();
        //     if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
        //         tr[i].style.display = "";
        //     } else {
        //         tr[i].style.display = "none";
        //     }      
        // }
    }
    </script>
    </body>
</html>