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
                <a href="admin_dashboard.php" class="navbar-brand">
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
                <a class="nav-link text-white active" href="admin_dashboard.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin_product.php"><i class="fas fa-boxes mr-2"></i>Select Product</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin_alternative.php"><i class="fas fa-cube mr-2"></i>Alternative</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin_criteria.php"><i class="fas fa-cubes mr-2"></i>Criteria</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin_admin.php"><i class="fas fa-users-cog mr-2"></i>Admin</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin_decisionmaker.php" style="margin-bottom: 260px"><i class="fas fa-user-tie mr-2"></i>Decision Maker</a><hr>
            </li>
        </ul>
        </div>
        <div class="col-md-10 p-5">
        <h4>
            <a href="admin_alternative.php" class="text-decoration-none mb-2"><i class="fas fa-backward text-dark mb-2" tittle="Back"></i></a>
        </h4>
            <h3><i class="fas fa-plus mr-2"></i> Add Alternative</h3>
            <hr>
            <form action="#" method="post">
            <?php
                    $code = $_GET['code'];
                    $edit = "SELECT * FROM `alternative` WHERE `code_alternative` = '$code'";
                    $query = mysqli_query($conn, $edit);
                    $row = mysqli_fetch_array($query);
                    $code = $row['code_alternative'];
                    $name = $row['name_alternative'];
            ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="code">Code</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="code" class="form-control" placeholder="Code" id="code" value="<?php echo $code?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">Alternative Name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Alternative Name" id="name" value="<?php echo $name?>">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-5">
                        <button type="submit" class="btn btn-primary p-2 pr-5 pl-5" name="editalternative">Submit</button>
                    </div>
                    <br>
                    <br>
                    </form>
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