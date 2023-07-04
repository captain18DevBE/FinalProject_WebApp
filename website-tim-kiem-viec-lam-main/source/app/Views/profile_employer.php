    <!-- Profile of Employer -->
    <div id="profile-employer">
        <div class="container-page">
            <div class="main-profile">
                <form class="profile-employer" method="post" action="./FormEmployer.php" enctype="multipart/form-data">
                    <div class="avatar-background">
                        <img src="./assets/images/default_background_employer.png" alt="" class="background-profile_user" width="100%" height="100%">
                    </div>
                    <?php
                        require_once './app/Controllers/EmployerController.php';
                        $employer = (new EmployerController())->getProfileEmployer();
                        require_once './app/Controllers/CompanyController.php';
                        $company = (new CompanyController())->getProfileCompany();
                    ?>
                    <div class="avatar-profile_employer">
                        <div class="avatar-profile_employer-img" style="background-image: url('<?php echo $company->logo?>')">
                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                            <div class="edit">
                                <input type="file" class="btn btn-upload" id="btn-upload_employer" name="avatar-profile">
                            </div>
                        </div>
                    </div>
                    <div class="detail-profile">
                        <i class="fa-solid fa-pen-to-square icon-edit"></i>
                        <div class="name-profile">
                            <label for="name-profile_employer">Họ và tên</label>
                            <input type="text" name="name-profile_employer" class="input-profile" id="name-profile_employer" disabled="disable" value="<?php echo $employer->name?>">
                        </div>
                        
                        <div class="number_phone-profile_employer">
                            <label for="number_phone-profile_employer">Số điện thoại</label>
                            <input type="text" name="number_phone-profile_employer" class="input-profile" id="number_phone-profile_employer" disabled="disable" value="<?php echo $employer->phone?>">
                        </div>
                        
                        <div class="email-profile">
                            <label for="email-profile">Email</label>
                            <input type="text" name="email-profile" class="input-profile" id="email-profile" disabled="disable" value="<?php echo $employer->email?>">
                        </div>

                        <div class="company-profile_employer">
                            <label for="company-profile_employer">Công ty</label>
                            <input type="text" name="company-profile_employer" class="input-profile" id="company-profile_employer" disabled="disable" value="<?php echo $company->name?>">
                        </div>

                        <div class="address_company-profile_employer">
                            <label for="address_company-profile_employer">Địa chỉ</label>
                            <input type="text" name="address_company-profile_employer" class="input-profile" id="address_company-profile_employer" disabled="disable" value="<?php echo $company->address?>">
                        </div>
                        
                        <div class="website-profile_employer">
                            <label for="website-profile_employer">Website</label>
                            <input type="text" name="website-profile_employer" class="input-profile" id="website-profile_employer" disabled="disable" value="<?php echo $company->website?>">
                        </div>

                        <div class="core_profession-profile_employer">
                            <label for="core_profession-profile_employer">Chuyên ngành</label>
                            <select class="form-select" aria-label="Default select example" name="service" disabled>
                                <option value = "<?php echo $company->serviceMain?>" selected><?php echo $company->serviceMain?></option>
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
                        </div>
                    </div>
                    <div class="edit btns">
                        <div class="btn btn-cancel">Hủy</div>
                        <button type="submit" class="btn btn-save" name="update_profile_company">Lưu</button>
                    </div>
                </form>
            </div>
            <div class="list-post">
                <div class="title-post">
                    <span>Post</span>
                    <i class="fa-solid fa-plus icon-add"></i>
                </div>
                <div class="manage-posts">
                    <?php
                        require_once './app/Controllers/PostController.php';
                        $list_post = (new PostController())->getPostByCompany();
                        if($list_post != []){
                            foreach($list_post as $post){
                                ?>
                                    <div class="detail-profile-employer">
                                        <div class="info-post">
                                            <div class="img-post_employer" style="border: 1px solid var(--main-color);">
                                                <img src="<?php echo $post->logo?>" alt="" width="100%" height="100%">
                                            </div>
                                            <div class="info-post_employer">
                                                <div class="title-post-employer">
                                                    <?php echo $post->title?>
                                                </div>
                                                <div class="detail-info_post-employer">
                                                    <span>Ngày đăng bài: <?php echo $post->postDate?>
                                                    <br>Số lượt xem: <?php echo $post->view?>
                                                    <br>Số lượng nhân viên tuyển: <?php echo $post->numberCandidate?>  |  Ứng cử viên đăng ký: 
                                                    <?php 
                                                        require_once './app/Controllers/CandidateController.php';
                                                        $list_candidate = (new CandidateController())->getAllCandidate($post->id);
                                                        $list_candidate_accpet = (new CandidateController())->getAcceptCandidate($post->id);
                                                        echo count($list_candidate);
                                                    ?>
                                                    <br>Ứng cử viên trúng tuyển: <?php echo count($list_candidate_accpet)?>
                                                    <br>Vị trí tuyển: <?php echo $post->job?>
                                                    <br>Lương: <?php echo $post->minsalary." - ".$post->maxsalary?> VNĐ</span>
                                                </div>
                                                <div class="btns">
                                                    <div class="btn btn-detail">
                                                        Xem bài đăng
                                                    </div>
                                                    <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal_modal_post">
                                            <form class="modal-cv modal-post" method="post" enctype="multipart/form-data" action="./FormPost.php">
                                                    <!-- main-post -->
                                                <input type="hidden" name="id" value="<?php echo $post->id?>">
                                                <div class="post-company">
                                                    <div class="post-logo"><img src="<?php echo $post->logo?>" alt="" width="100%"></div>
                                                    <div class="post-info_company">
                                                        <a class="post-name_company" href="#">
                                                            <?php echo $post->nameCompany?>
                                                        </a>
                                                        <div class="company-info">
                                                            <div class="post-company_address"><?php echo $post->address?></div>
                                                            <div class="company-sub_info">
                                                                <div><i class="fa-sharp fa-solid fa-user-plus"></i>: <?php echo $post->numberCandidate." ".$post->job?></div>
                                                                <span><i class="fa-sharp fa-solid fa-money-bill"></i>: <?php echo $post->minsalary." - ".$post->maxsalary?> VNĐ</span>
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
                                                                $job_position = (new JobPositionController())->getDetailJob($post->id);
                                                                // $list_id_job = [];
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
                                                                <textarea name="description-job_<?php echo $post->id?>" id="description-job" cols="90" rows="10" disabled >
                                                                    <?php echo $post->description_job?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                        <div class="requirement">
                                                            <label for="requirement-job">Yêu cầu ứng viên</label>
                                                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                            <p>
                                                                <textarea name="requirement-job_<?php echo $post->id?>" id="requirement-job" cols="90" rows="10" disabled>
                                                                    <?php echo $post->require_job?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                        <div class="benefits">
                                                            <label for="benefits-job">Quyền lợi</label>
                                                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                            <p>
                                                                <textarea name="benefits-job_<?php echo $post->id?>" id="benefits-job" cols="90" rows="10" disabled>
                                                                    <?php echo $post->benefit_job?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                        <div class="others-requirement">
                                                            <label for="others-requirement-job">Yêu cầu khác</label>
                                                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                                            <p>
                                                                <textarea name="others-requirement-job_<?php echo $post->id?>" id="others-requirement-job" cols="90" rows="10" disabled>
                                                                    <?php echo $post->others_requirement?>
                                                                </textarea>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="btns">
                                                        <div class="btn btn-cancel">Hủy</div>
                                                        <div class="edit btns">
                                                            <button type="submit" class="btn btn-save" name="update_post_<?php echo $post->id?>">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="candidates-chosen">
                                            <div class="title-candidate">Ứng viên được chọn</div>
                                            <div class="info-candidate">
                                                <table>
                                                    <tr>
                                                        <th>Thông tin ứng viên</th>
                                                        <th>Chi tiết tuyển chọn</th>
                                                    </tr>
                                                    <?php
                                                            if($list_candidate_accpet != []){
                                                                foreach($list_candidate_accpet as $candidate){
                                                                        ?>
                                                                        <tr>
                                                                            <td>
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
                                                                            </td>
                                                                            <td>
                                                                                <span>
                                                                                    Ứng tuyển: <?php echo $candidate->dateApply?> <br>
                                                                                    Ngày được chọn: <?php echo $candidate->dateAccept?> <br>
                                                                                </span>
                                                                                <div class="label-choose">
                                                                                    Đã duyệt
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                }
                                                            }
                                                            else{
                                                                ?>
                                                                <tr>
                                                                    <td>Không có ứng viên nào</td>
                                                                    <td>Không có thông tin nào</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="candidates-register">
                                            <div class="title-candidate">Ứng viên đăng kí</div>
                                            <div class="info-candidate">
                                                <table>
                                                    <tr>
                                                        <th>Thông tin ứng viên</th>
                                                        <th>Chi tiết tuyển chọn</th>
                                                    </tr>
                                                    <script>
                                                        function refuseCV(btn, idpost, cv){
                                                            let data = {
                                                                idPost: idpost,
                                                                src: cv
                                                            };
                                    
                                                            fetch('./refuseCandidate.php', {
                                                                method: 'PUT', 
                                                                headers: {
                                                                    'Content-Type': 'application/json'
                                                                },
                                                                body: JSON.stringify(data)
                                                            })
                                                            .then(response => response.json())
                                                        }

                                                        function acceptCV(btn, idpost, cv){
                                                            var modal_modal_post = $(btn).closest('tr').find('.modal_modal_post')
                                                            console.log($(btn))
                                                            
                                                            $(modal_modal_post).css('display', 'none')
                                                            var modal_recruiment = $(modal_modal_post).find('.modal-recruiment')
                                                            $(modal_recruiment).css('display', 'none')
                                                            
                                                            let data = {
                                                                idPost: idpost,
                                                                src: cv
                                                            };

                                                            fetch('./acceptCandidate.php', {
                                                                method: 'PUT', 
                                                                headers: {
                                                                    'Content-Type': 'application/json'
                                                                },
                                                                body: JSON.stringify(data)
                                                            })
                                                            .then(response => response.json())
                                                        }
                                                    </script>
                                                    <?php
                                                        if($list_candidate != []){
                                                            foreach($list_candidate as $candidate){
                                                                    ?>
                                                                    <tr>
                                                                        <td>
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
                                                                        </td>
                                                                        <td>
                                                                            <span>
                                                                                Ứng tuyển: <?php echo $candidate->dateApply?> <br>
                                                                                <div class="btns">
                                                                                    <div class="btn btn-add">Tuyển dụng</div>
                                                                                </div>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            
                                                                        <div class="modal_modal_post">
                                                                            <form class="modal-cv modal-recruiment" method="post" enctype="multipart/form-data" action=".FormAcceptCandidate.php">
                                                                                <table>
                                                                                    <tr>
                                                                                        <th>Thông tin ứng viên</th>
                                                                                        <td>
                                                                                            <div class="tag-candidate">
                                                                                                <div class="img-candidate">
                                                                                                    <img src="<?php echo $candidate->avatar?>" alt="" width="100%" height="100%">
                                                                                                    <img src="<?php echo $candidate->cv?>" alt="" class="img-cv non-active">
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
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Chi tiết tuyển chọn</th>
                                                                                        <td>
                                                                                            <span>
                                                                                                Ứng tuyển: <?php echo $candidate->dateApply?> <br>
                                                                                            </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <div class="btns">
                                                                                    <div class="btn btn-cancel" onclick="refuseCV(this, '<?php echo $candidate->idPost?>', '<?php echo $candidate->cv?>')">Từ chối</div>
                                                                                    <div class="btn btn-cancel">Hủy</div>
                                                                                    <div class="btn btn-save" onclick="acceptCV(this, '<?php echo $candidate->idPost?>', '<?php echo $candidate->cv?>')">Tuyển</div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        </td>
                                                                    </tr>
        
                                                                    <?php
                                                            }
                                                        }
                                                        else{
                                                            ?>
                                                            <tr>
                                                                <td>Không có ứng viên nào</td>
                                                                <td>Không có thông tin nào</td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
    
                                <?php
                            }
                        }
                        else{
                            echo "Bài đăng không tồn tại hoặc không có bài đăng nào";
                        }
                    ?>
                </div>
            </div>
            <div class="list-company_follow">
            </div>
            <div class="modal_modal_post">
                <form class="modal-cv modal-example-post" method="post" action="./FormPost.php" enctype="multipart/form-data">
                    <!-- main-post -->
                    <div class="title-post">
                        <input type="text" name="title-post" id="title-post" style="width: 100%; padding: 2px; margin: 1px" placeholder="Nhập tiêu đề">
                    </div>
                    <div class="post-company">
                        <div class="post-logo"><img src="<?php echo $company->logo?>" alt="" width="100%"></div>
                        <div class="post-info_company">
                            <a class="post-name_company" href="#">
                                <?php echo $company->name?>
                            </a>
                            <div class="company-info">
                                <div class="post-company_address"><?php echo $company->address?></div>
                                <div class="company-sub_info">
                                    <input type="hidden" name="service-company" value="<?php echo $company->serviceMain?>">
                                    <div><i class="fa-sharp fa-solid fa-user-plus"></i>: <input type="text" class="input-profile" id="main-job" disabled="disable" name="main-job" value="" placeholder="Nhập công việc chính"></div>                                </div>
                            </div>
                        </div>
                        <i class="fa-solid fa-pen-to-square icon-edit"></i>
                    </div>
                    <div class="post-job">
                        <div class="container-recruit_job">
                            <p>Vị trí ứng tuyển</p>
                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                            <i class="fa-solid fa-plus icon-add"></i>
                            <div class="recruit-jobs">
                                <div class="recruit-job">
                                    <div class="info-job">
                                        <input type="text" class="input-profile" disabled="disable" value="" placeholder="Nhập công việc" name="list_job[]">
                                        <div class="sub-info"> 
                                            <i class="fa-sharp fa-solid fa-user-plus"></i>
                                            <input type="text" class="input-profile" disabled="disable" value="" placeholder="Nhập số lượng" name="list_number_candidate[]">
                                            <div>
                                                <i class="fa-sharp fa-solid fa-money-bill"></i>
                                                <input type="text" class="input-profile" disabled="disable" value="" placeholder="Nhập lương tối thiểu" name="list_minsalary[]">
                                                <input type="text" class="input-profile" disabled="disable" value="" placeholder="Nhập lương cao nhất" name="list_maxsalary[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit">
                                        <i class="fa-solid fa-trash icon-trash"></i>
                                    </div>
                                </div>
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
                                    <textarea name="description-job" id="description-job" cols="90" rows="10" disabled placeholder="Nhập mô tả về công việc"></textarea>
                                </p>
                            </div>
                            <div class="requirement">
                                <label for="requirement-job">Yêu cầu ứng viên</label>
                                <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                <p>
                                    <textarea name="requirement-job" id="requirement-job" cols="90" rows="10" disabled placeholder="Nhập yêu cầu về ứng viên"></textarea>
                                </p>
                            </div>
                            <div class="benefits">
                                <label for="benefits-job">Quyền lợi</label>
                                <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                <p>
                                    <textarea name="benefit-job" id="benefits-job" cols="90" rows="10" disabled placeholder="Nhập quyền lợi"></textarea>
                                </p>
                            </div>
                            <div class="others-requirement">
                                <label for="bothers-requirement-job">Yêu cầu khác</label>
                                <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                <p>
                                    <textarea name="others-requirement-job" id="others-requirement-job" cols="90" rows="10" disabled placeholder="Nhập các yêu cầu khác"></textarea>
                                </p>
                            </div>
                        </div>
                        <div class="btns">
                            <div class="btn btn-cancel">Hủy</div>
                            <div class="edit btns">
                                <button type="submit" name="add_post" class="btn btn-save">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>