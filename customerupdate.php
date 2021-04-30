<?php
require('backend/db.php');
require('backend/customers.php');
$status = "";
if (isset($_POST['new']) && $_POST['new'] == 1) {
    $a = $_REQUEST['a'];
    $b = $_REQUEST['b'];
    $c = $_REQUEST['c'];
    $d = $_REQUEST['d'];
    $e = $_REQUEST['e'];

    customerInsert($a, $b, $c, $d, $e);

    $status = "New Record Inserted Successfully.";
    echo "<script> window.location.assign('index.php'); </script>";
}

if (isset($_POST['new']) && $_POST['new'] == 2) {
    $a = $_REQUEST['a'];

    customerDelete($a);
    $status = "Record Deleted Successfully.
    </br></br><a href='view.php'>View Inserted Record</a>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Insert New Record</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="form">
        <p><a href="dashboard.php">Dashboard</a>
            | <a href="view.php">View Records</a>
            | <a href="logout.php">Logout</a></p>
        <div>
            <h1>Insert New Record</h1>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />
                <p><input type="text" name="a" placeholder="Customer ID" required /></p>
                <p><input type="text" name="b" placeholder="Email" required /></p>
                <p><input type="text" name="c" placeholder="Phone" required /></p>
                <p><input type="text" name="d" placeholder="Address" required /></p>
                <p><input type="text" name="e" placeholder="name" required /></p>

                <p><input name="submit" type="submit" value="Submit" /></p>
            </form>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="2" />
                <p><input type="text" name="a" placeholder="Customer ID" required /></p>
                <p><input name="submit" type="submit" value="Submit" /></p>
            </form>
            <p style="color:#FF0000;"><?php echo $status; ?></p>
        </div>
    </div>
</body>

</html>