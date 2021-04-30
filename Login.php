<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        authenticate();
    }

    function authenticate() {
        // if there is no user with this username, alert
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['pwd'] = $_POST['password'];  // in reality, don't save password directly, hash instead
    }
?>

<style>
.center {
     display: block;
     margin-left: auto;
     margin-right: auto;
     width: 50%;
   }
</style>

<img src="images/tlogo.png" style="width:500px" class="center">

</br>
</br>
<div class="container" style="text-align: center;">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" name ="username" size="20" placeholder="Enter Username" value="<?php if(!empty($_POST['username'])) echo $_POST['username']?>"/> <br>
        </div>

        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" size="30" placeholder="Enter Password" value="<?php if(!empty($_POST['password'])) echo $_POST['password']?>" />  <br>      
        </div> 
        <input type="submit" value="Login"/>    
    </form>
</div>
    