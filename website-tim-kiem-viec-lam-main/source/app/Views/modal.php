    <!-- Modal create CV -->
    <div id="modal">
        <form class="modal-cv modal-add_cv" method="post" action="./FormCV.php" enctype="multipart/form-data">
            <div class="img-add_cv">
                <a href="https://www.jobseeker.com/app/resumes/8bff5819-57bb-4a0c-bf14-929092ff952e/edit">Tạo CV</a>
                <div>
                    <input type="file" class="btn btn-upload" id="btn-upload_modal-cv" name="img-add-cv" readonly>
                </div>
            </div>
            <div class="decription-btn-modal_cv">
                <div class="decription-add">
                    <span>Tên CV</span> <br>
                    <input type="text" class="name-add_cv" name="name-add_cv"><br>
                    <span>Mô tả CV</span> 
                    <textarea name="description-add_cv" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="btns">
                    <div class="btn btn-cancel">Hủy</div>
                    <button type="submit" name="adding_cv" class="btn btn-add">Thêm CV</button>
                </div>
            </div>
        </form>
        <div class="modal-cv modal-view-cv">
            <div class="img-cv">
                <div>
                    <img src="" alt="" class="img-cv">
                </div>
            </div>
            <div class="btns">
                <div class="btn btn-cancel">
                    <?php echo "Hủy";?>
                </div>
                <a class="btn btn-add" href="?page=company_profile"><?php
                        if($_SESSION['account'] == 'Job seeker'){
                            echo "Ứng tuyển";
                        }
                        else{
                            echo "Tuyển dụng";
                        }?>
                </a>
            </div>
        </div>
    </div>