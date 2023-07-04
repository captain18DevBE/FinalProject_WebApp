<div class="intro-company container-page">
            <div class="title-content">
                Giới thiệu công ty
            </div>
            <div class="intro-content">
                <div class="info-content">
                    <?php
                        require_once './app/Controllers/CompanyController.php';
                        $company = (new CompanyController())->getIntroCompanyPageJobSeeker($_GET['idCompany']);
                    ?>
                    <div class="detail_info-content">
                        <div class="intro-name"><?php echo $company->name?></div>
                        <div class="detail-intro">
                            <p>
                                <?php echo $company->intro?>
                            </p>
                        </div>
                    </div>
                    <div class="logo-intro">
                        <div class="logo-intro_img" style="background-image: url('<?php echo $company->logo?>')"></div>
                    </div>
                </div>
                <div class="intro-address">
                    <div class="intro-address-company">
                        <p>
                            <?php echo $company->address?>
                        </p>
                    </div>
                    <div class="img-intro-address">
                        <div class="img-intro_address_detail" style="background-image: url('<?php echo $company->img_intro?>')"></div>
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
                        <div class="container">
                            <div class="row">
                                <?php
                                    require_once './app/Controllers/ImageCompanyController.php';
                                    $some_img = (new ImageCompanyController())->getImageCompany($_GET['idCompany']);
                                    if($some_img != []){
                                        foreach($some_img as $img){
                                        ?> 
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                            <div class="image-company_posted">
                                                <img src="<?php echo $img->src_img?>" alt="" width="100%" height="100%">
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
        </div>