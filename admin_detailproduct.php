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
            <a href="admin_product.php" class="text-decoration-none mb-2"><i class="fas fa-backward text-dark mb-2" tittle="Back"></i></a>
        </h4>
            <h3><i class="fas fa-cubes mr-2"></i> Detail Product</h3>
            <hr>
            <?php
                    $code = $_GET['code'];
                    $edit = "SELECT * FROM `product` WHERE `code_product` = '$code'";
                    $query = mysqli_query($conn, $edit);
                    $row = mysqli_fetch_array($query);
                    $code = $row['code_product'];
                    $name = $row['name_product'];
                    $definition = $row['definition_product'];
            ?>
            <div class="p-2" id="name">
                <h7><b><span style="margin-right: 87px;">Criteria </span> <span class="mr-2">:</span> </b> <?php echo $name ?></h7>
            </div>
            <div class="p-2" id="code">
                <h7><b><span style="margin-right: 105px;">Code</span> <span class="mr-2">:</span> </b> <?php echo $code ?></h7>
            </div>
            <div class="p-2" id="definition">
                <h7><b><span style="margin-right: 68px;">Definition</span> <span class="mr-2">:</span> </b> <?php echo $definition ?></h7>
            </div>
            <div class="p-2" id="dm">
                <h7><b><span style="margin-right: 28px;">Decision Maker</span> <span class="mr-2">:</span> </b></h7>
            </div>
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">Code</th>
                <th scope="col">Decision Maker</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM product_dm INNER JOIN decisionmaker ON product_dm.code_dm = decisionmaker.code_dm WHERE product_dm.code_product = '$code'";
                $sql = mysqli_query($conn, $query);
                $no = 1;
                while($row = mysqli_fetch_array($sql)){

                echo "
                    <tr>
                    <td>$row[code_dm]</td>
                    <td>$row[name_dm]</td>
                    </tr>";
                }
            ?>
            </tbody>
            </table>
            <div class="p-2" id="Alternative">
                <h7><b><span style="margin-right: 28px;">Alternative</span> <span class="mr-2">:</span> </b></h7>
            </div>
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">Code</th>
                <th scope="col">Alternative</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM product_alternative INNER JOIN alternative ON product_alternative.code_alternative = alternative.code_alternative WHERE product_alternative.code_product = '$code'";
                $sql = mysqli_query($conn, $query);
                $no = 1;
                while($row = mysqli_fetch_array($sql)){

                echo "
                    <tr>
                    <td>$row[code_alternative]</td>
                    <td>$row[name_alternative]</td>
                    </tr>";
                }
            ?>
            </tbody>
            </table>
            <div class="p-2" id="Criteria">
                <h7><b><span style="margin-right: 50px;">Criteria</span> <span class="mr-2">:</span> </b></h7>
            </div>
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">Code</th>
                <th scope="col">Criteria</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM product_criteria INNER JOIN criteria ON product_criteria.code_criteria = criteria.code_criteria WHERE product_criteria.code_product = '$code'";
                $sql = mysqli_query($conn, $query);
                $no = 1;
                while($row = mysqli_fetch_array($sql)){

                echo "
                    <tr>
                    <td>$row[code_criteria]</td>
                    <td>$row[name_criteria]</td>
                    </tr>";
                }
            ?>
            </tbody>
            </table>
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