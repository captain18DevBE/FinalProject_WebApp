<div class="list-company running" id="list-company-stored">
    <div class="title-content">
        <div class="title-curr">
            <?php
                require_once("./app/Controllers/PostController.php");
                $post = new PostController();
                
                if(!isset($_GET['page']) && !isset($_GET['show_detail_post'])){
                    echo "Các công việc nổi bật";
                }
                else if(isset($_GET['show_detail_post'])){
                    echo "Các công việc liên quan";
                }
                else{
                    if($_GET['page'] == 'job'){
                        if(!isset($_GET['service'])){
                            echo "Các công việc nổi bật";
                        }
                        else{
                            $list_job_by_service = $post->getPostByService($_GET['service']);
                            echo $_GET['service'];
                        }
                    }
                    else if($_GET['page'] == 'my_profile'){
                        echo "Các công ty quan tâm";
                    }
                    else if($_GET['page'] == "highlight-company"){
                        echo "Công ty nổi bật";
                    }
                }
            ?>  
        </div>
        <div class="titles-other">
            <div class="switch-title">
                Các chủ đề khác
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <ul class="title-other">
                <?php
                    $Service = new ServiceController();
                    $list_Service = $Service->getForNavigation();
                    foreach($list_Service as $key=>$value){
                        ?>
                        <li><a href="?page=job&service=<?php echo $value['name']?>"><?php echo $value['name']?></a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="companies">
        <div class="container show">
            <div class="row">
            <?php
                if($_SESSION['status'] == "CONNECTING"){
                ?>
                <script>
                    function viewPost(idPost){
                        let data = {
                            id: idPost
                        };
    
                        fetch('./FormPost.php', {
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
                }
            ?>
            <?php
                if(isset($_GET['page'])){
                    if($_GET['page'] == "my_profile" || $_GET['page'] == 'highlight-company' || $_GET['page'] == 'company-numberCandidate'){
                        $list_some_post = "";
                        if($_GET['page'] == "my_profile"){
                            $list_some_post = $post->getPostByFollowingCompany($_SESSION['id']);
                        }
                        else if($_GET['page'] == 'highlight-company'){
                            $list_some_post = $post->getPostByHighlightCompany();
                        }
                        else if($_GET['page'] == 'company-numberCandidate'){
                            $list_some_post = $post->getPostByNumberCandidate();
                        }
                        foreach($list_some_post as $key=>$value){
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
                                            <a class="btn-detail" href="?show_detail_post&idPost=<?php echo $value->id?>&service=<?php echo $value->service?>" onclick="viewPost(<?php echo $value->id?>)">    
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                    else if(!isset($_GET['service'])){
                        $list_some_post = $post->getSomeJob();
                        foreach($list_some_post as $key=>$value){
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
                                            <a class="btn-detail" href="?show_detail_post&idPost=<?php echo $value->id?>&service=<?php echo $value->service?>" onclick="viewPost(<?php echo $value->id?>)">    
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                    else{
                        $list_job_by_service = $post->getPostByService($_GET['service']);
                        foreach($list_job_by_service as $key=>$value){
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
                                            <a class="btn-detail" href="?show_detail_post&idPost=<?php echo $value->id?>&service=<?php echo $value->service?>" onclick="viewPost(<?php echo $value->id?>)">    
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
                else if(!isset($_GET['service'])){
                    $list_some_post = $post->getSomeJob();
                    foreach($list_some_post as $key=>$value){
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
                                        <a class="btn-detail" href="?show_detail_post&idPost=<?php echo $value->id?>&service=<?php echo $value->service?>" onclick="viewPost(<?php echo $value->id?>)">    
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
                else{
                    $list_job_by_service = $post->getPostByService($_GET['service']);
                    foreach($list_job_by_service as $key=>$value){
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
                                        <a class="btn-detail" href="?show_detail_post&idPost=<?php echo $value->id?>&service=<?php echo $value->service?>" onclick="viewPost(<?php echo $value->id?>)">    
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>
                
            <?php
            ?>
            </div>
        </div>
    </div>
    <div class="pagination-main">
        <div class="container">
            <div class="Page navigation example">
                <ul class="pagination">
                    <!-- <li class="page-item"><a class="page-link disable" href="#">Previous</a></li> -->
                    <!-- <li class="page-item"><a class="page-link" href="#">1</a></li> -->
                    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                    <!-- <li class="page-item"><a class="page-link disable" href="#">Next</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</div>