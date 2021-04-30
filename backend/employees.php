<?php

function employeesInsert($em_id, $username, $password, $name, $store_id, $phone, $wage, $is_manager)
{
    require('db.php');
    $sql = "INSERT INTO employees
    (`em_id`, `username`, `password`, `name`, `store_id`, `phone`, `wage`, `is_manager`) VALUES
    ('$em_id', '$username', '$password', '$name', '$store_id', '$phone', '$wage', '$is_manager')";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
}

function employeesDelete($em_id)
{
    require('db.php');
    $sql = "DELETE FROM employees
    WHERE em_id = '$em_id'";

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
}

function employeesSelect()
{
    echo 'do the other called';
}
