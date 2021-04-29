<?php

function customerInsert($customerID, $email, $phone, $address, $name)
{
    require('db.php');
    $sql = "INSERT INTO customers
    (`customerID`,`email`, `phone`, `address`, `name`) VALUES
    ('$customerID','$email', '$phone', '$address', '$name')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function customerDelete($customerID)
{
    require('db.php');
    $sql = "DELETE FROM customers
    WHERE customerID = '$customerID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function customerSelect()
{
    echo 'do the other called';
}
