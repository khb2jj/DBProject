<?php

function inv_locInsert($productID, $store_ID, $quantity)
{
    require('db.php');
    $sql = "INSERT INTO inventory_location
    (`productID`,`store_ID`, `quantity`) VALUES
    ('$productID','$store_ID', '$quantity')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function inv_locDelete($productID, $store_ID)
{
    require('db.php');
    $sql = "DELETE FROM inventory_location
    WHERE productID = '$productID' AND store_ID = '$store_ID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function inv_locSelect()
{
    echo 'do the other called';
}
