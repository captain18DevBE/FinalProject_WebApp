<?php
    session_start();
    $message_error = "";
    if(isset($_POST['btn_register'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $numberphone = $_POST['numberphone'];

        $name_company = $_POST['name_company'];
        $province = $_POST['calc_shipping_provinces'];
        $district = $_POST['calc_shipping_district'];
        
        require_once './app/Controllers/CompanyController.php';
        require_once './app/Controllers/EmployerController.php';
        require_once './app/Controllers/ServiceController.php';
        require_once './app/Controllers/AddressController.php';
        
        $service = (new ServiceController())->getIdService($_POST['service']);
        $address = (new AddressController())->getIdAddress($province, $district);
        
        $statement = (new EmployerController())->signup($name, $email, $password, $numberphone);
        $statement = (new CompanyController())->signup($name_company, $address, $service);
        // $message_error = $statment;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/Favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/base_register.css">
    <link rel="stylesheet" href="./assets/employer_register.css">
    <title>Đăng ký dành cho nhà tuyển dụng</title>
</head>
<body>
    <div class="page">
        <div class="header">
            <img src="./assets/images/img_register/logo-no-background.png" alt="">
            <div class="header__slogan">
                <p class="header__slogan--main">Chào mừng bạn đến với WnU!</p>
                <p class="header__slogan--sup">Đăng ký tài khoản nhà tuyển dụng</p>
            </div>
        </div>
        <div class="form">
            <div class="form__header">
                <a href="" id="text--rules"><h6>THÔNG TIN NHÀ TUYỂN DỤNG</h6> <span>(điều khoản)</span></a>
                <div id="content--rules">
                    Để đảm bảo chất lượng dịch vụ, WNU không cho phép một người dùng tạo nhiều tài khoản khác nhau.Nếu phát hiện vi phạm, 
                    WNU sẽ ngừng cung cấp dịch vụ tới tất cả các tài khoản trùng lặp hoặc chặn toàn bộ truy cập tới hệ thống website của WNU. Đối với trường hợp khách hàng 
                    đã sử dụng hết 3 tin tuyển dụng miễn phí, WNU hỗ trợ kích hoạt đăng tin tuyển dụng không giới hạn sau khi quý doanh nghiệp cung cấp thông tin giấy phép kinh doanh.
                    Mọi thắc mắc vui lòng liên hệ Hotline CSKH:
                </div>
            </div>
            <div class="form--input">
              <form id="register-form" method="POST">
                    <h5 class="form__content--title">Tài khoản:</h5>

                    <div class="row mb-3 form--input--tag">
                      <label for="inputEmail1" class="col-sm-2 col-form-label" placeholder="Ví dụ: TDTUniversity@gmail.com">Email đăng ký:</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail1" name="email">
                        <span class="form-message"><?php echo $message_error?></span>
                      </div>
                    </div>
                    <div class="row mb-3 form--input--tag">
                      <label for="inputPassword2" class="col-sm-2 col-form-label">Mật khẩu:</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword2" name="password" placeholder="Ví dụ: Abc123@">
                        <span class="form-message"></span>
                      </div>
                    </div>
                    <div class="row mb-3 form--input--tag">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Xác nhận mật khẩu:</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3">
                        <span class="form-message"></span>
                      </div>
                    </div>
                    <h5 style="margin-top: 2.2rem;" class="form__content--title">Thông tin nhà tuyển dụng:</h5>
                    <div class="row mb-3 form--input--tag">
                        <label for="inputname1" class="col-sm-2 col-form-label">Họ và Tên:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputname1" name="name">
                          <span class="form-message"></span>
                        </div>
                    </div>
                    <div class="row mb-3 form--input--tag">
                        <label for="inputphonenumber" class="col-sm-2 col-form-label">Số điện thoại:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputphonenumber" placeholder="Ví dụ: 0123987651" name="numberphone">
                          <span class="form-message"></span>
                        </div>
                    </div>
                    <div class="row mb-3 form--input--tag">
                        <label for="inputcompany" class="col-sm-2 col-form-label">Công ty:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputcompany" name="name_company" placeholder="FPT Software">
                          <span class="form-message"></span>
                        </div>
                    </div>
                    <div class="row mb-3 form--input--tag">
                        <label for="gender1" class="col-sm-2 col-form-label">Chuyên ngành:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="service">
                                <option value = "null" selected>--Chọn chuyên ngành---</option>
                                <?php
                                    require_once './app/Controllers/ServiceController.php';
                                    $service = (new ServiceController())->getAllService();
                                    foreach($service as $key=>$value){
                                        ?>
                                            <option value="<?php echo $value['name']?>"><?php echo $value['name']?></option>                                        
                                        <?php
                                    }
                                ?>
                            </select>
                            <span class="form-message"></span>
                        </div>
                    </div>
                 <!-- adress -->
                    <div class="row mb-3 form--input--tag">
                    <label for="address" class="col-sm-2 col-form-label">Địa chỉ công ty:</label>
                    <div class="col-sm-10 form-select--address">
                        <div>
                            <select class="form-select" id= "address" name="calc_shipping_provinces" required="">
                                <option value="">Tỉnh / Thành phố</option>
                            </select>
                            <span class="form-message"></span>
                        </div>
                        <div>
                            <select class="form-select" name="calc_shipping_district" required="">
                                <option value="">Quận / Huyện</option>
                            </select>
                            <span class="form-message"></span>
                        </div>
                        <input class="billing_address_1" name="" type="hidden" value="">
                        <input class="billing_address_2" name="" type="hidden" value="">
                    </div>
                    </div>

                    <div class="form__content--rules form--input--tag">
                        <p>Bằng việt đăng kí tài khoản, bạn đã đồng ý với các điều khoản dịch vụ và chính sách bảo mật của chúng tôi</p>
                        <label for="form__rules">
                            <input type="checkbox" name="" id="form__rules">
                            Tôi đã đọc và đồng ý với các điều khoản.
                        </label>
                        <button type="submit" class="btn__submit--form btn btn-primary" name="btn_register">Đăng ký</button>
                    </div>

                </form>
            </div>  
        </div>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
  <script src="./js/employer.js"></script>
  <script src="./js/validator.js"></script>
  <script>
      //Set validation for element to form
      Validator({
          form: '#register-form',
          rules: [
              Validator.isRequired('#inputPassword2'),
              Validator.isEmail('#inputEmail1'),
              Validator.checkPassWord('#inputPassword2'),
              Validator.confirmPassWord('#inputPassword3', 'inputPassword2'),
              Validator.isPhoneNumber('#inputphonenumber')
            
          ]
      });
  </script>

</html>