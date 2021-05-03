<?php

function customerInsert($customerID, $email, $phone, $address, $name)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO customers (`customerID`,`email`, `phone`, `address`, `name`) 
                                     VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $customerID, $email, $phone, $address, $name);
    $stmt->execute();
    
    $stmt->close();
    
    //$sql = "INSERT INTO customers (`customerID`,`email`, `phone`, `address`, `name`) VALUES ('$customerID','$email', '$phone', '$address', '$name')";
    //mysqli_close($con);
}

function customerDelete($customerID)
{
    require('db.php');
    $sql = "DELETE FROM customers
    WHERE customerID = '$customerID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
}

function customerSelect()
{
    echo 'do the other called';
}
