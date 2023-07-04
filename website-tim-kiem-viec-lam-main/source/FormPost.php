<?php

    header('Content-Type: application/json') ;  
    session_start();    

    require_once "./app/Controllers/PostController.php";
    require_once './app/Controllers/JobPositionController.php';
    require_once './app/Controllers/JobController.php';
    require_once './app/Controllers/ServiceController.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = "";
        if(isset($_POST['id'])){
            $id = $_POST['id'];
        }
        if(isset($_POST["update_post_".$id])){
            $list_id_job = $_POST['list_id_job'];
            $data_job = [];
            foreach($list_id_job as $id_job){
                $job = [$_POST["name_job_".$id_job], $_POST["number_candidate_".$id_job], 
                            str_replace(",", "", $_POST["min_salary_candidate_".$id_job]), 
                            str_replace(",", "", $_POST["max_salary_candidate_".$id_job]), $id_job];
                array_push($data_job, $job);
            }
            $data_require = [];
            array_push($data_require, $_POST["description-job_".$id], $_POST["requirement-job_".$id], $_POST["benefits-job_".$id], $_POST["others-requirement-job_".$id]);
            $post = (new PostController())->updatePost($id, $data_job, $data_require);
            header('location: ./employer.php?page=candidate');
        }
        else if(isset($_POST["add_post"])){

            $list_job = $_POST['list_job'];
            $list_minsalary = $_POST['list_minsalary'];
            $list_maxsalary = $_POST['list_maxsalary'];
            $list_number_candidate = $_POST['list_number_candidate'];

            $title = $_POST['title-post'];
            $postDate = date('Y-m-d');
            $service = (new ServiceController())->getIdService($_POST['service-company']);
            $idJob = (new JobController())->getIdJob($_POST['main-job'], $service);

            $description_job = $_POST['description-job'];
            $requirement_job = $_POST['requirement-job'];
            $benefit_job = $_POST['benefit-job'];
            $others_requirement = $_POST['others-requirement-job'];

            $post = new PostController();
            $post->addPost($_SESSION['idCompany'], $title, $postDate, $idJob, 
                            $description_job, $requirement_job, $benefit_job, $others_requirement);
            $idPost = $post->getIdPost($_SESSION['idCompany'], $title, $postDate, $idJob);
            for($i = 0; $i < count($list_job); $i++){
                $job_position = (new JobPositionController())->insertJobPosition($idJob, $idPost, $list_job[$i], $list_minsalary[$i], 
                                                                                    $list_maxsalary[$i], $list_number_candidate[$i]);
            }
            header('location: ./employer.php?page=company_profile');
        }
    }

    else if($_SERVER['REQUEST_METHOD'] == 'PUT'){

        $json = file_get_contents("php://input");
        $data = json_decode($json);

        $id = $data->id;
        $updateView = (new PostController())->updateView($id);
        
        if(!$updateView)
            die(json_encode(array('code' => 0, 'message' => 'Cập nhật không thành công!'))) ;
        
        die(json_encode(array('code' => 0, 'message' => 'Cập nhật thành công'))) ;
    }
?>