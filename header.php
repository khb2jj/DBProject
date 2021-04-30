<head>
  <meta name="author" content="Kirsten Bailey, Hoon Kim, John Light, Ranjodh Sandhu, Matt Rudisill">
  <meta name="description" content="The html and php required for the home page">  
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>John's Lights</title>
	
  <!-- Font Awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="icon" href="images/lightbulb.jpg"/>

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
  </style>
</head>

<body class="w3-light-grey">
  <?php session_start(); ?>
  <!-- Top container -->
  <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
    <span class="w3-bar-item w3-left"><img src="images/logo.png" style="width:100px"></span>
  </div>

  <!-- Sidebar -->
  <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container w3-row">
      <div class="w3-col s8 w3-bar">
        <h5><i class="fa fa-user-circle" style="padding-right:10px;"></i>Welcome <b><?php if(isset($_SESSION['user'])) echo $_SESSION['user'] . "!"?></b></h5>
      </div>
    </div>

    <!-- If the user is logged in then display the option to log out. -->
    <?php if(isset($_SESSION['user'])) { ?>
    <div class="w3-container w3-row">
      <div class="w3-col s8 w3-bar">
        <h5><a href="Logout.php"><i class="fa fa-arrow-circle-left fa-md" style="padding-right:10px;"></i>Logout</a></h5>
      </div>
    </div>
    <?php } // close if?>

    <hr>

    <div class="w3-container">
      <h5><b>Dashboard</b></h5>
    </div>

    <div class="w3-bar-block">
      <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
      <a href="Home.php" class="w3-bar-item w3-button w3-padding w3"><i class="fa fa-home fa-fw"></i>  Home</a>
      <a href="Customers.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Customers</a>
      <a href="Employees.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-vcard fa-fw"></i>  Employees</a>
      <a href="Stores.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-dropbox fa-fw"></i>  Stores & Manufacturers</a>
      <a href="Inventory.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Inventory</a>
      <a href="Repairs.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cogs fa-fw"></i>  Repairs</a>
      <a href="Returns.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-mail-reply fa-fw"></i>  Returns</a>
      <a href="Purchases.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-dollar fa-fw"></i>  Purchases</a>
      <a href="Rewards.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-gift fa-fw"></i>  Rewards</a><br><br>
    </div>

  <!-- Close sidebar-->
  </nav>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


  <div class="w3-main" style="margin-left:300px;margin-top:43px;">