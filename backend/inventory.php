<?php

function inventoryInsert($productID, $brand_name, $product_name, $price, $manufacturerID, $storeID, $quantity)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO inventory
    (`productID`, `brand_name`, `product_name`, `price`, `manufacturerID`) VALUES
    (?, ?, ?, ?, ?)");
    $stmt->bind_param("issdi", $productID, $brand_name, $product_name, $price, $manufacturerID);
    $stmt->execute();
    
    $stmt->close();

    require('inv_loc.php');
    inv_locInsert($productID, $storeID, $quantity);
    
    /*
    $sql = "INSERT INTO inventory
    (`productID`, `brand_name`, `product_name`, `price`, `manufacturerID`) VALUES
    ('$productID','$brand_name', '$product_name', '$price', '$manufacturerID')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
    */
}

function inventoryDelete($productID)
{
    require('db.php');
    $sql = "DELETE FROM inventory
    WHERE productID = '$productID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function inventorySelect()
{
    echo 'do the other called';
}
