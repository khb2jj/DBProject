<?php

function manufacturersInsert($man_id, $name, $phone)
{
    require('db.php');
    $sql = "INSERT INTO manufacturers
    (`man_id`,`name`, `phone`) VALUES
    ('$man_id','$name', '$phone')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function manufacturersDelete($man_id)
{
    require('db.php');
    $sql = "DELETE FROM manufacturers
    WHERE man_id = '$man_id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
}

function manufacturersSelect()
{
    echo 'do the other called';
}
