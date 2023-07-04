<?php
    session_start();
    require_once './autoload.php';
    spl_autoload_register('advance_require_once');
    $message_error = "";
    if(isset($_POST['signin'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($email == "admin" && $password == "123456"){
            header('location: ./admin-page.php');
        }
        else{
            require_once './app/Controllers/CompanyController.php';
            require_once './app/Controllers/EmployerController.php';
            $statement = (new CompanyController())->signin($email);
            $statement = (new EmployerController())->signin($email, $password);
            $message_error = $statement;
        }
    }
?>

<!DOCTYPE html>
<html lang="vie">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/Favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/><script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        /* body{
            padding: 0px 20px;
        } */

        html{
            scroll-behavior: smooth;    
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            height: 100%;
            color:#451da0;
        }

        .container{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        table{
            width: 75%;
            font-weight: 500;
            color: #454545;
        }

        table tr td{
            padding: 10px;
            margin: 20px;
            text-align: center;
        }

        input{
            background: rgba(69, 29, 160, 0.1);
            width: 75%;
            padding: 2%;
            border-radius: 2px;
            border: none;
        }

        .btn_signin{
            width: 82.5%;
            padding: 2%;
            border-radius: 2px;
        }

    </style>
    <title>Sign in</title>
  </head>
    <body style="height: 100%">
        <div class="container" style="background: url('./assets/images/img_register/work.jpg'); background-size: cover; width: 100%; height: 100%">    
            <form action="" class="form-signin" method="POST" style="display: flex; align-items: center; justify-content: center;">    
                <table>
                    <tr>
                        <td colspan="2">
                            <div class="header-container" style="display: flex; justify-content: center; width: 100%; height: 50%">
                                <img src="./assets/images/Logo.png" alt="" class="register-header-logo" width=40% height=75%/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h2 style="color: #451da0">Chào mừng bạn quay trở lại</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h3 style="color: #451da0">Vui lòng đăng nhập tại đây</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email</label> 
                        </td>
                        <td>
                            <input type="text" name="email" id="inp_email" placeholder="Nhập email tại đây"/> <br /> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Mật khẩu</label> 
                        </td>
                        <td>
                            <input type="password" name="password" id="inp_password" placeholder="Nhập mật khẩu tại đây" /> <br />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Chưa có tài khoản?   <a href="./registerForm_employer.php?page=candidate"><u><b>Đăng kí ngay</b></u></a></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" name="signin" id="inp_signin" class="btn_signin"style="background-color: #451da0; color: white; padding: 5px; border-radius: 5%">Đăng nhập</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
                                