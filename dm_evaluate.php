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
        <h4>
            <a href="dm_product.php" class="text-decoration-none mb-2"><i class="fas fa-backward text-dark mb-2" tittle="Back"></i></a>
        </h4>
        <h3><i class="fas fa-boxes mr-2"></i> Evaluate</h3>
            <hr>
            <?php
            if(isset($null)){
            ?>
            <h5 class="text-white bg-danger p-2">Please Fill All The Choice Given</h5> 
            <?php } ?>
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Linguistic Variabel</th>
                    <th scope="col">Definition</th>
                </tr>
            </thead>
            <tbody>
                <tr>  
                    <td>EG / EH</td>
                    <td>Extreme Good / Extreme High</td>
                </tr>
                <tr>  
                    <td>VG / VH</td>
                    <td>Very Good / Very High</td>
                </tr>
                <tr>  
                    <td>G / H</td>
                    <td>Good / High</td>
                </tr>
                <tr>  
                    <td>MG / MH</td>
                    <td>Medium Good / Medium High</td>
                </tr>
                <tr>  
                    <td>F / M</td>
                    <td>Fair / Medium</td>
                </tr>
                <tr>  
                    <td>MB / ML</td>
                    <td>Medium Bad / Medium Low</td>
                </tr>
                <tr>  
                    <td>B / L</td>
                    <td>Bad / Low</td>
                </tr>
                <tr>  
                    <td>VB / VL</td>
                    <td>Very Bad / Very Low</td>
                </tr>
                <tr>  
                    <td>EB / EL</td>
                    <td>Extreme Bad / Extreme Low</td>
                </tr>
            </tbody>
            </table>
            <form action="#" method="post">
            <?php
                $code = $_SESSION['product'];
                $querys = "SELECT * FROM alternative INNER JOIN product_alternative ON alternative.code_alternative = product_alternative.code_alternative WHERE product_alternative.code_product = '$code'";
                $sqls = mysqli_query($conn, $querys);
                $no = 1;
                while($rows = mysqli_fetch_array($sqls)){
            ?>
            <h4 style="margin-top: 50px;"><?php echo $rows['name_alternative']?></h4>
            <?php $alternative = $rows['code_alternative']?>
            <?php
                $code = $_SESSION['product'];
                $query = "SELECT * FROM criteria INNER JOIN product_criteria ON criteria.code_criteria = product_criteria.code_criteria WHERE product_criteria.code_product = '$code'";
                $sql = mysqli_query($conn, $query);
                $no = 1;
                while($row = mysqli_fetch_array($sql)){
                    $type = $row['type_criteria'];
                if($type == "Benefit"){
            ?>
                <p style="padding:10px"><?php echo $no ?>. <?php echo $row['name_criteria']?></p>
                <div class="form-check form-check-inline">
                    <input style="margin-left: 20px; height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="eg">
                    <label class="form-check-label" >EG</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="margin-left: 20px; height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="vg">
                    <label class="form-check-label" >VG</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="g">
                    <label class="form-check-label" >G</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="mg">
                    <label class="form-check-label" >MG</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="f" checked>
                    <label class="form-check-label" >F</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="mb">
                    <label class="form-check-label" >MB</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="b">
                    <label class="form-check-label" >B</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="vb">
                    <label class="form-check-label" >VB</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="eb">
                    <label class="form-check-label" >EB</label>
                </div>
                <?php $no++;?>
                <?php }else{?>
                    <p style="padding:10px"><?php echo $no ?>. <?php echo $row['name_criteria']?></p>
                <div class="form-check form-check-inline">
                    <input style="margin-left: 20px; height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="eg">
                    <label class="form-check-label" >EH</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="margin-left: 20px; height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="vg">
                    <label class="form-check-label" >VH</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="g">
                    <label class="form-check-label" >H</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px" class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="mg">
                    <label class="form-check-label" >MH</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="f" checked>
                    <label class="form-check-label" >F</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="mb">
                    <label class="form-check-label" >ML</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="b">
                    <label class="form-check-label" >L</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="vb">
                    <label class="form-check-label" >VL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input style="height:35px; width:35px"class="form-check-input" type="radio" name="<?php echo $alternative;echo $row['code_criteria']?>" value="eb">
                    <label class="form-check-label" >EL</label>
                </div>
                <?php $no++;?>
                <?php }?>
                <?php } ?>
            <?php } ?>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary p-2 pr-5 pl-5 mt-5" name="scorevendor">Submit</button>
                </div>
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