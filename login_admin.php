<?php
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="fontawesome/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
            body{
                background-color: #024566;
            }
            .container{
                width: 30%;
                margin-top: 10%;
                box-shadow: 0 3px 20px rgba(0,0,0,0.4);
                padding: 40px;
                background-color: #706F69;
                border-radius: 10px;
            }
            .submit{
                width: 100%;
                padding: 5px;
            }
            .submit{
                margin-top: 15px;
                margin-bottom: 15px;
                border-radius: 20px;
            }
            form a{
                text-decoration: none;
                color: black;
            }
            .btn{
                width: 100%;
                display: block;
                margin: 0 auto;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <img src="img/Supplier.png" width="100" height="100" class="mx-auto d-block" alt="">
            <h2 class="text-center text-white">Admin</h2>
            <hr>
            <?php if(isset($error)) :?>
                <p style="color: #555; font-style: italic;">username/password salah</p>
            <?php endif;?>
            <?php if(isset($null)) :?>
                <p style="color: #555; font-style: italic;">Tolong Masukan Username dan Password </p>
            <?php endif;?>
            <form action="#" method="post">
                <div class="form-group">
                    <label class="text-white">Enter Username</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <input class="form-control" type="text" name="username" placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-white">Password</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                            </div>
                        <input class="form-control" type="Password" name="password" placeholder="Enter Password">
                        </div>
                </div>
                    <button class="btn text-white" style="background-color:#024566"type="submit" name="login_admin">Login</button>
            </form>
        </div>
    </body>
</html>