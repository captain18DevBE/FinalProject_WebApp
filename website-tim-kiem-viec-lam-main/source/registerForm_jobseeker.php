<?php
    session_start();
    require_once './autoload.php';
    spl_autoload_register('advance_require_once');
    $message_error = "";
    if(isset($_POST['btn_register'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        require_once './app/Controllers/JobSeekerController.php';
        $statement = (new JobSeekerController())->signup($name, $email, $password);
        $message_error = $statement;
    }
?>
<!DOCTYPE html.>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/Favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/base_register.css">
    <link rel="stylesheet" href="./assets/jobseeker_register.css">
    <title>Đăng ký</title>
</head>
<body>
    <div class="body">
        <div class="register">
            <div class="register__header">
                <img src="./assets/images/Logo.png" alt="" class="register__header--logo">
                <div class="register__header__intro">
                    <h3>Chào mừng bạn đến với WnU!</h3><br>
                    <p>Bắt đầu  một hồ sơ nổi bật để nhận được các cơ hội sự nghiệp bạn mong muốn!</p><br>
                </div>
            </div>
            <div class="register__body">
                <div class="register__body--form grid__row">
                    <form method="post" class="register__form" id="register-form" action="">
                        <div class="form-group">
                            <label for="name"><h5>Họ và Tên</h5></label>
                            <input type="text" placeholder="Ví dụ: Trần Văn A" name="name" id="register__form--name" class="register__form-input form-control"><br>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="email"><h5>Email</h5></label>
                            <input type="email" placeholder="Ví dụ:TDTUniversity@gmail.com" name="email" id="register__form--email" class="register__form-input form-control"><br>
                            <span class="form-message"><?php echo $message_error?></span>
                        </div>
                        <div class="form-group">
                            <label for="password"><h5>Mật Khẩu</h5></label>
                            <input type="password" placeholder="Ví dụ:Ab@123" name="password" id="register__form--password" class="register__form-input form-control"><br>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password"><h5>Xác nhận mật khẩu</h5></label>
                            <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" id="register__form--confirm--password" class="register__form-input form-control"><br>
                            <span class="form-message"></span>
                        </div>

                        <p>Bằng việc đăng ký tài khoản, bạn đã đồng ý với các <a href=""> điều khoản</a></p>
                        <p>và <a href="">chính sách bảo mật</a> của chúng tôi!</p><br>
                        <input type="submit" value="Đăng ký" class="register__form-input register__form-submit" name="btn_register">
                        
                    </form>
                        <!-- Chuyển form đăng nhập -->
                        <div class="register__body__link-login">
                            <div>
                                <h6><a href="./signin_jobseeker.php">Bạn đã có tài khoản?</a><br>Các phương thức đăng nhập khác:</h6>
                            </div>
                            
                            <!-- <div class="register__body__link-login--app">
                                <div class="d-grid gap-2 col-6 mx-auto register-bottom--link-account">
                                    <button style="background-color: #ec6558; border: 1px solid #ec6558;" class="btn btn-primary btn--google" type="button"><img src="./assets/images/img_register/logoGG.png" alt=""><span>Google</span></button>
                                    <button style="background-color: #365899; border: 1px solid #365899;" class="btn btn-primary btn--facebook" type="button"><img src="./assets/images/img_register/Facebook_Logo_(2019).png" alt=""> <span>Facebook</span></button>
                                </div>
                            </div> -->
                              
                        </div>
                        <!-- fix position link google -->
                </div>
            </div>
        </div>
        
        <div class="marketing">
            <div class="marketing__body">
                <div class="marketing__header">
                    <img src="./assets/images/img_register/logo_TinTuc.png" alt="" class="marketing__header--logo-news">
                </div>
                <div class="marketing__slider">
                    <div class="register__header__intro">
                        <h4>Hỗ trợ người tìm việc</h4>
                        <p>Nhà tuyển dụng chủ động tìm kiếm và liên hệ với 
                            bạn qua hệ thống kết nối ứng viên thông minh.</p>
                    </div>
                    <!-- <div class="marketing__slider--img">
                        
                    </div> -->
                    <!-- <img src="./assets/images/img_register/background_marketing01.webp" class="marketing__slider--image" alt=""> -->
                </div>
            </div>

        </div>
    </div>
</body>
<script src="./js/validator.js"></script>
<script>
    //Set validation for element to form
    Validator({
        form: '#register-form',
        rules: [
            Validator.isRequired('#register__form--name'),
            //Validator.lengthRange('#register__form--name'),
            Validator.isEmail('#register__form--email'),
            Validator.checkPassWord('#register__form--password'),
            Validator.confirmPassWord('#register__form--confirm--password', 'register__form--password')
        ]
    });
</script>
</html>