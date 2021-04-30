<?php

function repairsInsert($repairID, $customerID, $employeeID, $repair_description, $repair_date)
{
    require('db.php');
    $sql = "INSERT INTO repairs
    (`repairID`,`customerID`, `employeeID`, `repair_description`, `repair_date`) VALUES
    ('$repairID','$customerID', '$employeeID', '$repair_description', '$repair_date')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function repairsDelete($repairID)
{
    require('db.php');
    $sql = "DELETE FROM repairs
    WHERE repairID = '$repairID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function repairsSelect()
{
    echo 'do the other called';
}
