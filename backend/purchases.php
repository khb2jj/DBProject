<?php

function purchasesInsert($purchaseID, $customerID, $productID, $storeID, $date)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO purchases
                            (`purchaseID`,`customerID`, `productID`, `storeID`, `date`) VALUES
                            (?,?,?,?,?)");
    $stmt->bind_param("iiiis", $purchaseID, $customerID, $productID, $storeID, $date);
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
