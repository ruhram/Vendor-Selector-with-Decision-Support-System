<?php 
include("connect.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">

    <title>Index</title>

    <style>
    .navbar{
        color: white;
    }
    .icon a{
        color: white;
        text-decoration: none;
    }
    .icon a:hover{
        color: #555;
    }
    .footer-copyright{
        background-color: #2f2f2f;
        color: white;
    }
    .card-body-icon{
        position: absolute;
        z-index: 0;
        top: 25px;
        right: 4px;
        opacity: 0.4;
        font-size: 90px;
    }
    .card a{
        text-decoration: none;
    }
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary fixed-top" style="background-color: black" id="bar">
            <div class="container">
                <a href="dm_dashboard.php" class="navbar-brand">
                    <img src="img/Supplier.png" width="30" height="30" class="d-inline-block align-top" alt="">  Supplier Selection</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>
                <span class="mr-5"><h5>Welcome <?php echo $_SESSION["name"]?></h5></span>
                <div class="icon">
                    <h4>
                        <a href="admin_dashboard.php?logout='1'" class="text-decoration-none"><i class="fas fa-sign-out-alt mr-2" data-toggle="tooltip" title="Logout"></i></a>
                    </h4>
                </div>
        </nav>
        
        <div class="row no-gutters mt-5">
        <div class="col-md-2 pt-2 sidebar" style="background-color: #0478B3">
        <ul class="nav flex-column pl-3 pr-3 pb-3 p-1 pt-3" style="background-color: #0478B3">
            <li class="nav-item">
                <a class="nav-link text-white active" href="dm_dashboard.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_product.php"><i class="fas fa-boxes mr-2"></i>Select Product</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_alternative.php"><i class="fas fa-cube mr-2"></i>Alternative</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_criteria.php" style="margin-bottom: 340px"><i class="fas fa-cubes mr-2"></i>Criteria</a><hr>
            </li>
        </ul>
        </div>
        <div class="col-md-10 p-5">
            <h3><i class="fas fa-users-cog"></i> Profile Decision Maker</h3>
            <hr>
            <div class="row">
                <div class="col-md-2 mr-5">
                    <img src="img/User.png" alt="Avatar" style="width:200px; border-radius:50%;">
                </div>
                <div class="col-md-9">
                    <?php
                        $code = $_SESSION["code_dm"];
                        $result = mysqli_query($conn, "SELECT * FROM `decisionmaker` WHERE `code_dm` = '$code'");
                        $row = mysqli_fetch_array($result);
                        $code = $row['code_dm'];
                        $username = $row['username_dm'];
                        $name = $row['name_dm'];
                        $nik = $row['nik_dm'];
                        $posisi = $row['position_dm'];
                        $importance = $row['importance_dm'];
                    ?>
                    <div class="p-2" id="name">
                        <h7><b><span style="margin-right: 55px;">Name</span> <span class="mr-2">:</span> </b> <?php echo $name ?></h7>
                    </div>
                    <div class="p-2" id="username">
                        <h7><b><span class="mr-4">Username</span> <span class="mr-2">:</span> </b> <?php echo $username ?></h7>
                    </div>
                    <div class="p-2" id="code">
                        <h7><b><span style="margin-right: 60px;">Code</span> <span class="mr-2">:</span> </b> <?php echo $code ?></h7>
                    </div>
                    <div class="p-2" id="nik">
                        <h7><b><span style="margin-right: 70px;">NIK</span> <span class="mr-2">:</span> </b> <?php echo $nik ?></h7>
                    </div>
                    <div class="p-2" id="position">
                        <h7><b><span style="margin-right: 37px;">Position</span> <span class="mr-2">:</span> </b> <?php echo $posisi ?></h7>
                    </div>
                    <div class="p-2" id="importance">
                        <h7><b><span style="margin-right: 12px;">Importance</span> <span class="mr-2">:</span> </b> <?php echo $importance ?></h7>
                    </div>
                </div> 
            </div>
            <h3><i class="fas fa-history mt-4"></i> Vendor Selection History</h3>
            <hr>
            <div class="text-center mb-2">
                <a href="history.php" class="text-white" style="text-decoration: none; background-color:#0478B3; padding-right:100px; padding-left:100px; padding-top:10px; padding-bottom: 10px"> See History</a>
            </div>
            <h3><i class="fas fa-poll-h mt-4"></i> Result</h3>
            <div class="text-center">
            <?php 
            if($_SESSION['result']){?>
                <a href="result.php" class="text-white" style="text-decoration: none; background-color:#0478B3; padding-right:100px; padding-left:100px; padding-top:10px; padding-bottom: 10px"> See Result</a>
            <?php }?>
            </div>
        </div>
    </div>
        <footer>
            <div class="footer-copyright text-center py-3">© 2020 Copyright: 
            </div>
        </footer>
    <script src="https://kit.fontawesome.com/0ae6bae9be.js" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>