<?php
session_start();

if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->

        <!-- Navbar & Hero End -->


        <!-- Menu Start -->
        <?php
        if(isset($_SESSION['login_user1'])){
        
        ?>
        
        
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                    <a href="index.php">| FoodToGo| </a>
                    <a href="#"><span class="glyphicon glyphicon-user"></span>| Welcome |<?php echo $_SESSION['login_user1']; ?> </a>
                    <a href="myrestaurant.php">| MANAGER CONTROL PANEL| </a>
                    <a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span>| Log Out | 
        <?php
        }
        else if (isset($_SESSION['login_user2'])) {
          ?>
            <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
            <a href="index.php">| FoodToGo| </a>      
            <a href="#"><span class="glyphicon glyphicon-user"></span>| Welcome |<?php echo $_SESSION['login_user2']; ?> </a>
                   <a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span>| Food Zone |</a>
                  <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>| Cart  |(<?php
                      if(isset($_SESSION["cart"])){
                      $count = count($_SESSION["cart"]); 
                      echo "$count"; 
                    }
                      else
                        echo "0";
                      ?>) </a>
                    <a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span>| Log Out |</a>
                  </ul>
          <?php        
        }
        else {
        
          ?>
        
        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="menu.html" class="nav-item nav-link">Menu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sign Up</a>
                            <div class="dropdown-menu m-0">
                                <a href="customersignup.php" class="dropdown-item">User Sign Up</a>
                                <a href="managersignup.php" class="dropdown-item">Restaurant Sign Up</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Login</a>
                            <div class="dropdown-menu m-0">
                                <a href="customerlogin.php" class="dropdown-item">User Login</a>
                                <a href="customerlogin.php" class="dropdown-item">Chef Login</a>
                                <a href="adminlogin.php" class="dropdown-item">Admin Login</a>
        
        <?php
        }
        ?>
        
        
                </div>
        
              </div>
            </nav>
        


           <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
            </div>
        
        <div class="jumbotron">
          <div class="container text-center">
            <h1>Welcome To FoodToGo</h1>      
            <!--p>Let food be thy medicine and medicine be thy food</p-->
          </div>
        </div>
        
        
        
        
        <div class="container" style="width:95%;">
        
        <!-- Display all Food from food table -->
        <?php
        
        require 'connection.php';
        $conn = Connect();
        
        $sql = "SELECT * FROM FOOD WHERE options = 'ENABLE' ORDER BY F_ID";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0)
        {
          $count=0;
        
          while($row = mysqli_fetch_assoc($result)){
            if ($count == 0)
              echo "<div class='row'>";
        
        ?>
        <div class="col-md-3">
        <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
        <div class="mypanel" align="center";>
        <img src="<?php echo $row["images_path"]; ?>" class="img-responsive">
        <h4 class="text-dark"><?php echo $row["name"]; ?></h4>
        <h5 class="text-info"><?php echo $row["description"]; ?></h5>
        <h5 class="text-danger"> <?php echo $row["price"]; ?>/-</h5>
        <input type="hidden" min="1" max="25" name="quantity" class="form-control" value="001" style="width: 60px;"> 
        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
        <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
        <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="sunday">
        
        </form>
         <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
         <input type="hidden" min="1" max="25" name="quantity" class="form-control" value="002" style="width: 60px;"> 
        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
        <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
        <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Monday">
        </form>
        <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
        <input type="hidden" min="1" max="25" name="quantity" class="form-control" value="003" style="width: 60px;"> 
        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
        <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
        <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Tuesday">
        </form>
        <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
        <input type="hidden" min="1" max="25" name="quantity" class="form-control" value="004" style="width: 60px;"> 
        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
        <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
        <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Wednesday">
        </form>
        <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
        <input type="hidden" min="1" max="25" name="quantity" class="form-control" value="005" style="width: 60px;"> 
        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
        <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
        <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Thursday">
        <div class="jumbotron">
          <div class="container text-center">
            <h1></h1>      
            <!--p>Let food be thy medicine and medicine be thy food</p-->
          </div>
        </div>
        </form>
        </div>   
             
        </div>
        
        <?php
        $count++;
        if($count==4)
        {
          echo "</div>";
          $count=0;
        }
        }
        ?>
        
        </div>
        </div>
        <?php
        }
        else
        {
          ?>
        
          <div class="container">
            <div class="jumbotron">
              <center>
                 <label style="margin-left: 5px;color: red;"> <h1>Oops! No food is available.</h1> </label>
                <p>Stay Hungry...! :P</p>
              </center>
               
            </div>
          </div>
        
          <?php
        
        }
        
        ?>
        
        <!-- Menu End -->
        

        <!-- Footer Start -->
        
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>