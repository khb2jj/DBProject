<?php

function purchasesInsert($purchaseID, $customerID, $productID, $date)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO purchases
                            (`purchaseID`,`customerID`, `productID`, `date`) VALUES
                            (?,?,?,?)");
    $stmt->bind_param("iiis", $purchaseID, $customerID, $productID, $date);
    $stmt->execute();

    $stmt->close();

    /*
    $sql = "INSERT INTO purchases
    (`purchaseID`,`customerID`, `productID`, `date`) VALUES
    ('$purchaseID','$customerID', '$productID', '$date')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    */
    mysqli_close($con);

}

function purchasesDelete($purchaseID)
{
    require('db.php');
    $sql = "DELETE FROM purchases
    WHERE purchaseID = '$purchaseID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function purchasesSelect()
{
    echo 'do the other called';
}
