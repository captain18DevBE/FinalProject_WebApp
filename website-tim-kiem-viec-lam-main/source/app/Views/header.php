<!-- header -->
<header id="header">
        <!-- Logo -->
        <a href="<?php if($_SESSION['account'] == 'Job seeker'){ echo '?page=job';}else if($_SESSION['account'] == 'Employer'){ echo '?page=candidate';}?>" id="logo">
            <div class="logo"></div>
            <div class="name-web">
                WeNeedU
                <div class="slogan">
                    Connecting talent to opportunity - Your go-to job portal!
                </div>
            </div>
        </a>
        <!-- Connect -->
        <?php
            if(isset($_SESSION['name'])){
                $connect = "non-active";
                $account = "";
            }
            else{
                $connect = "";
                $account = "non-active";
            }
        ?>
        <div class="connect <?php echo $connect?>">
            <div class="seeker-job">
                <a href="./signin_jobseeker.php?page=job" class="signin">Đăng nhập</a>
                /
                <a href="./registerForm_jobseeker.php?page=job" class="signup">Đăng ký</a>
            </div>
            <div class="log-employer">
                <!-- icon employer -->
                <i class="fa-solid fa-users-viewfinder"></i> 
                <a href="./signin_employer.php?page=candidate" class="employer">Nhà tuyển dụng</a>
            </div>
        </div>
        <div class="account <?php echo $account?>">
            <div class="notification">
                <i class="fa-solid fa-bell bell"></i>
                <?php
                    if($_SESSION['status'] == "CONNECTING"){
                        if($account == ""){
                            require_once "./app/Controllers/NotificationController.php";
                            $notificontroller = new NotificationController();
                            $email = $_SESSION['email'];
                            $amount_list_notifi_not_read = $notificontroller->getAmountNotRead($email);
                            $list_notifi = $notificontroller->getAll($email);
                            if($amount_list_notifi_not_read > 0){
                ?>
                                    <div class="number-notifi"><?php echo $amount_list_notifi_not_read?></div>
                                <?php
                                    }
                                ?>
                                <div class="detail-notification">
                                    <div class="title-container_notifi">
                                        <p>Thông báo</p>
                                        <p>Đánh dấu tất cả là đã đọc</p>
                                    </div>
                                    <div class="list-notifi">
                                    <?php
                                        if(count($list_notifi) > 0){
                                            $data = $notificontroller->getAll($email);
                                            foreach($data as $key=>$value){
                                    ?>
                
                                                <script>
                                                    function read_notification(email, idNotifi){
                                                        let data = {
                                                            id: idNotifi,
                                                            email: email
                                                        };
                                
                                                        fetch('./updateNotification.php', {
                                                            method: 'put', 
                                                            headers: {
                                                                'Content-Type': 'application/json'
                                                            },
                                                            body: JSON.stringify(data)
                                                        })
                                                        .then(response => response.json())
                                                    }
                                                </script>
                                                <div class="container-notifi <?php if($value['status'] == 0){echo "not-read";}?>"  onclick="read_notification('<?php echo $_SESSION['email']?>', <?php echo $value['id_notification']?> )">
                                                    <div class="title-notifi">
                                                        <?php echo $value['title']?>
                                                    </div>
                                                    <div class="content-notifi">
                                                        <p><?php echo $value['content']?></p>
                                                        <a href="./jobseeker.php?page=notification&idNotification=<?php echo $value['id_notification']?>">
                                                            Chi tiết 
                                                            <i class="fa-solid fa-angle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }else{
                                            echo "Không có thông báo nào!";
                                        }

                                    ?>
                                    </div>
                                </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="account_user <?php echo $account?>">
                <?php
                    if($_SESSION['account'] == "Job seeker"){
                        ?>
                    <div class="avatar-user" style="background-image: url('<?php if(isset($_SESSION['avatar'])){echo $_SESSION['avatar'];}?>');"></div>
                    <span class="username"><?php echo $_SESSION['name']?></span>    
                    <div class="setting-account">
                        <a href="?page=my_profile">Thông tin tài khoản</a>
                        <a href="?page=my_profile">CV của tôi</a>
                        <a href="?page=my_profile#list-company-stored">Doanh nghiệp quan tâm</a>
                        <?php
                    }else{
                        ?>
                    <div class="avatar-user" style="background-image: url('<?php if(isset($_SESSION['logo'])){echo $_SESSION['logo'];}?>');"></div>
                    <span class="username"><?php echo $_SESSION['name']?></span>    
                    <div class="setting-account">
                        <a href="?page=company_profile">Thông tin tài khoản</a>
                        <a href="?page=intro_company">Công ty của tôi</a>
                        <?php
                        }
                    ?>
                        <a href="./changePassword.php">Đổi mật khẩu</a>
                        <a href="./app/Views/logout.php"> 
                            Đăng xuất
                            <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i>
                        </a>
                    </div>
            </div>
        </div>
    </header>