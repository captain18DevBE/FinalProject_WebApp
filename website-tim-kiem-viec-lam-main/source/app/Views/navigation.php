<?php
    if($_SESSION['account'] == "Job seeker"){
        $title1 = "Việc làm";
        $title2 = "Công ty";
        $title3 = "Hồ sơ & CV";
    }
    else if($_SESSION['account'] == "Employer"){
        $title1 = "Ứng viên";
        $title2 = "Hồ sơ và bài Post";
        $title3 = "Giới thiệu công ty";
    }
?>
<!-- navigation -->
    <div id="navigation">
        <div class="list-feature">
            <div class="container ">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <a class="logo_sub" href="#"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?php
                            $page1 = $page2 = $page3 = "";
                            if(isset($_GET['page'])){
                                if($_GET['page'] == 'job' || $_GET['page'] == 'candidate'){
                                    $page1 = "item-selected";
                                }
                                else if($_GET['page'] == 'highlight-company' || $_GET['page'] == 'company_profile' || $_GET['page'] == 'company-numberCandidate'){
                                    $page2 = "item-selected";
                                }
                                else if($_GET['page'] == 'my_profile' || $_GET['page'] == 'intro_company'){
                                    $page3 = "item-selected";
                                }
                            }
                        ?>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                            <div class="nav-link <?php echo $page1?> nav-ftr">
                                    <a href="<?php if($_SESSION['account'] == "Job seeker"){echo "?page=job";}else{echo "./employer.php?page=candidate";}?>"><?php echo $title1?></a>
                                    <div class="nav-ftr_detail">
                                        <ul class="feature-detail">
                                            <?php
                                                if($_SESSION['account'] == "Job seeker"){
                                                    require_once "./app/Controllers/ServiceController.php";
                                                    $_SESSION['page'] = $title1;
                                                    $Service = new ServiceController();
                                                    $list_Service = $Service->getForNavigation();
                                                    foreach($list_Service as $key=>$value){
                                                        ?>
                                                        <li><a href="?page=job&service=<?php echo $value['name']?>"><div><?php  echo $value['name']?></div></a></li>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                            <div class="nav-link <?php echo $page2?> nav-ftr">
                                    <?php
                                        if($_SESSION['account'] == "Job seeker") {
                                            ?> <a href="#content"><?php echo $title2 ?></a> <?php
                                        }
                                        else if ($_SESSION['account'] == "Employer") {
                                            ?> <a href="?page=company_profile"><?php echo $title2 ?></a> <?php
                                        }
                                    ?>
                                    <div class="nav-ftr_detail">
                                        <ul class="feature-detail">
                                            <?php
                                                if($_SESSION['account'] == "Job seeker"){
                                                    ?>
                                                    <li><a href="?page=highlight-company"><div>Công ty nổi bật</div></a></li>
                                                    <li><a href="?page=highlight-company"><div>Công ty mới <i class="fa-solid fa-square-up-right"></i></div></a></li>
                                                    <li><a href="?page=company-numberCandidate"><div>Công ty có việc làm nhiều</div></a></li>
                                                    <?php
                                                }
                                                else if($_SESSION['account'] == "Employer"){
                                                    ?>
                                                    <li><a href="?page=company_profile"><div>Hồ sơ công ty</div></a></li>
                                                    <li><a href="?page=company_profile"><div>Các bài post <i class="fa-solid fa-square-up-right"></i></div></a></li>
                                                    <?php
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                            <div class="nav-link <?php echo $page3?> nav-ftr">
                                    <a href="<?php if($_SESSION['account'] == "Job seeker"){echo "./jobseeker.php?page=my_profile";}else{echo "./employer.php?page=intro_company";}?>"><?php echo $title3?></a>
                                    <div class="nav-ftr_detail">
                                        <ul class="feature-detail">
                                        <?php
                                            if($_SESSION['account'] == "Job seeker"){
                                                ?>
                                                <li><a href="?page=my_profile"><div>CV của tôi</div></a> </li>
                                                <li><a href="https://www.jobseeker.com/app/resumes/8bff5819-57bb-4a0c-bf14-929092ff952e/edit"><div>Tạo CV <i class="fa-solid fa-book"></i></div></a></li>
                                                <?php
                                            }
                                            else if($_SESSION['account'] == "Employer"){
                                            }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php
                            if($_SESSION['account'] == "Job seeker"){
                                ?>
                            <div class="btn-search">
                                <div class="label-search">Tìm kiếm</div>
                            </div>
                                <?php
                            }
                        ?>
                    </div>
                </nav>
            </div>
        </div>
        <div class="list-feature_search">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <?php
                                    if(isset($_GET['search'])){
                                        if(isset($_GET['address'])){
                                            if($_GET['address'] != ""){
                                                $address = $_GET['address'];
                                            }
                                            else{
                                                $address = "Tỉnh thành";
                                            }
                                        }

                                        if(isset($_GET['job'])){
                                            if($_GET['job'] != ""){
                                                $job = $_GET['job'];
                                            }
                                            else{
                                                $job = "Nghề nghiệp";
                                            }
                                        }

                                        if(isset($_GET['salary'])){
                                            if($_GET['salary'] != ""){
                                                $salary = $_GET['salary'];
                                            }
                                            else{
                                                $salary = "Mức lương";
                                            }
                                        }

                                        if(isset($_GET['quality'])){
                                            if($_GET['quality'] != ""){
                                                $quality = $_GET['quality'];
                                            }
                                            else{
                                                $quality = "Chất lượng";
                                            }
                                        }
                                    }else{
                                        $address = "Tỉnh thành";
                                        $job = "Nghề nghiệp";
                                        $salary = "Mức lương";
                                        $quality = "Chất lượng";
                                    }
                                ?>
                            <li class="nav-item dropdown nav-ftr_search">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $address?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php
                                        require_once './app/Controllers/AddressController.php';
                                        require_once './app/Controllers/JobController.php';

                                        $address = new AddressController();
                                        $list_province = $address->getAddress();
                                        foreach($list_province as $value){
                                            ?>
                                            <a class="dropdown-item"><?php echo $value?></a>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </li>
                            <li class="nav-item dropdown nav-ftr_search">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $job?>

                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php
                                        $job = new JobController();
                                        $list_job = $job->getJob();
                                        foreach($list_job as $value){
                                            ?>
                                            <a class="dropdown-item"><?php echo $value?></a>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </li>
                            <li class="nav-item dropdown nav-ftr_search">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $salary?>

                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item">< 20 triệu</a>
                                    <a class="dropdown-item">20 - 35 triệu</a>
                                    <a class="dropdown-item">35 - 50 triệu</a>
                                    <a class="dropdown-item">> 50 triệu</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown nav-ftr_search">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $quality?>

                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item">3 - 3.5 sao</a>
                                    <a class="dropdown-item">3.5 - 4 sao</a>
                                    <a class="dropdown-item">4 - 4.5 sao</a>
                                    <a class="dropdown-item">4.5 - 5 sao</a>
                                </div>
                            </li>
                            <a href="#content" class="btn-search_glass">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </ul>
                    </div>
                  </nav>
            </div>
        </div>
    </div>