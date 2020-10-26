<?php
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "supplier";
    session_start();

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die("Koneksi Database Gagal");

     //Login Admin clicked
     if(isset($_POST["login_admin"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(empty($username) && empty($password)){
            $null = true;
        }else{
        $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE username_admin = '$username'");
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            if($row['password_admin'] == $password){
                $id = $row['id_admin'];
                $_SESSION["id_admin"] = $id;
                $_SESSION["name"] = "$username";
                $_SESSION["login"] = true;
                $result = mysqli_query($conn, "SELECT * FROM `score`");
                if(mysqli_num_rows($result) > 0){
                    $_SESSION["result"] = TRUE;
                }else{
                    $_SESSION["result"] = FALSE;
                }
                header("location: admin_dashboard.php");
            }else{
                $error_password = true;
            }
        }else{
            $error_username = true;
        }
        }   
    }

    if(isset($_POST["login_dm"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(empty($username) && empty($password)){
            $null = true;
        }else{
        $result = mysqli_query($conn, "SELECT * FROM `decisionmaker` WHERE username_dm = '$username'");
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            if($row['password_dm'] == $password){
                $code = $row['code_dm'];
                $name = $row['name_dm'];
                $_SESSION["code_dm"] = $code;
                $_SESSION["name"] = "$name";
                $_SESSION["login"] = true;
                $result = mysqli_query($conn, "SELECT * FROM `score`");
                if(mysqli_num_rows($result) > 0){
                    $_SESSION["result"] = TRUE;
                }else{
                    $_SESSION["result"] = FALSE;
                }
                header("location: dm_dashboard.php");
            }else{
                $error_password = true;
            }
        }else{
            $error_username = true;
        }
        }   
    }

    //logout clicked
    if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['name']);
		header('location: index.php');
    }

    if(isset($_POST["addcriteria"])){
        $code = $_POST["code"];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $sector = $_POST['sector'];
        $desc = $_POST["desc"];

            $query = "INSERT INTO `criteria`(`code_criteria`, `name_criteria`, `type_criteria`, `sector_criteria`, `description_criteria`) VALUES ('$code','$name','$type','$sector','$desc')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_criteria.php?success="1"');
    }

    if(isset($_GET['deletecriteria'])){
        $code = $_GET['deletecriteria'];
        $result = mysqli_query($conn, "SELECT `code_criteria` FROM `product_criteria` WHERE `code_criteria` = '$code'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
        $query = "DELETE FROM `criteria` WHERE `code_criteria` = '$code'" ;
        $sql = mysqli_query($conn, $query);
        header('location: admin_criteria.php?delete="1"');
        }else{
        header('location: admin_criteria.php?cannot="1"');
        }
    }

    if(isset($_POST["editcriteria"])){
        $code = $_POST["code"];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $sector = $_POST['sector'];
        $desc = $_POST["desc"];

            $query = "UPDATE `criteria` SET `code_criteria`='$code',`name_criteria`='$name',`type_criteria`='$type',`sector_criteria`='$sector',`description_criteria`='$desc' WHERE `code_criteria`='$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_criteria.php?edit="1"');
    }

    if(isset($_POST["addalternative"])){
        $code = $_POST["code"];
        $name = $_POST['name'];

            $query = "INSERT INTO `alternative`(`code_alternative`, `name_alternative`) VALUES ('$code','$name')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_alternative.php?success="1"');
    }

    if(isset($_GET['deletealternative'])){
        $code = $_GET['deletealternative'];
        $result = mysqli_query($conn, "SELECT `code_alternative` FROM `product_alternative` WHERE `code_alternative` = '$code'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
            $query = "DELETE FROM `alternative` WHERE `code_alternative` = '$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_alternative.php?delete="1"');
        }else{
            header('location: admin_alternative.php?cannot="1"');
        }
    }

    if(isset($_POST["editalternative"])){
        $code = $_POST["code"];
        $name = $_POST['name'];

            $query = "UPDATE `alternative` SET `code_alternative`='$code',`name_alternative`='$name' WHERE `code_alternative`='$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_alternative.php');
    }

    if(isset($_POST["adddm"])){
        $code = $_POST["code"];
        $name = $_POST['name'];
        $nik = $_POST['nik'];
        $position = $_POST['position'];
        $importance = $_POST["importance"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $result = mysqli_query($conn, "SELECT `username_dm` FROM `decisionmaker` WHERE `username_dm` = '$username'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
            $query = "INSERT INTO `decisionmaker`(`code_dm`, `name_dm`, `nik_dm`, `position_dm`, `importance_dm`,`username_dm`,`password_dm`) VALUES ('$code','$name','$nik','$position','$importance','$username','$password')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_decisionmaker.php?success="1"');
        }else{
            header('location: admin_decisionmaker.php?already="1"');
        }
    }

    if(isset($_POST["editdm"])){
        $code = $_POST["code"];
        $name = $_POST['name'];
        $nik = $_POST['nik'];
        $position = $_POST['position'];
        $importance = $_POST["importance"];

            $query = "UPDATE `decisionmaker` SET `code_dm`='$code',`name_dm`='$name',`nik_dm`='$nik',`position_dm`='$position',`importance_dm`='$importance',`username_dm`='$username',`password_dm`='$password' WHERE `code_dm`='$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_decisionmaker.php?edit="1"');
    }

    if(isset($_GET['deletedm'])){
        $code = $_GET['deletedm'];
        $result = mysqli_query($conn, "SELECT `code_dm` FROM `product_dm` WHERE `code_dm` = '$code'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
        $query = "DELETE FROM `decisionmaker` WHERE `code_dm` = '$code'";
        $sql = mysqli_query($conn, $query);
        header('location: admin_decisionmaker.php?delete="1"');
        }else{
        header('location: admin_decisionmaker.php?cannot="1"');
        }
    }

    if(isset($_POST["addadmin"])){
        $name = $_POST["name"];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nik = $_POST['nik'];
        $position = $_POST['position'];
        $importance = $_POST["importance"];
        $result = mysqli_query($conn, "SELECT `username_admin` FROM `admin` WHERE `username_admin` = '$username'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
            $query = "INSERT INTO `admin`(`nama_admin`, `username_admin`, `password_admin`, `nik_admin`, `posisi_admin`, `importance_admin`) VALUES ('$name','$username','$password','$nik','$position','$importance')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_admin.php?success="1"');
        }else{
            header('location: admin_admin.php?already="1"');
        }
    }

    if(isset($_GET['deleteadmin'])){
        $code = $_GET['deleteadmin'];
        $result = mysqli_query($conn, "SELECT `username_admin` FROM `admin`");
        $rowcount = mysqli_num_rows($result);
        if($rowcount > 1){
            $query = "DELETE FROM `admin` WHERE `id_admin` = '$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_admin.php?delete="1"');
        }else{
            header('location: admin_admin.php?cannot="1"');
        }
    }

    if(isset($_POST["editadmin"])){
        $code = $_SESSION["code"];
        $name = $_POST["name"];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nik = $_POST['nik'];
        $position = $_POST['position'];
        $importance = $_POST["importance"];
        
            $query = "UPDATE `admin` SET `nama_admin`='$name',`username_admin`='$username',`password_admin`='$password',`nik_admin`='$nik',`posisi_admin`='$position',`importance_admin`='$importance' WHERE id_admin = '$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_admin.php?edit="1"');
    }


    if(isset($_POST["addproduct"])){
        $code = $_POST["code"];
        $name = $_POST['name'];
        $definition = $_POST['definition'];
        $result = mysqli_query($conn, "SELECT `code_product` FROM `product` WHERE `code_product` = '$code'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
            $query = "INSERT INTO `product`(`code_product`, `name_product`, `definition_product`) VALUES ('$code','$name','$definition')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_product.php?success="1"');
        }else{
            header('location: admin_product.php?already="1"');
        }
    }

    if(isset($_POST["editproduct"])){
        $code = $_POST["code"];
        $name = $_POST['name'];
        $definition = $_POST['definition'];

            $query = "UPDATE `product` SET `code_product`='$code',`name_product`='$name',`definition_product`='$definition' WHERE `code_product`='$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_product.php?edit="1"');
    }

    if(isset($_GET['deleteproduct'])){
        $code = $_GET['deleteproduct'];
        $result = mysqli_query($conn, "SELECT `code_product` FROM `product_alternative` WHERE `code_product` = '$code'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
            $query = "DELETE FROM `product` WHERE `code_product` = '$code'";
            $sql = mysqli_query($conn, $query);
            header('location: admin_product.php?delete="1"');
        }else{
            header('location: admin_product.php?cannot="1"');
        }
    }

    if(isset($_POST["addproductalternative"])){
        $product = $_POST["product"];
        $alternative = $_POST['alternative'];
        $result = mysqli_query($conn, "SELECT `code_alternative` FROM `product_alternative` WHERE `code_alternative` = '$alternative'");
        $rowcount = mysqli_num_rows($result);
        if(mysqli_num_rows($result) == 0){
            $query = "INSERT INTO `product_alternative`(`code_product`, `code_alternative`) VALUES ('$product','$alternative')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_addproductalternative.php?success="1"');
        }else{
            header('location: admin_addproductalternative.php?already="1"');
        }
    }

    if(isset($_GET["deleteproductalternative"])){
        $code = $_GET["deleteproductalternative"];
        $result = mysqli_query($conn, "DELETE FROM `product_alternative` WHERE `id` = '$code'");
        header('location: admin_addproductalternative.php');
    }

    if(isset($_POST["addproductcriteria"])){
        $product = $_POST["product"];
        $criteria = $_POST['criteria'];
        $result = mysqli_query($conn, "SELECT `code_criteria` FROM `product_criteria` WHERE `code_criteria` = '$criteria'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
            $query = "INSERT INTO `product_criteria`(`code_product`, `code_criteria`) VALUES ('$product','$criteria')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_addproductcriteria.php?success="1"');
        }else{
            header('location: admin_addproductcriteria.php?already="1"');
        }
    }

    if(isset($_GET["deleteproductcriteria"])){
        $code = $_GET["deleteproductcriteria"];
        $result = mysqli_query($conn, "DELETE FROM `product_criteria` WHERE `id` = '$code'");
        header('location: admin_addproductcriteria.php');
    }

    if(isset($_POST["addproductdm"])){
        $product = $_POST["product"];
        $dm = $_POST['dm'];
        $result = mysqli_query($conn, "SELECT `code_dm` FROM `product_dm` WHERE `code_dm` = '$dm'");
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 0){
            $query = "INSERT INTO `product_dm`(`code_product`, `code_dm`) VALUES ('$product','$dm')";
            $sql = mysqli_query($conn, $query);
            header('location: admin_addproductdm.php?success="1"');
        }else{
            header('location: admin_addproductdm.php?already="1"');
        }
    }

    if(isset($_GET["deleteproductdm"])){
        $code = $_GET["deleteproductdm"];
        $result = mysqli_query($conn, "DELETE FROM `product_dm` WHERE `id` = '$code'");
        header('location: admin_addproductdm.php');
    }

    if(isset($_POST["selectproduct"])){
        $product = $_POST["product"];
        $_SESSION['product'] = $product;

        header('location: dm_detailproduct.php');
    }

    if(isset($_POST["evaluate"])){
        $product = $_POST["product"];
        $_SESSION['product'] = $product;
        $dm =$_SESSION["code_dm"];
        $result = mysqli_query($conn, "SELECT * FROM `score_s` WHERE code_dm = '$dm'");
        if(mysqli_num_rows($result) > 0){
            $done = TRUE;
        }else{
        header('location: dm_evaluate.php');
        }
    }

    if(isset($_POST["scorevendor"])){
        $code = $_SESSION['product'];
        $query1 = "SELECT * FROM alternative INNER JOIN product_alternative ON alternative.code_alternative = product_alternative.code_alternative WHERE product_alternative.code_product = '$code'";
        $sql1 = mysqli_query($conn, $query1);
        while($row1 = mysqli_fetch_array($sql1)){
            $vendor = $row1['code_alternative']; 
            $querys = "SELECT * FROM criteria INNER JOIN product_criteria ON criteria.code_criteria = product_criteria.code_criteria WHERE product_criteria.code_product = '$code'";
            $sqls = mysqli_query($conn, $querys);
            while($row = mysqli_fetch_array($sqls)){
                $criteria = $row['code_criteria'];
                $code_dm = $_SESSION["code_dm"];
                $product = $_SESSION['product'];
                $code_score = $row['code_criteria'];
                $score_name = $vendor.$code_score;
                $score = $_POST[$score_name];
                $date = date("Y/m/d");
                $query = "INSERT INTO `score`(`code_dm`, `code_product`, `code_alternative`, `code_criteria`, `score`) VALUES ('$code_dm','$product','$vendor','$criteria','$score')";
                $sql = mysqli_query($conn, $query);
                $queryz = "INSERT INTO `score_s`(`code_dm`, `code_product`, `code_alternative`, `code_criteria`, `score`, `date`) VALUES ('$code_dm','$product','$vendor','$criteria','$score','$date')";
                $sqlz = mysqli_query($conn, $queryz);
                }
            }
        $product = $_SESSION['product'];
        $result1 = mysqli_query($conn, "SELECT * FROM product_dm WHERE code_product = '$product'");
        $result2 = mysqli_query($conn, "SELECT DISTINCT code_dm FROM score_s WHERE code_product = '$product'");
        $req = mysqli_num_rows($result1);
        $dem = mysqli_num_rows($result2);
        if($req == $dem){
            $result3 = mysqli_query($conn, "SELECT * FROM product_dm WHERE code_product = '$product'");
            $dm = mysqli_fetch_row($result3);
            $result6 = mysqli_query($conn, "SELECT * FROM dm_term INNER JOIN decisionmaker ON decisionmaker.importance_dm = dm_term.importance_dm WHERE decisionmaker.code_dm = 'DM1");
            $term1 = mysqli_fetch_array($result6);
            $result7 = mysqli_query($conn, "SELECT * FROM dm_term INNER JOIN decisionmaker ON decisionmaker.importance_dm = dm_term.importance_dm WHERE decisionmaker.code_dm = 'DM2'");
            $term2 = mysqli_fetch_array($result7);
            $dm1 = $term1['weight'];
            $dm2 = $term2['weight'];
            $weight1 = $dm1/($dm1 + $dm2);
            $weight2 = $dm2/($dm1 + $dm2);

            $result4 = mysqli_query($conn, "SELECT * FROM score_s INNER JOIN rating ON score_s.score = rating.score WHERE score_s.code_dm = 'DM1' ORDER BY score_s.code_criteria ASC, score_s.code_alternative ASC");
            $result5 = mysqli_query($conn, "SELECT * FROM score_s INNER JOIN rating ON score_s.score = rating.score WHERE score_s.code_dm = 'DM2' ORDER BY score_s.code_criteria ASC, score_s.code_alternative ASC");

            while($score1 = mysqli_fetch_array($result4)){
            $score2 = mysqli_fetch_array($result5);
            $criteria = $score1['code_criteria'];
            $vendor = $score1['code_alternative'];
            $m1 = $score1['m'];
            $m2 = $score2['m'];
            $v1 = $score1['v'];
            $v2 = $score2['v'];
            $r1 = $score1['r'];
            $r2 = $score2['r'];
            $m = 1 - (pow((1 - $m1),$weight1) * pow((1 - $m2),$weight2));
            $v = 1 - (pow((1 - $v1),$weight1) * pow((1 - $v2),$weight2));
            $r = 1 - (pow((1 - $r1),$weight1) * pow((1 - $r2),$weight2));
            $date = date("Y/m/d");
            $query3 = "INSERT INTO `matrix`(`code_criteria`, `code_alternative`, `m`, `v`, `r`) VALUES ('$criteria','$vendor','$m','$v','$r')";
            $sql3 = mysqli_query($conn, $query3);
            $matrix_s = mysqli_query($conn, "INSERT INTO `matrix_s`(`code_criteria`, `code_alternative`, `code_product`,`date`,`m`, `v`, `r`) VALUES ('$criteria','$vendor','$product','$date','$m','$v','$r')");
            }
        /*
        $query2 = "SELECT * FROM score INNER JOIN rating ON score.score = rating.score ORDER BY score.code_criteria ASC, score.code_alternative ASC";
        $sql2 = mysqli_query($conn, $query2);
        while($row2 = mysqli_fetch_array($sql2)){
            $criteria = $row2['code_criteria'];
            $vendor = $row2['code_alternative'];
            $m = $row2['m'];
            $v = $row2['v'];
            $r = $row2['r'];
            $query3 = "INSERT INTO `matrix`(`code_criteria`, `code_alternative`, `m`, `v`, `r`) VALUES ('$criteria','$vendor','$m','$v','$r')";
            $sql3 = mysqli_query($conn, $query3);
        }
        */
        $product = $_SESSION['product'];
        $query4 = "SELECT * FROM product_criteria WHERE code_product = '$product'";
        $sql4 = mysqli_query($conn, $query4);
        while($row4 = mysqli_fetch_array($sql4)){
            $criteria = $row4['code_criteria'];
            $query5 = "SELECT * FROM matrix WHERE code_criteria = '$criteria' ORDER BY code_alternative ASC";
            $sql5 = mysqli_query($conn, $query5);
            while($row5 = mysqli_fetch_array($sql5)){
                $vendor = $row5['code_alternative'];
                $m = $row5['m'];
                $v = $row5['v'];
                $r = $row5['r'];
                $nilai = ($m*log($m))+($v*log($v))-((1-$r)*log(1-$r))-($r*log(2));
                $query6 = "INSERT INTO `bobot`(`code_criteria`, `code_alternative`, `nilai`) VALUES ('$criteria','$vendor',$nilai)";
                $sql6 = mysqli_query($conn, $query6);
            }
        }

        $product = $_SESSION['product'];
        $queryln = "SELECT COUNT(*) FROM product_alternative WHERE code_product = $product";
        $sqlln = mysqli_query($conn, $queryln);
        $ln = -1/(5*log(2));
        $date = date("Y/m/d");
        $query7 = "SELECT * FROM product_criteria WHERE code_product = '$product'";
        $sql7 = mysqli_query($conn, $query7);
        while($row7 = mysqli_fetch_array($sql7)){
            $criteria = $row7['code_criteria'];
            $query8 = "SELECT SUM(nilai) as jumlah FROM bobot WHERE code_criteria = '$criteria'";
            $sql8 = mysqli_query($conn, $query8);
            while($row8 = mysqli_fetch_array($sql8)){

                $sum = $row8['jumlah'];
                $hj = $ln * $sum;
                $dj = 1 - $hj;
                $query9 = "INSERT INTO `entropi`(`code_criteria`, `hj`, `dj`) VALUES ('$criteria','$hj','$dj')";
                $sql9 = mysqli_query($conn, $query9);
                $entropi_s = mysqli_query($conn, "INSERT INTO `entropi_s`(`code_criteria`, `code_product`, `date`, `hj`, `dj`) VALUES ('$criteria','$product','$date','$hj','$dj')");
            }
        }

        $query10 = "SELECT * FROM entropi";
        $sql10 = mysqli_query($conn, $query10);
        while($row10 = mysqli_fetch_array($sql10)){
            $query11 = "SELECT SUM(dj) as jumlahdj FROM entropi";
            $sql11 = mysqli_query($conn, $query11);
            while($row11 = mysqli_fetch_array($sql11)){
                $criteria = $row10['code_criteria'];
                $dj = $row10['dj'];
                $jumlah = $row11['jumlahdj'];
                $wj = $dj/$jumlah;
                $update = "UPDATE `entropi` SET `code_criteria`='$criteria',`wj`='$wj' WHERE `code_criteria`='$criteria'";
                $sqlwj = mysqli_query($conn, $update);
                $entropi_wj = mysqli_query($conn, "UPDATE `entropi_s` SET `code_criteria`='$criteria',`wj`='$wj' WHERE `code_criteria`='$criteria'");
            }
        }

        $query10 = "SELECT * FROM entropi";
        $sql10 = mysqli_query($conn, $query10);
        while($row10 = mysqli_fetch_array($sql10)){
            $query11 = "SELECT SUM(dj) as jumlahdj FROM entropi";
            $sql11 = mysqli_query($conn, $query11);
            while($row11 = mysqli_fetch_array($sql11)){
                $criteria = $row10['code_criteria'];
                $dj = $row10['dj'];
                $jumlah = $row11['jumlahdj'];
                $wj = $dj/$jumlah;
                $update = "UPDATE `entropi` SET `code_criteria`='$criteria',`wj`='$wj' WHERE `code_criteria`='$criteria'";
                $sqlwj = mysqli_query($conn, $update);
            }
        }

        $product = $_SESSION['product'];
        $query12 = "SELECT * FROM product_criteria WHERE code_product = '$product'";
        $sql12 = mysqli_query($conn, $query12);
        while($row12 = mysqli_fetch_array($sql12)){
            $criteria = $row12['code_criteria'];
            $query13 = "SELECT * FROM matrix INNER JOIN entropi ON matrix.code_criteria = entropi.code_criteria WHERE matrix.code_criteria = '$criteria'";
            $sql13 = mysqli_query($conn, $query13);
            while($row13 = mysqli_fetch_array($sql13)){
                $vendor = $row13['code_alternative'];
                $wj = $row13['wj'];
                $m = $row13['m'];
                $v = $row13['v'];
                $r = $row13['r'];
                $mw = 1-pow((1-$m), $wj);
                $vw = pow($v, $wj);
                $rw = 1 - $vw - $mw;
                $query14 = "INSERT INTO `matrixweighted`(`code_criteria`, `code_alternative`, `m`, `v`, `r`) VALUES ('$criteria','$vendor','$mw','$vw','$rw')";
                $sql14 = mysqli_query($conn, $query14);
            }
        }

        $product = $_SESSION['product'];
        $query15 = "SELECT * FROM product_criteria WHERE code_product = '$product'";
        $sql15 = mysqli_query($conn, $query15);
        while($row15 = mysqli_fetch_array($sql15)){
            $criteria = $row15['code_criteria'];
            $query16 = "SELECT * FROM criteria WHERE code_criteria = '$criteria'";
            $sql16 = mysqli_query($conn, $query16);
            $row16 = mysqli_fetch_array($sql16);
            $type = $row16['type_criteria'];
                if($type == "Benefit"){
                    $query21 = "SELECT MAX(m) as maks FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql21 = mysqli_query($conn, $query21);
                    $row21 = mysqli_fetch_array($sql21);
                    $m = $row21['maks'];
                    $query18 = "SELECT MIN(v) as minm FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql18 = mysqli_query($conn, $query18);
                    $row18 = mysqli_fetch_array($sql18);
                    $v = $row18['minm'];
                }else{
                    $query17 = "SELECT MIN(m) as minm FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql17 = mysqli_query($conn, $query17);
                    $row17 = mysqli_fetch_array($sql17);
                    $m = $row17['minm'];

                    $query19 = "SELECT MAX(v) as maks FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql19 = mysqli_query($conn, $query19);
                    $row19 = mysqli_fetch_array($sql19);
                    $v = $row19['maks'];
                }
                 $r = 1-($m + $v);
                 $query20 = "INSERT INTO `ifpis`(`code_criteria`, `m+`, `v+`, `r+`) VALUES ('$criteria','$m','$v','$r')";
                 $sql20 = mysqli_query($conn, $query20);   
        }

        $product = $_SESSION['product'];
        $query22 = "SELECT * FROM product_criteria WHERE code_product = '$product'";
        $sql22 = mysqli_query($conn, $query22);
        while($row22 = mysqli_fetch_array($sql22)){
            $criteria = $row22['code_criteria'];
            $query23 = "SELECT * FROM criteria WHERE code_criteria = '$criteria'";
            $sql23 = mysqli_query($conn, $query23);
            $row23 = mysqli_fetch_array($sql23);
            $type = $row16['type_criteria'];
                if($type == "Benefit"){
                    $query24 = "SELECT MIN(m) as minm FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql24 = mysqli_query($conn, $query24);
                    $row24 = mysqli_fetch_array($sql24);
                    $m = $row24['minm'];
                    $query25 = "SELECT MAX(v) as maks FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql25 = mysqli_query($conn, $query25);
                    $row25 = mysqli_fetch_array($sql25);
                    $v = $row25['maks'];
                }else{
                    $query26 = "SELECT MAX(m) as maks FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql26 = mysqli_query($conn, $query26);
                    $row26 = mysqli_fetch_array($sql26);
                    $m = $row26['maks'];

                    $query27 = "SELECT MIN(v) as minm FROM matrixweighted WHERE code_criteria = '$criteria'";
                    $sql27 = mysqli_query($conn, $query27);
                    $row27 = mysqli_fetch_array($sql27);
                    $v = $row27['minm'];
                }
                 $r = 1-($m + $v);
                 $query28 = "INSERT INTO `ifnis`(`code_criteria`, `m-`, `v-`, `r-`) VALUES ('$criteria','$m','$v','$r')";
                 $sql28 = mysqli_query($conn, $query28);   
        }

        $product = $_SESSION['product'];
        $query29 = "SELECT * FROM product_criteria WHERE code_product = '$product'";
        $sql29 = mysqli_query($conn, $query29);
        while($row29 = mysqli_fetch_array($sql29)){
            $criteria = $row29['code_criteria'];
            $query30 = "SELECT * FROM matrixweighted INNER JOIN ifpis ON matrixweighted.code_criteria = ifpis.code_criteria WHERE matrixweighted.code_criteria = '$criteria'";
            $sql30 = mysqli_query($conn, $query30);
            while($row30 = mysqli_fetch_array($sql30)){
                $vendor = $row30['code_alternative'];
                $m = $row30['m'];
                $v = $row30['v'];
                $r = $row30['r'];
                $mifpis = $row30['m+'];
                $vifpis = $row30['v+'];
                $rifpis = $row30['r+'];
                $mw = abs($m - $mifpis);
                $vw = abs($v - $vifpis);
                $rw = abs($r - $rifpis);
                $sum = $mw + $vw + $rw;
                $query31 = "INSERT INTO `s+`(`code_criteria`, `code_alternative`, `m+`, `v+`, `r+`,`jumlah`) VALUES ('$criteria','$vendor','$mw','$vw','$rw','$sum')";
                $sql31 = mysqli_query($conn, $query31);
            }
        }

        $product = $_SESSION['product'];
        $query32 = "SELECT * FROM product_criteria WHERE code_product = '$product'";
        $sql32 = mysqli_query($conn, $query32);
        while($row32 = mysqli_fetch_array($sql32)){
            $criteria = $row32['code_criteria'];
            $query33 = "SELECT * FROM matrixweighted INNER JOIN ifnis ON matrixweighted.code_criteria = ifnis.code_criteria WHERE matrixweighted.code_criteria = '$criteria'";
            $sql33 = mysqli_query($conn, $query33);
            while($row33 = mysqli_fetch_array($sql33)){
                $vendor = $row33['code_alternative'];
                $m = $row33['m'];
                $v = $row33['v'];
                $r = $row33['r'];
                $mifnis = $row33['m-'];
                $vifnis = $row33['v-'];
                $rifnis = $row33['r-'];
                $mw = abs($m - $mifnis);
                $vw = abs($v - $vifnis);
                $rw = abs($r - $rifnis);
                $sum = $mw + $vw + $rw;
                $query34 = "INSERT INTO `s-`(`code_criteria`, `code_alternative`, `m-`, `v-`, `r-`, `jumlah`) VALUES ('$criteria','$vendor','$mw','$vw','$rw','$sum')";
                $sql34 = mysqli_query($conn, $query34);
            }
        }
        $product = $_SESSION['product'];
        $date = date("Y/m/d");
        $query35 = "SELECT * FROM product_alternative WHERE code_product = '$product'";
        $sql35 = mysqli_query($conn, $query35);
        while($row35 = mysqli_fetch_array($sql35)){
                $vendor = $row35['code_alternative'];
                $query37 = "SELECT SUM(jumlah) as jumlah FROM `s+` WHERE code_alternative = '$vendor'";
                $sql37 = mysqli_query($conn, $query37);
                $row37 = mysqli_fetch_array($sql37);
                $jumlahsp = $row37['jumlah'];
                $sp = $jumlahsp/2;

                $query38 = "SELECT SUM(jumlah) as jumlah FROM `s-` WHERE code_alternative = '$vendor'";
                $sql38 = mysqli_query($conn, $query38);
                $row38 = mysqli_fetch_array($sql38);
                $jumlahsm = $row38['jumlah'];
                $sm = $jumlahsm/2;

                $c = $sm/($sm+$sp);
                $query39 = "INSERT INTO `separation`(`code_alternative`, `s+`, `s-`, `c`) VALUES ('$vendor','$sp','$sm','$c')";
                $sql39 = mysqli_query($conn, $query39);
                $separation = mysqli_query($conn, "INSERT INTO `separation_s`(`code_alternative`, `code_product`, `date`, `s+`, `s-`, `c`) VALUES ('$vendor','$product','$date','$sp','$sm','$c')");
            }
        $_SESSION['result'] = TRUE;
        header('location: result.php');
        }else{
        header('location: success.php');
        }
    }

    if(isset($_POST["resetproduct"])){
        $score = "TRUNCATE TABLE score";
        $sqlscore = mysqli_query($conn, $score);
        $matrix = "TRUNCATE TABLE matrix";
        $sqlmatrix = mysqli_query($conn, $matrix);
        $bobot = "TRUNCATE TABLE bobot";
        $sqlbobot = mysqli_query($conn, $bobot);
        $entropi = "TRUNCATE TABLE entropi";
        $sqlentropi = mysqli_query($conn, $entropi);
        $ifnis = "TRUNCATE TABLE ifnis";
        $sqlifnis = mysqli_query($conn, $ifnis);
        $ifpis = "TRUNCATE TABLE ifpis";
        $sqlifpis = mysqli_query($conn, $ifpis);
        $weighted = "TRUNCATE TABLE matrixweighted";
        $sqlweighted = mysqli_query($conn, $weighted);
        $ifnis = "TRUNCATE TABLE ifnis";
        $sqlifnis = mysqli_query($conn, $ifnis);
        $sp = "TRUNCATE TABLE s+";
        $sqlsp = mysqli_query($conn, $sp);
        $sm = "TRUNCATE TABLE s-";
        $sqlsm = mysqli_query($conn, $sm);
        $separation = "TRUNCATE TABLE separation";
        $sqlseparation = mysqli_query($conn, $separation);
        $_SESSION['result'] = FALSE;
        header('location: dm_product.php');
    }

    if(isset($_GET["deletehistory"])){
        $code = $_GET['deletehistory'];
        $query = "DELETE FROM `score_s` WHERE `code_dm` = '$code'";
        $sql = mysqli_query($conn, $query);
        header('location: history.php?delete="1"');
    }

    if(isset($_GET["deleteaggregated"])){
        $code = $_GET['deleteaggregated'];
        $query = "DELETE FROM `matrix_s` WHERE `code_product` = '$code'";
        $sql = mysqli_query($conn, $query);
        header('location: history_aggregated.php?delete="1"');
    }

    if(isset($_GET["deleteweight"])){
        $code = $_GET['deleteweight'];
        $query = "DELETE FROM `entropi_s` WHERE `code_product` = '$code'";
        $sql = mysqli_query($conn, $query);
        header('location: history_weight.php?delete="1"');
    }
    if(isset($_GET["deleter"])){
        $code = $_GET['deleter'];
        $query = "DELETE FROM `separation_s` WHERE `code_product` = '$code'";
        $sql = mysqli_query($conn, $query);
        header('location: history_r.php?delete="1"');
    }
?>