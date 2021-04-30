<?php session_start(); ?>
<?php
    if(count($_SESSION) > 0)
    {
        foreach($_SESSION as $k => $v)
        {
            unset($_SESSION[$k]);  // remove key-value pair from a session object
        }
        session_destroy();  // completely remove the instance
        //echo "sessionID = " . session_id() . "<br/>";

        setcookie("PHPSESSID", "", time()-3600, "/");
    }  
    header('location: Home.php');
?>