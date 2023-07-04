<div class="list-company_search running">
    <div class="title-content">
        <div class="title-curr">
            Kết quả tìm kiếm
        </div>
        <ul class="items-search">
            <li><div class="item-search">Tỉnh thành</div></li>
            <li><div class="item-search">Nghề nghiệp</div></li>
            <li><div class="item-search">Mức lương</div></li>
            <li><div class="item-search">Kinh nghiệm</div></li>
        </ul>
        <div class="btn-search_glass">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
    <div class="companies">
        <div class="container show">
            <div class="row">
                <?php
                    require_once ("./app/Controllers/PostController.php");
                    $post = new PostController();
                    $list_search_post = $post->searchPost();
                    foreach($list_search_post as $key=>$value){
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 container-company">
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
                                            <div class="rating"> <?php echo $value->quality?>
                                                <i class="fa-solid fa-star"></i>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-detail">
                                        <a class="btn-detail" href="?show_detail_post&idPost=<?php echo $value->id?>&service=<?php echo $value->service?>">    
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="pagination-main">
        <div class="container">
            <div class="Page navigation example">
                <ul class="pagination">
                </ul>
            </div>
        </div>
    </div>
</div>  