<!-- Profile -->
<div id="profile-job_seeker">
    <form class="container-page" method="post" action="./FormJobSeeker.php" enctype="multipart/form-data".>
        <div class="main-profile">
            <div class="navigation-profile">
                <div class="title-container_page">My profile</div>
                <ul class="menu-profile">
                    <li><i class="fa-solid fa-bars"></i></li>
                    <li><a href="#" class="selected">Hồ sơ của tôi</a></li>
                    <li><a href="#">CV của tôi</a></li>
                    <li><a href="#">Doanh nghiệp đang quan tâm</a></li>
                    <li><a href="#">Đăng xuất</a></li>
                </ul>
            </div>
            <div class="my-profile">
                <div class="avatar-background">
                    <img src="./assets/images/default_background_job_seeker.png" alt="" class="background-profile_user" width="100%" height="100%">
                </div>
                <?php
                    require_once ("./app/Controllers/JobSeekerController.php");
                    $job_seeker = (new JobSeekerController())->getInfoProfile($_SESSION['id']);
                ?>
                <div class="avatar-profile" style="background-image: url('<?php if($job_seeker->avatar == ""){echo "./assets/images/img_avatar_job_seeker/default_avatar.png";}else{echo $job_seeker->avatar;}?>')">
                    <i class="fa-solid fa-pen-to-square icon-edit"></i>
                    <div class="edit">
                        <input type="file" class="btn btn-upload" id="btn-upload" name="avatar-profile">
                    </div>
                </div>
                <div class="detail-profile">
                    <i class="fa-solid fa-pen-to-square icon-edit"></i>
                    <div class="name-profile">
                        <label for="name-profile">Họ và tên</label>
                        <input type="text" name="name-profile" class="input-profile" id="name-profile" disabled="disable" value="<?php echo $job_seeker->name?>">
                    </div>
                    
                    <div class="birthday-profile">
                        <label for="birthday-profile">Năm sinh</label>
                        <input type="datetime-local" name="birthday-profile" class="input-profile" id="birthday-profile" disabled="disable" value="<?php echo date('Y-m-d\T00:00', strtotime($job_seeker->birthday))?>">
                    </div>
                    
                    <div class="email-profile">
                        <label for="email-profile">Email</label>
                        <input type="email" name="email-profile" class="input-profile" id="email-profile" disabled="disable" value="<?php echo $job_seeker->email?>">
                    </div>
                    
                    <div class="experience-profile">
                        <label for="experience-profile">Kinh nghiệm</label>
                        <input type="text" name="experience-profile" class="input-profile" id="experience-profile" disabled="disable" value="<?php echo $job_seeker->experience?> năm">
                    </div>
                    
                    <div class="core_profession-profile">
                        <label for="core_profession-profile">Chuyên ngành</label>
                        <select class="form-select" aria-label="Default select example" name="core_profession-profile" disabled>
                                <option value = "<?php echo $job_seeker->sector?>" selected><?php echo $job_seeker->sector?></option>
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
            </div>
        </div>
        <div class="edit btns">
            <div class="btn btn-cancel">Hủy</div>
            <button type="submit" class="btn btn-save" name="save_profile_job_seeker">Lưu</button>
        </div>
        <div class="list-cv">
            <ul class="title-cv">
                <li>CV</li>
                <li>Thông tin CV</li>
                <li>Trạng thái CV</li>
                <li>Doanh nghiệp</li>
                <li>Xem / Chỉnh sửa CV</li>
            </ul>
            <div class="cvs">
                <?php
                    require_once ("./app/Controllers/CvController.php");
                    $list_cv = (new CvController())->getCV($_SESSION['id']);
                    foreach($list_cv as $cv){
                        ?>
                        <div class="cv">
                            <div class="img-cv">
                                <img src="<?php if($cv->image == ""){echo "./assets/images/img_cv/img-cv_default.jpg";}else{echo $cv->image;}?>" alt="" class="img-cv">
                            </div>  
                            <div class="info-cv">
                                <span class="name-cv"><input type="text" name="name-cv-<?php echo $cv->post?>" id="" value="<?php echo $cv->name?>" disabled="disable"></span>
                                <p class="decription-cv"><textarea name="description-cv-<?php echo $cv->post?>" id="" cols="20" rows="5" disabled><?php echo $cv->description?></textarea></p>
                            </div>
                            <div class="status-cv">
                                <?php
                                    if($cv->status == -1){
                                        echo "Bị từ chối";
                                    }
                                    else if($cv->status == 0){
                                        echo "Chưa nộp";
                                    }
                                    else if($cv->status == 1){
                                        echo "Chưa duyệt";
                                    }
                                    else{
                                        echo "Chấp nhận";
                                    }
                                ?>
                            </div>
                            <a class="company-cv" href="<?php if($cv->post == "0"){echo "";} else{ echo "?show_detail_post&idPost=$cv->post&service=$cv->service";}?>">
                                <?php echo $cv->company?>
                            </a>
                            <script>
                                function removeCV(btn, idcv){
                                    let data = {
                                        cv: idcv
                                    }
                                    fetch('./removeCV.php', {
                                        method: "DELETE", 
                                        headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                })
                                .then(response => response.json())
                                }
                            </script>
                            <div class="view-cv">
                                <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                <div class="btn btn-detail">Xem CV</div>
                                <div class="edit-cv edit">
                                    <i class="fa-solid fa-trash icon-trash" onclick='removeCV(this, <?php echo $cv->id?>)'></i>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    
                ?>
            </div>
            <div class="btns">
                <div class="btn btn-add">Thêm CV</div>
            </div>
        </div>
    </form>
</div>