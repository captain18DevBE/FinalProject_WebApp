<form class="intro-company container-page" action="./FormUpdateIntroCompany.php" method="POST" enctype="multipart/form-data">
            <div class="title-content">
                Giới thiệu công ty
            </div>
            <div class="intro-content">
                <div class="info-content">
                    <?php
                        require_once './app/Controllers/CompanyController.php';
                        $company = (new CompanyController())->getIntroCompany($_SESSION['idCompany']);
                    ?>
                    <div class="detail_info-content">
                        <div class="intro-name"><?php echo $company->name?></div>
                        <div class="detail-intro">
                            <textarea name="detail-intro" id="detail-intro" cols="85" rows="20"><?php echo $company->intro?></textarea>
                        </div>
                    </div>
                    <i class="fa-solid fa-pen-to-square icon-edit"></i> 
                    <div class="logo-intro">
                        <div class="logo-intro_img" style="background-image: url('<?php echo $company->logo?>')">
                        </div>
                    </div>
                </div>
                <div class="intro-address">
                    <div class="intro-address-company">
                        <textarea type="text" name="intro-address" id="intro-address" cols="85" rows="5"><?php echo $company->address?></textarea>
                    </div>
                    <div class="img-intro-address">
                        <div class="img-intro_address_detail" style="background-image: url('<?php echo $company->img_intro?>')">
                            <i class="fa-solid fa-pen-to-square icon-edit"></i>
                            <div class="edit">
                                <input type="file" class="btn btn-upload" id="btn-upload-img-intro_address" name="img-intro_address">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="service-company">
                    Ngành nghề chính: 
                    <div class="fields-company">
                        <div class="field-company">
                            <?php echo $company->serviceMain?>
                        </div>
                    </div>
                </div>
                <div class="some-img_company">
                    <div class="title-content">
                        Một số hình ảnh
                    </div>
                    <div class="some-img">
                        <!-- <i class="fa-solid fa-plus icon-add"></i> -->
                        <div class="container">
                            <div class="row">
                                <?php
                                    require_once './app/Controllers/ImageCompanyController.php';
                                    $some_img = (new ImageCompanyController())->getImageCompany($_SESSION['idCompany']);
                                    if($some_img != []){
                                        foreach($some_img as $img){
                                        ?> 
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="image-company_posted">
                                                <img src="<?php echo $img->src_img?>" alt="" width="100%" height="100%">
                                                <i class="fa-solid fa-trash icon-trash"></i>
                                            </div>
                                        </div>
                                        <?php
                                            
                                        }
                                    }
                                    else{
                                        echo "Không có hình ảnh nào";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit btns">
                <div class="btn btn-cancel">Hủy</div>
                <button type="submit" name="update_intro" class="btn btn-save">Lưu</button>
            </div>  
        </form>