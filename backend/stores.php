<?php

function storesInsert($store_id, $address, $managerID)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO stores
    (`store_id`,`address`, `managerID`) VALUES
    (?, ?, ?)");
    $stmt->bind_param("isi", $store_id, $address, $managerID);
    $stmt->execute();

    $stmt->close();
    /*
    $sql = "INSERT INTO stores
    (`store_id`,`address`, `managerID`) VALUES
    ('$store_id','$address', '$managerID')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
    */
}

function storesDelete($store_id)
{
    require('db.php');
    $sql = "DELETE FROM stores
    WHERE store_id = '$store_id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function storesSelect()
{
    echo 'do the other called';
}
