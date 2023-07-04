.<div class="candidates-posts container-page">
        <?php
            require_once "./app/Controllers/PostController.php";
            $post = (new PostController())->getPostByCompany();
            if($post == []){
                echo "Chưa có bài đăng nào";
            }
            else{
                foreach($post as $value){
                    ?>
                    <div class="candidate-post">
                        <div class="post">
                            <div class="title-post-side">
                                Thông tin bài đăng
                            </div>
                            <?php
                                if($value->id != ""){
                                    ?>
                                    <div class="post-info-employer">
                                        <div class="company">
                                            <div class="company-logo" style="background-image: url('<?php echo $value->logo?>'); background-size: contain; background-repeat: no-repeat;"></div>
                                            <div class="company-name">
                                                <b><?php echo $value->nameCompany?></b>
                                            </div>
                                            <div class="company-info">
                                                <?php echo $value->address?>
                                                <br>
                                                <i class="fa-sharp fa-solid fa-money-bill"></i> : <?php echo $value->minsalary." - ".$value->maxsalary?> VNĐ
                                                <br>
                                                <div class="company-sub_info">
                                                    <div><i class="fa-sharp fa-solid fa-user-plus"></i>: <?php echo $value->numberCandidate." ".$value->job?></div>
                                                    
                                                    <div class="rating"><?php echo $value->quality?>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-sub-info-employer">
                                            <div class="title-post-employer">
                                                <?php echo $value->title?>
                                            </div>
                                            <div class="detail-sub-info-employer">
                                                <p>
                                                    Ngày đăng bài: <?php echo $value->postDate?> <br>
                                                    Số lượt xem: <?php echo $value->view?> lượt xem <br>
                                                    Số lượng nhân viên tuyển: <?php echo $value->numberCandidate?> <br> 
                                                    Số ứng cử viên ứng tuyển:
                                                    <?php 
                                                        require_once './app/Controllers/CandidateController.php';
                                                        $list_candidate = (new CandidateController())->getAllCandidate($value->id);
                                                        echo count($list_candidate);
                                                    ?>
                                                    <br>
                                                    Công việc cần bổ sung: <?php echo $value->service?> <br>
                                                    Lương: <?php echo $value->minsalary." - ".$value->maxsalary?> VNĐ <br>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="btn btn-detail">
                                            Xem bài đăng
                                        </div>
                                            <!-- Modal create CV -->
                                        <div class="modal_modal_post">
                                            <form class="modal-cv modal-post" method="post" enctype="multipart/form-data" action="./FormPost.php">
                                                    <!-- main-post -->
                                                <input type="hidden" name="id" value="<?php echo $value->id?>">
                                                <div class="post-company">
                                                    <div class="post-logo"><img src="<?php echo $value->logo?>" alt="" width="100%"></div>
                                                    <div class="post-info_company">
                                                        <a class="post-name_company" href="#">
                                                            <?php echo $value->nameCompany?>
                                                        </a>
                                                        <div class="company-info">
                                                            <div class="post-company_address"><?php echo $value->address?></div>
                                                            <div class="company-sub_info">
                                                                <div><i class="fa-sharp fa-solid fa-user-plus"></i>: <?php echo $value->numberCandidate." ".$value->job?></div>
                                                                <span><i class="fa-sharp fa-solid fa-money-bill"></i>: <?php echo $value->minsalary." - ".$value->maxsalary?> VNĐ</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                </div>
                                                <div class="post-job">
                                                    <div class="container-recruit_job">
                                                        <p>Vị trí ứng tuyển</p>
                                                        <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                        <div class="recruit-jobs">
                                                            <?php
                                                                require_once './app/Controllers/JobPositionController.php';
                                                                $job_position = (new JobPositionController())->getDetailJob($value->id);
                                                                foreach($job_position as $key=>$job){
                                                                    ?>
                                                                    <div class="recruit-job">
                                                                        <div class="info-job">
                                                                            <input type="text" class="input-profile" disabled="disable" name="name_job_<?php echo $job->id?>" value="<?php echo $job->name?>">
                                                                            <div class="sub-info"> 
                                                                                <input type="hidden" name="list_id_job[]" value="<?php echo $job->id?>">
                                                                                <i class="fa-sharp fa-solid fa-user-plus"></i>
                                                                                <input type="text" class="input-profile" disabled="disable" name="number_candidate_<?php echo $job->id?>" value=" <?php echo $job->detailNumberCandidate?> ">
                                                                                <div>
                                                                                    <i class="fa-sharp fa-solid fa-money-bill"></i>
                                                                                    <input type="text" class="input-profile" disabled="disable" name="min_salary_candidate_<?php echo $job->id?>" value="<?php echo $job->minsalary?>">
                                                                                    -
                                                                                    <input type="text" class="input-profile" disabled="disable" name="max_salary_candidate_<?php echo $job->id?>" value="<?php echo $job->maxsalary?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
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
                                                            <label for="description-job">Mô tả công việc</label>
                                                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                            <p>
                                                                <textarea name="description-job_<?php echo $value->id?>" id="description-job" cols="90" rows="10" disabled >
                                                                    <?php echo $value->description_job?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                        <div class="requirement">
                                                            <label for="requirement-job">Yêu cầu ứng viên</label>
                                                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                            <p>
                                                                <textarea name="requirement-job_<?php echo $value->id?>" id="requirement-job" cols="90" rows="10" disabled>
                                                                    <?php echo $value->require_job?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                        <div class="benefits">
                                                            <label for="benefits-job">Quyền lợi</label>
                                                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                            <p>
                                                                <textarea name="benefits-job_<?php echo $value->id?>" id="benefits-job" cols="90" rows="10" disabled>
                                                                    <?php echo $value->benefit_job?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                        <div class="others-requirement">
                                                            <label for="others-requirement-job">Yêu cầu khác</label>
                                                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                            <p>
                                                                <textarea name="others-requirement-job_<?php echo $value->id?>" id="others-requirement-job" cols="90" rows="10" disabled>
                                                                    <?php echo $value->others_requirement?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="btns">
                                                        <div class="btn btn-cancel">Hủy</div>
                                                        <div class="edit btns">
                                                            <button type="submit" class="btn btn-save" name="update_post_<?php echo $value->id?>">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                }
                                else{
                                    echo "Không có bài đăng nào!";
                                }
                            ?>
                        </div>
                        <div class="candidates">
                            <div class="candidates-new">
                                <div class="title-content">
                                    Ứng viên mới
                                </div>
                                <div class="container-candidate">
                                    <?php
                                        require_once "./app/Controllers/CandidateController.php";
                                        $list_candidate = (new CandidateController())->getNewCandidate($value->id);
                                        if($list_candidate != []){
                                            foreach($list_candidate as $candidate){
                                                ?>
    
                                                    <div class="tag-candidate">
                                                        <div class="img-candidate">
                                                            <img src="<?php echo $candidate->avatar?>" alt="" width="100%" height="100%">
                                                            <img src="<?php echo $candidate->cv?>" alt="" class="img-cv non-active">
                                                            <div class="candidate-detail">
                                                                <div class="view-cv">
                                                                    <div class="btn btn-detail">Xem CV</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="info-candidate">
                                                            <span class="name-candidate"><?php echo $candidate->name?></span>
                                                            <p class="decription-candidate">
                                                                Năm sinh: <?php echo $candidate->birthday?> <br>
                                                                Email: <?php echo $candidate->email?> <br>
                                                                Kinh nghiệm: <?php echo $candidate->experience?> năm <br>
                                                                Chuyên ngành: 
                                                                <?php 
                                                                    require_once './app/Controllers/ServiceController.php';
                                                                    echo (new ServiceController())->getaNameService($candidate->sector);
                                                                ?> <br>
                                                                Vị trí ứng tuyển: 
                                                                <?php
                                                                    require_once './app/Controllers/JobPositionController.php';
                                                                    $nameJob = (new JobPositionController())->getNameJobById($candidate->jobPosition);
                                                                    echo $nameJob;
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
    
                                                <?php
                                            }
                                        }
                                        else{
                                            echo "Không có ứng viên nào!";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="candidates-all">
                                <div class="title-content">
                                    Tất cả ứng viên
                                </div>
                                <div class="container-candidate">
                                    <?php
                                    if($value->id != ""){
                                        $list_candidate = (new CandidateController())->getAllCandidate($value->id);
                                        foreach($list_candidate as $candidate){
                                            ?>
                                                <div class="tag-candidate">
                                                    <div class="img-candidate">
                                                        <img src="<?php echo $candidate->avatar?>" alt="" width="100%" height="100%">
                                                        <img src="<?php echo $candidate->cv?>" alt="" class="img-cv non-active">
                                                        <div class="candidate-detail">
                                                            <div class="view-cv">
                                                                <div class="btn btn-detail">Xem CV</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-candidate">
                                                        <span class="name-candidate"><?php echo $candidate->name?></span>
                                                        <p class="decription-candidate">
                                                            Năm sinh: <?php echo $candidate->birthday?> <br>
                                                            Email: <?php echo $candidate->email?> <br>
                                                            Kinh nghiệm: <?php echo $candidate->experience?> năm <br>
                                                            Chuyên ngành: <?php 
                                                                require_once './app/Controllers/ServiceController.php';
                                                                echo (new ServiceController())->getaNameService($candidate->sector);
                                                            ?> <br>
                                                            Vị trí ứng tuyển: 
                                                            <?php
                                                                require_once './app/Controllers/JobPositionController.php';
                                                                $nameJob = (new JobPositionController())->getNameJobById($candidate->jobPosition);
                                                                echo $nameJob;
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>

                                            <?php
                                        }
                                    }
                                    else{
                                        echo "Không có ứng viên nào!";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
        ?>
    <!-- <div class="candidate-suggest">
        <div class="container-candidate-suggest">
            <div class="title-content">
                Ứng viên tiềm năng
            </div>
            <div class="container-candidate">
                <div class="tag-candidate">
                    <div class="img-candidate">
                        <img src="./assets/images/img_candidate/candidate_nguyentiendat.png" alt="" width="100%" height="100%">
                        <img src="./assets/images/img_cv/CV_NguyenTienDat.png" alt="" class="img-cv non-active">
                        <div class="candidate-detail">
                            <div class="view-cv">
                                <div class="btn btn-detail">Xem CV</div>
                            </div>
                        </div>
                    </div>
                    <div class="info-candidate">
                        <span class="name-candidate">Nguyễn Tiến Đạt</span>
                        <p class="decription-candidate">
                            Năm sinh: 24/12/2003 <br>
                            Email: nguyenhuutin124@gmail.com <br>
                            Kinh nghiệm: 5 năm <br>
                            Chuyên ngành: Lập trình Web và App <br>
                        </p>
                    </div>
                </div>
                <div class="tag-candidate">
                    <div class="img-candidate">
                        <img src="./assets/images/img_candidate/candidate_nguyentiendat.png" alt="" width="100%" height="100%">
                        <img src="./assets/images/img_cv/CV2.png" alt="" class="img-cv non-active">
                        <div class="candidate-detail">
                            <div class="view-cv">
                                <div class="btn btn-detail">Xem CV</div>
                            </div>
                        </div>
                    </div>
                    <div class="info-candidate">
                        <span class="name-candidate">Nguyễn Tiến Đạt</span>
                        <p class="decription-candidate">
                            Năm sinh: 24/12/2003 <br>
                            Email: nguyenhuutin124@gmail.com <br>
                            Kinh nghiệm: 5 năm <br>
                            Chuyên ngành: Lập trình Web và App <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>