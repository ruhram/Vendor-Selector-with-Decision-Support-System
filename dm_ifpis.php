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
                <a class="nav-link text-white active" href="result.php"><i class="fas fa-tachometer-alt mr-2"></i>Result</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_score.php"><i class="fas fa-boxes mr-2"></i>Score Criteria</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_dma.php"><i class="fas fa-cube mr-2"></i>Decision Matrix Agregat</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_criteriaweight.php" ><i class="fas fa-weight-hanging mr-2"></i>Criteria Weight</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_dmw.php" ><i class="fas fa-cubes mr-2"></i>Weighted Entrophy Criteria</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_ifpis.php" ><i class="fas fa-plus-circle mr-2"></i>IFPIS</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_ifnis.php" ><i class="fas fa-minus-circle mr-2"></i>IFNIS</a><hr>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="dm_separation.php" style="margin-bottom: 320px"><i class="fas fa-ruler-horizontal mr-2"></i>Relative Closeness</a><hr>
            </li>
        </ul>
        </div>
        <div class="col-md-10 p-5">
        <h4>
            <a href="result.php" class="text-decoration-none mb-2"><i class="fas fa-backward text-dark mb-2" tittle="Back"></i></a>
        </h4>
        <h3><i class="fas fa-plus-circle mr-2"></i>Intuitionistic Fuzzy Positive-Ideal Solution</h3>
        <hr>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Criteria</th>
                <th scope="col"><i>µ<sup>^</sup><sup>+</sup></i></th>
                <th scope="col"><i>v<sup>^</sup><sup>+</sup></i></th>
                <th scope="col"><i>π<sup>^</sup><sup>+</sup></i></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM ifpis INNER JOIN criteria ON ifpis.code_criteria = criteria.code_criteria";
                $sql = mysqli_query($conn, $query);
                $no = 1;
                while($row = mysqli_fetch_array($sql)){
                    $type = $row['type_criteria'];
                    $mifpis = $row['m+'];
                    $vifpis = $row['v+'];
                    $rifpis = $row['r+'];
                    if($type = "Benefit"){
                    echo "
                    <tr>
                    <td>$no</td>
                    <td>$row[code_criteria]</td>
                    <td>$mifpis</td>
                    <td>$vifpis</td>
                    <td>$rifpis</td>
                    </tr>";
                    $no++;
                    }else{
                    echo "
                    <tr>
                    <td>$no</td>
                    <td><b>$row[code_criteria]/b></td>
                    <td>$mifpis</td>
                    <td>$vifpis</td>
                    <td>$rifpis</td>
                    </tr>";
                    $no++;
                    }
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