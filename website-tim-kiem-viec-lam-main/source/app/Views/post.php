    <!-- Infomation recruitment  -->
    <div id="post">
        <div class="post-container">
            <!-- main-post -->
            <div class="main-post">
                <div class="post-company">
                    <?php
                        require_once("./app/Controllers/PostController.php");
                        $post = new PostController();
                        $detail_post = $post->getDetailPost($_GET['idPost']);
                    ?>
                    <div class="post-logo"><img src="<?php echo $detail_post->logo?>" alt="" width="100%"></div>
                    <div class="post-info_company">
                        <a class="post-name_company" href="#">
                            <?php echo $detail_post->nameCompany?>
                        </a>
                        <div class="company-info">
                            <div class="post-company_address"><?php echo $detail_post->address?></div>
                            <div class="company-sub_info">
                                <div><i class="fa-sharp fa-solid fa-user-plus"></i>: <?php echo $detail_post->numberCandidate." ".$detail_post->job?></div>
                                <span><i class="fa-sharp fa-solid fa-money-bill"></i> : <?php echo $detail_post->minsalary." - ".$detail_post->maxsalary?> VNĐ</span>
                                <div class="rating"><?php echo $detail_post->quality?>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-job">
                    <div class="container-recruit_job">
                        <p>Vị trí ứng tuyển</p>
                        <div class="recruit-jobs">
                
                        <script>
                            function applyCV(btn, idJobSeeker, idPost, idJobPosition){
                                var announce = ""
                                let data = {
                                    idPost: idPost,
                                    idJobSeeker: idJobSeeker,
                                    idJobPosition: idJobPosition
                                }
                                fetch('./addCandidate.php', {
                                    method: 'post',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                })
                                .then(response => response.json())
                                if($(btn).text().trim() == "Ứng tuyển ngay"){
                                    $(btn).text('Đã nộp đơn')
                                }
                            }
                        </script>
                            <?php
                                require_once './app/Controllers/JobPositionController.php';

                                $job_position = (new JobPositionController())->getDetailJob($_GET['idPost']);
                                foreach($job_position as $key=>$value){
                                    ?>
                                    <div class="recruit-job">
                                        <div class="info-job">
                                            <a class="name-job" href="https://www.w3schools.com/whatis/whatis_frontenddev.asp"><?php echo $value->name?></a>
                                            <div class="sub-info">
                                                <i class="fa-sharp fa-solid fa-user-plus"></i>: <?php echo $value->detailNumberCandidate?>
                                                <i class="fa-sharp fa-solid fa-money-bill"></i> : <?php echo $value->minsalary." - ".$value->maxsalary?>
                                            </div>
                                        </div>
                                        <?php
                                            if($_SESSION['status'] == "CONNECTING"){
                                                require_once './app/Controllers/CandidateController.php';
                                                $checkApply = (new CandidateController())->isSubmitCV($value->id, $_SESSION['id']);
                                                if($checkApply){
                                                    ?>
                                                    <div class="btn-apply">Đã nộp đơn</div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                        <div class="btn-apply" onclick="applyCV(this, <?php echo $_SESSION['id']?>, <?php echo $_GET['idPost']?>, <?php echo $value->id?>)">Ứng tuyển ngay</div>
                                                    <?php
                                                }
                                            }
                                            else{
                                                ?>
                                                <a class="btn-apply" href="./signin_jobseeker.php">Ứng tuyển ngay</a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                    <div class="detail-and-requirement">
                        <div>
                            <p>Chi tiết tuyển dụng</p>
                        </div>
                        <div class="description-job">
                            <span>Mô tả công việc</span>
                            <p>
                                <?php echo $detail_post->description_job?>
                            </p>
                        </div>
                        <div class="requirement">
                            <span>Yêu cầu ứng viên</span>
                            <p>
                                <?php echo $detail_post->require_job?>
                            </p>
                        </div>
                        <div class="benefits">
                            <span>Quyền lợi</span>
                            <p>
                                <?php echo $detail_post->benefit_job?>
                            </p>
                        </div>
                        <div class="others-requirement">
                            <span>Yêu cầu khác</span>
                            <p></p>
                        </div>
                    </div>
                    <script>
                        function setFollow(btn, idCompany){
                            if($(btn).text().trim() == "Quan tâm"){
                                $(btn).text('Đang quan tâm')
                            }
                            let data = {
                                company: idCompany
                            }
                            fetch('./setFollow.php', {
                                method: 'post',  
                                headers: {
                                'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(data)
                            })
                            .then(response => response.json())
                        }

                        function cancelFollow(btn, idCompany){
                            if($(btn).text().trim() == "Đang quan tâm"){
                                $(btn).text('Quan tâm')
                            }
                            let data = {
                                company: idCompany
                            }
                            fetch('./setFollow.php', {
                                method: 'PUT',  
                                headers: {
                                'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(data)
                            })
                            .then(response => response.json())
                        }
                    </script>
                    <div class="btns btns-company">
                        <?php
                            if($_SESSION['status'] == "NO CONNECT"){
                                ?>
                                <a class="btn btn-follow" href="./signin_jobseeker.php?page=my_profile">
                                        Quan tâm
                                    </a>
                                <?php
                            }
                            else{
                                require_once './app/Controllers/CompanyController.php';
                                $follow = (new CompanyController())->checkFollow($detail_post->idCompanny, $_SESSION['id']);
                                if($follow){
                                    ?>
                                    <div class="btn btn-follow" onclick="cancelFollow(this, <?php echo $detail_post->idCompanny?>)">
                                        Đang quan tâm
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="btn btn-follow" onclick="setFollow(this, <?php echo $detail_post->idCompanny?>)">
                                        Quan tâm
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="sub-post">
                <div class="container-sub_post">
                    <p>Giới thiệu công ty</p>
                    <div class="images-company" style="background-image: url('./assets/images/Image_company/TDTU.jpg');"></div>
                    <div class="website-company">Website <br><a href="<?php echo $detail_post->website?>"><?php echo $detail_post->website?></a></div>
                    <div class="sub-post_address">Địa điểm: <br>
                        - <?php echo $detail_post->detail_address?>
                    </div>
                    <span>Ngành nghề</span>
                    <div class="fields-company">
                        <div class="field-company">
                            <?php echo $detail_post->service?>
                        </div>
                    </div>
                    <button>
                        <a href="?intro_company&idCompany=<?php echo $detail_post->idCompanny?>">Xem thông tin</a>
                    </button>
                </div>
            </div>
        </div>
    </div>