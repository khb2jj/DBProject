<?php

function inventoryInsert($productID, $brand_name, $product_name, $price, $manufacturerID)
{
    require('db.php');
    $sql = "INSERT INTO inventory
    (`productID`, `brand_name`, `product_name`, `price`, `manufacturerID`) VALUES
    ('$productID','$brand_name', '$product_name', '$price', '$manufacturerID')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function inventoryDelete($productID)
{
    require('db.php');
    $sql = "DELETE FROM inventory
    WHERE productID = '$productID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function inventorySelect()
{
    echo 'do the other called';
}
