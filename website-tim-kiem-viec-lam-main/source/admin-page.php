<?php
    session_start()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <link rel="stylesheet" href="./assets/base_register.css">
    <link rel="stylesheet" href="./assets/admin-page.css">
    <title>Admin management</title>
</head>
<body>
    <div class="head">
    <!-- <div class="header"></div> -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item" id="btn--main-page">
                <a style="color:white" class="nav-link active" aria-current="page" href="./index.php">Trang chủ</a>
                </li>
                <li class="nav-item" id="btn--job-seeker">
                <a style="color:white" class="nav-link" href="#">Người Tìm Việc</a>
                </li>
                <li class="nav-item" id="btn--employer">
                <a style="color:white" class="nav-link" href="#">Nhà Tuyển Dụng</a>
                </li>

                <li class="nav-item dropdown">
                <a style="color:white" class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Bài đăng
                </a>
                <ul class="dropdown-menu item-shadow" aria-labelledby="navbarScrollingDropdown">
                    <li id="btn-accepted" class="nav-item"><a class="dropdown-item" href="#">Đã được duyệt</a></li>
                    <li style="height: 4px;"><hr></li>
                    <li id="btn-no-accept" class="nav-item"><a class="dropdown-item" href="#">Chưa được duyệt</a></li>
                    <!-- <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    </div> 
   
    <div class="body" id="body">
            <table  id="displayTable" class="table table-striped">
                <thead>

                </thead>
                <tbody>

                </tbody>
            </table>
    </div>


    <!-- Button trigger modal -->
    <!-- <button type="button" id="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Open Modal
    </button> -->

    <!-- Scrollable modal -->
    <!-- modal chỉnh sửa thông tin tài khoản nhà tuyển dụng -->
    <div class="modal fade" id="modal-edit--employer" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">CẬP NHẬT THÔNG TIN NHÀ TUYỂN DỤNG</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-modal--group">
                <label for="name"><h5>Tên công ty</h5></label>
                <input type="text" placeholder="Tên công ty" name="name" id="modal-employer--name" class="register__form-input form-control"><br>
            </div>
            <div class="form-modal--group">
                <label for="username"><h5>Email</h5></label>
                <input type="text" placeholder="Tài khoản" name="username" id="modal-employer--username" class="register__form-input form-control"><br>
            </div>
            <div class="form-modal--group">
                <label for="password"><h5>Mật khẩu</h5></label>
                <input type="text" placeholder="Mật khẩu" name="name" id="modal-employer--password" class="register__form-input form-control"><br>
            </div>
            <div class="form-modal--group">
                <label for="website"><h5>website</h5></label>
                <input type="text" placeholder="Website" name="website" id="modal-employer--website" class="register__form-input form-control"><br>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-primary" id="btn-change-employer">Lưu thay đổi</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Scrollable modal Boostrap v5-->
    <!-- modal chỉnh sủa thông tin tài khoản người tìm việc -->
    <div class="modal fade" id="modal-edit-jobseeker" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">CẬP NHẬT THÔNG TIN TÀI KHOẢN NGƯỜI TÌM VIỆC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-modal--group">
                <label for="name"><h5>Họ và Tên</h5></label>
                <input type="text" placeholder="Họ và Tên" name="name" id="modal-jobseeker--name" class="register__form-input form-control"><br>
            </div>
            <div class="form-modal--group">
                <label for="username"><h5>Địa chỉ email</h5></label>
                <input type="text" placeholder="Địa chỉ email" name="username" id="modal-jobseeker--username" class="register__form-input form-control"><br>
            </div>
            <div class="form-modal--group">
                <label for="password"><h5>Mật khẩu</h5></label>
                <input type="text" placeholder="Mật khẩu" name="name" id="modal-jobseeker--password" class="register__form-input form-control"><br>
            </div>
            <div class="form-modal--group">
                <label for="website"><h5>Số điện thoại</h5></label>
                <input type="text" placeholder="Số điện thoại" name="website" id="modal-jobseeker--website" class="register__form-input form-control"><br>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-primary" id="btn-change-jobseeker">Lưu thay đổi</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal confirm delete an account employer in boostrap v5-->
    <div class="modal fade" id="modal-delete--employer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">THÔNG BÁO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>XÁC NHẬN XÓA THÔNG TIN TÀI KHOẢN!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" id="btn-confirm-delete-employer" class="btn btn-primary">Xóa tài khoản</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal confirm to lock an account jobseeker in boostrap v5-->
    <div class="modal fade" id="modal-lock--jobseeker" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">THÔNG BÁO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>XÁC NHẬN KHÓA QUYỀN TRUY CẬP CỦA TÀI KHOẢN!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" id="btn-confirm-lock-employer" class="btn btn-primary">Khóa tài khoản</button>
        </div>
        </div>
    </div>
    </div>
</body>


    <script>

        //Hàm sử dụng lấy danh sách thông tin tài khoản của nhà tuyển dụng
        function loadEmployer() {
            var bodyDiv = $('#displayTable thead');
            bodyDiv.empty();
            strTableHead = 
                `
                    <tr>
                        <th style="width: 7%" id="colum--id">ID</th>
                        <th style="width: 15%" id="colum--id">Tên công ty</th>
                        <th style="width: 20%" id="colum--website">Website</th>
                        <th style="width: 20%" id="colum--address">Email</th>
                        <th style="width: 23%" id="colum--service">Mật khẩu</th>
                        <th style="width: 15%"id="colum--service">Thao tác</th>
                    </tr>
                `
            bodyDiv.append(strTableHead);
            $.ajax({
                url:'ajax-admin-employer.php',
                method: 'GET',
                success:function(data) {
                    var tableBody = $('#displayTable tbody')
                    var employers = JSON.parse(data);
                    tableBody.empty();
                    employers.forEach(function(employer) {
                        var employerInfo = '<tr>' +
                                        '<td>' + employer.id + '</td>' +
                                        '<td>' + employer.name + '</td>' +
                                        '<td>' + employer.website + '</td>' +
                                        '<td>' + employer.emailEmployer + '</td>' +
                                        '<td>' + employer.passwordEmployer + '</td>' +
                                        '<td>'+
                                        '<button id="btn-edit-employer" data-bs-toggle="modal" data-bs-target="#modal-edit--employer" type="button" class="btn btn-primary btn-update-job-seeker btn-info">Chỉnh sửa</button>'+
                                        '<button id="btn-delete-employer" type="button" data-bs-toggle="modal" data-bs-target="#modal-delete--employer" class="btn btn-primary btn-delete-job-seeker btn-dark">Xóa</button>'
                                        + '</td>'
                                        '</tr>';
                        tableBody.append(employerInfo);
                    });
                },
                error:function(xhr, status, error) {
                    alert("Thất bại")
                }
            })
            // Hàm được sử dụng để chỉnh sửa thông tin nhà tuyển dụng
            $('#displayTable').on('click', '#btn-edit-employer', function() {
                        var idEmployer = $(this).closest('tr').find('td:nth-child(1)').text();
                        var name, username, password, website;
                        var data;
                        $('#modal-edit--employer #btn-change-employer').click(function () {
                            name = $('#modal-employer--name').val();
                            username = $('#modal-employer--username').val();
                            password = $('#modal-employer--password').val();
                            website = $('#modal-employer--website').val();
                            data = `idEmployer=${idEmployer}&name=${name}&emailEmployer=${username}&password=${password}&website=${website}`;
                            $.ajax({
                                url: 'ajax-admin-employer.php',
                                type: 'PUT',
                                data: data,
                                success:function(response) {
                                    // var res = JSON.parse(response);
                                    // alert(res.success);
                                    console.log(response)
                                    loadEmployer();
                                    $('#modal-edit--employer').modal('hide');
                                },
                                error:function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }

                            });
                        });
            });
            $('#displayTable').on('click', '#btn-delete-employer', function() {
                    var idCompany = $(this).closest('tr').find('td:nth-child(1)').text();
                    data = {idCompany:idCompany};
                    $('#modal-delete--employer #btn-confirm-delete-employer').click(function () {
                        $.ajax({
                            url: 'ajax-admin-employer.php',
                            method: 'POST',
                            data:data,
                            success:function(response) {
                                $('#modal-delete--employer').modal('hide');
                                loadEmployer();
                                console.log(response)
                            },
                            error:function(xhr, status, error) {
                            console.log(xhr.responseText);
                            }
                        })
                        // alert(data)
                    });
            })

        }

        //Hàm sử dụng lấy danh sách thông tin tài khoản người tìm việc
        function loadJobSeeker() {
            var bodyDiv = $('#displayTable thead');
            bodyDiv.empty();
            strTableHead = 
                `
                    <tr>
                        <th style="width: 5%" id="colum--id">ID</th>
                        <th style="width: 15%" id="colum--ten">Họ và tên</th>
                        <th style="width: 15%" id="colum--email">Email</th>
                        <th style="width: 15%" id="colum--password">Mật khẩu</th>
                        <th style="width: 15%" id="colum--phone">Số điện thoại</th>
                        <th style="width: 15%" id="colum--address">Địa chỉ</th>
                        <th style="width: 7%" id="colum--account">Trạng thái</th>
                        <th style="width: 14%"id="colum--service">Thao tác</th>
                    </tr>
                `
            bodyDiv.append(strTableHead);
            $.ajax({
                url:'ajax-admin-jobseeker.php',
                method: 'GET',
                success:function(data) {
                    var tableBody = $('#displayTable tbody')
                    var jobSeekers = JSON.parse(data);
                    tableBody.empty();
                    jobSeekers.forEach(function(jobSeeker) {
                        var jobSeekerInfo = '<tr>' +
                                        '<td>' + jobSeeker.id + '</td>' +
                                        '<td>' + jobSeeker.name + '</td>' +
                                        '<td>' + jobSeeker.email + '</td>' +
                                        '<td>' + jobSeeker.password + '</td>' +
                                        '<td>' + jobSeeker.phone + '</td>' +
                                        '<td>' + jobSeeker.address + '</td>' +
                                        '<td>' + jobSeeker.accountStatus + '</td>' +
                                        '<td>'+
                                        '<button data-bs-toggle="modal" data-bs-target="#modal-edit-jobseeker" type="button" id="btn-edit-jobseeker" class="btn btn-update-job-seeker btn-info">Chỉnh sửa</button>'+
                                        '<button type="button" data-bs-toggle="modal" data-bs-target="#modal-lock--jobseeker" class="btn btn-delete-job-seeker btn-dark" id="btn-lock-jobseeker">Khóa</button>'
                                        + '</td>'
                                        '</tr>';
                        tableBody.append(jobSeekerInfo);
                    });
                },
                error:function(xhr, status, error) {
                    alert("Thất bại")
                }
            })

            // Hàm được sử dụng để chỉnh sửa thông người tìm việc
            $('#displayTable').on('click', '#btn-edit-jobseeker', function() {
                        var id = $(this).closest('tr').find('td:nth-child(1)').text();
                        var name, email, password, phone;
                        var data;
                        $('#modal-edit-jobseeker #btn-change-jobseeker').click(function () {

                            name = $('#modal-jobseeker--name').val();
                            email = $('#modal-jobseeker--username').val();
                            password = $('#modal-jobseeker--password').val();
                            phone = $('#modal-jobseeker--website').val();
                            data = `id=${id}&name=${name}&email=${email}&password=${password}&phone=${phone}`;

                            $.ajax({
                                url: 'ajax-admin-jobseeker.php',
                                type: 'PUT',
                                data: data,
                                success:function(response) {
                                    // var res = JSON.parse(response);
                                    // alert(res.success);
                                    console.log(response);
                                    $('#modal-edit-jobseeker').modal('hide');
                                    loadJobSeeker();
                                },
                                error:function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }

                            });
                        });


            });

            $('#displayTable').on('click', '#btn-lock-jobseeker', function() {
                        var idJobSeeker = $(this).closest('tr').find('td:nth-child(1)').text();
                        data = {idJobSeeker:idJobSeeker};

                        $('#modal-lock--jobseeker #btn-confirm-lock-employer').click(function () {
                            $.ajax({
                                url: 'ajax-admin-jobseeker.php',
                                method: 'POST',
                                data:data,
                                success:function(response) {
                                    $('#modal-lock--jobseeker').modal('hide');
                                    loadJobSeeker();
                                    console.log(response)
                                },
                                error:function(xhr, status, error) {
                                console.log(xhr.responseText);
                                }
                            })
                        });
            })
        }

        //Hàm hiển thị danh sách bài đăng đã được kiểm duyệt và hiển thị
        function loadPostIsAccept() {
            var bodyDiv = $('#displayTable thead');
            bodyDiv.empty();
            strTableHead = 
            `
                    <tr>
                    <th style="width: 5%" id="colum--id">ID</th>
                        <th style="width: 14% " id="colum--ten">Mô tả</th>
                        <th style="width: 8%" id="colum--id">Ngày đăng</th>
                        <th style="width: 8%" id="colum--address">Số lượng CV</th>
                        <th style="width: 25.5%" id="colum--website">Mức lương</th>
                        <th style="width: 25.5%" id="colum--service">Dịch vụ</th>
                        <th style="width: 14%"id="colum--service">Thao tác</th>

                    </tr>
                `
            bodyDiv.append(strTableHead);
            $.ajax({
                url:'ajax-admin-isaccept.php',
                method: 'GET',
                success:function(data) {
                    var tableBody = $('#displayTable tbody')
                    var posts = JSON.parse(data);
                    tableBody.empty();
                    posts.forEach(function(post) {
                        var postInfo = '<tr>' +
                                        '<td>' + post.id + '</td>' +
                                        '<td>' + post.title + '</td>' +
                                        '<td>' + post.postDate + '</td>' +
                                        '<td>' + post.numberCandidate + '</td>' +
                                        '<td>' + post.salary + '</td>' +
                                        '<td>' + post.service + '</td>' +
                                        '<td id="action-post">' + 
                                        '<button type="button" id="btn-delete--post" class="btn btn-accept-post btn-danger">Xóa bài</button>'
                                        + '</td>'
                                        '</tr>';
                        tableBody.append(postInfo);
                    });
                },
                error:function(xhr, status, error) {
                    alert("Thất bại")
                }
            })

            $('#displayTable').on('click', '#btn-delete--post', function() {
                        var idPost = $(this).closest('tr').find('td:nth-child(1)').text();
                        var data = `id=${idPost}`;
                        $.ajax({
                            url: 'ajax-admin-isaccept.php',
                            data: data,
                            type: 'POST',
                            success: function(response) {
                            //Load lại danh sách mới
                            loadPostIsAccept();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                        });
                    });
            
        }

        //Hàm hiển thị danh sách bài đăng chưa được kiểm duyệt
        function loadPostNoAccept() {
            var bodyDiv = $('#displayTable thead');
            bodyDiv.empty();
            strTableHead = 
            `
                    <tr>
                    <th style="width: 5%" id="colum--id">ID</th>
                        <th style="width: 14%" id="colum--ten">Mô tả</th>
                        <th style="width: 8%" id="colum--id">Ngày đăng</th>
                        <th style="width: 8%" id="colum--address">Số lượng CV</th>
                        <th style="width: 25.5%" id="colum--website">Mức lương</th>
                        <th style="width: 25.5%" id="colum--service">Dịch vụ</th>
                        <th style="width: 14%"id="colum--service">Thao tác</th>
                    </tr>
                `
            bodyDiv.append(strTableHead);
            $.ajax({
                url:'ajax-admin-notaccept.php',
                method: 'GET',
                success:function(data) {
                    var count = 0;
                    var tableBody = $('#displayTable tbody')
                    var posts = JSON.parse(data);
                    tableBody.empty();
                    posts.forEach(function(post) {
                        var postInfo = '<tr>' +
                                        '<td>' + post.id + '</td>' +
                                        '<td>' + post.title + '</td>' +
                                        '<td>' + post.postDate + '</td>' +
                                        '<td>' + post.numberCandidate + '</td>' +
                                        '<td>' + post.salary + '</td>' +
                                        '<td>' + post.service + '</td>' +
                                        '<td id="action-post">' + 
                                        `<button type="button" id="btn-accept--post" class="btn btn-accept-post btn-success">Duyệt bài</button>`+
                                        '<button type="button" id="btn-delete--post" class="btn btn-delete-post btn-danger">Xóa bài</button>'
                                        + '</td>' +
                                        '</tr>';
                        tableBody.append(postInfo);
                    });
                    $('#displayTable').on('click', '#btn-accept--post', function() {
                        var idPost = $(this).closest('tr').find('td:nth-child(1)').text();
                        var data = `id=${idPost}&accepted=1`;
                        $.ajax({
                            url: 'ajax-admin-notaccept.php',
                            type: 'PUT',
                            data: data,
                            success: function(response) {
                                //Load lại danh sách mới
                                loadPostNoAccept();
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    });

                    $('#displayTable').on('click', '#btn-delete--post', function() {
                        var idPost = $(this).closest('tr').find('td:nth-child(1)').text();
                        var data = `id=${idPost}`;
                        $.ajax({
                            url: 'ajax-admin-notaccept.php',
                            data: data,
                            type: 'POST',
                            success: function(response) {
                            //Load lại danh sách mới
                            console.log(response);
                            loadPostNoAccept();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                        });
                    });
                },
                error:function(xhr, status, error) {
                    alert("Thất bại")
                }
            })
        }


        $('#btn--employer').on('click', function(event) {
            loadEmployer();
        })

        $('#btn--job-seeker').on('click', function() {
            loadJobSeeker();
        })

        $('#btn-accepted').on('click', function() {
            loadPostIsAccept();
        })

        $('#btn-no-accept').on('click', function() {
            loadPostNoAccept();
        })

        $('#btn-accept--post').on('click', function() {
            
        });
    </script>


</html>