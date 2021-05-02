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

<?php
    require('backend/db.php');
    require('backend/stores.php');
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $a = $_REQUEST['a'];
        $b = $_REQUEST['b'];
        $c = $_REQUEST['c'];

        storesInsert($a, $b, $c);

        $status = "New Record Inserted Successfully.";
        echo "<script> window.location.assign('Stores.php'); </script>";
        $con->close();
    }
}
?>

<head>
    <meta charset="utf-8">
    <title>Insert New Store </title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="form">
        <h1>Insert New Store</h1>
        <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />
            <p><input type="text" name="a" placeholder="Store ID" required /></p>
            <p><input type="text" name="b" placeholder="Address" required /></p>
            <p><input type="text" name="c" placeholder="Manager ID" required /></p>

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