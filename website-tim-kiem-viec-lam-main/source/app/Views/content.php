    <!-- Content -->
    <div id="content">
        <?php
            if($_SESSION['account'] ==  "Job seeker"){
                if(isset($_GET['page'])){
                    if(isset($_GET['search'])){
                        if((isset($_GET['address']) || isset($_GET['job']) || isset($_GET['salary']) || isset($_GET['quality']))){
                            if(($_GET['address'] != "" || $_GET['job']) != ""  || $_GET['salary'] != ""  || $_GET['quality'] != "" )
                            require_once("./app/Views/search_company.php");
                            require_once("./app/Views/list_company.php"); 
                        }
                    }
                    if($_GET['page'] == "job"){
                        require_once("./app/Views/list_company.php");  
                    }
                    else {
                        require_once("./app/Views/list_company.php");
                    }
                }
                else{
                    require_once("./app/Views/list_company.php"); 
                }
            }
            else{
                require_once("./app/Views/candidate_post.php");
            }
        ?>
    </div>
    