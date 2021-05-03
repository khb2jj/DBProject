<?php

function rewardsInsert($rewardsID, $customerID, $r_available, $r_expiration)
{
    require('db.php');

    $stmt = $con->prepare("INSERT INTO rewards
                            (`rewardsID`,`customerID`, `r_available`, `r_expiration`) VALUES
                            (?,?,?,?)");
    $stmt->bind_param("iiss", $rewardsID, $customerID, $r_available, $r_expiration);
    $stmt->execute();

    $stmt->close();
    /*
    $sql = "INSERT INTO rewards
    (`rewardsID`,`customerID`, `r_available`, `r_expiration`) VALUES
    ('$rewardsID','$customerID', '$r_available', '$r_expiration')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    */
    mysqli_close($con);

}

function rewardsDelete($rewardsID)
{
    require('db.php');
    $sql = "DELETE FROM rewards
    WHERE rewardsID = '$rewardsID'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);

}

function returnsSelect()
{
    echo 'do the other called';
}
