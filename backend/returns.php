<?php

function returnsInsert($returnID, $customerID, $productID, $date)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO returns
                            (`returnID`,`customerID`, `productID`, `date`) VALUES
                            (?,?,?,?)");
    $stmt->bind_param("iiis", $returnID, $customerID, $productID, $date);
    $stmt->execute();

    $stmt->close();

    /*
    $sql = "INSERT INTO returns
    (`returnID`,`customerID`, `productID`, `date`) VALUES
    ('$returnID','$customerID', '$productID', '$date')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    */
    mysqli_close($con);

}

function returnsDelete($returnID)
{
    require('db.php');
    $sql = "DELETE FROM returns
    WHERE returnID = '$returnID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function returnsSelect()
{
    echo 'do the other called';
}
