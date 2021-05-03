<?php

function manufacturersInsert($manufacturerID, $name, $phone)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO manufacturers VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $manufacturerID, $name, $phone);
    $stmt->execute();

    $stmt->close();

    /*
    $sql = "INSERT INTO manufacturers
    (`manufacturerID`,`name`, `phone`) VALUES
    ('$manufacturerID','$name', '$phone')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
    */
}

function manufacturersDelete($manufacturerID)
{
    require('db.php');
    $sql = "DELETE FROM manufacturers
    WHERE manufacturerID = '$manufacturerID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function manufacturersSelect()
{
    echo 'do the other called';
}
