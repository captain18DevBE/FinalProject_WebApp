// ==================================FUNCTION=========================================
// Click to change value of button
function click_to_change_value_btn(btn, value){
    $(btn).text(value)
}

// Create function to add event change for upload input
function uploadImage(inputImage){
    inputImage.addEventListener('change', (event)=>{
        const file = event.target.files[0];
        const imageUrl = URL.createObjectURL(file)
        const imageElement = inputImage.parentElement.parentElement 
        imageElement.style.backgroundImage = `url('${imageUrl}')`
    })
}

// set enabel input
function set_input_enable(){
    var input_selector = $('input')
    var textarea_selector = $('textarea')
    var select = $('select')
    $(input_selector).each(function(){  
        $(this).prop('disabled', false)
    })
    $(textarea_selector).each(function(){
        
        $(this).prop('disabled', false)
    })
    $(select).each(function(){
        
        $(this).prop('disabled', false)
    })
}

// SEt disable input
function set_input_disable(){
    var input_selector = $('input[type="text"]')
    var textarea_selector = $('textarea')
    var select = $('select')
    $(input_selector).each(function(){  
        $(this).prop('disabled', true)
    })
    $(textarea_selector).each(function(){
        
        $(this).prop('disabled', true)
    })
    $(select).each(function(){
        
        $(this).prop('disabled', true)
    })
}

// Find Element by text
function findElementByTextPost(elements, text){
    var value = []
    elements.each(function(){
        if($(this).text().trim() == text){
            value.push($(this))
        }
    })
    return value
}


// =====================USE FUNCTION =========================================
// Click to show post element
$('.company-detail .btn-detail').click(function(){
    $("#post").css('display', 'flex')
})

// click to change title of profile navigation
$('.menu-profile li a').each(function(){
    $(this).click(function(){
        $('.selected').removeClass('selected')
        $(this).addClass('selected')
    })
})

// Click to show profile navigation

$('.menu-profile li i').click(function(){
    if($('.menu-profile li a').css('display') == "flex"){
        $(this).css('animation', 'rotate_close 0.2s linear')
        $('.menu-profile li a').css('display', 'none')
        $('.menu-profile').css('width', '35%')
    }
    else{
        $(this).css('animation', 'rotate_open 0.2s linear')
        $('.menu-profile li a').css('display', 'flex')
        $('.menu-profile').css('width', '100%')
    }
})

// -------------------------Edit and Save----------------------------------
var old_input_status = []
var list_input = $('input')
$(list_input).each(function(){
    old_input_status.push($(this).val())
})

// Click to open edit panel
$('.icon-edit').click(function(){
    var edit_selector = $('.edit')
    $(edit_selector).each(function(){
        $(this).css('display', 'block')
    })
    // enable input
    set_input_enable()
    $('.btn-add').css('display', 'none')
})



// Set click event for upload input
var inputImageProfile = document.getElementById("btn-upload")
if(inputImageProfile){
    uploadImage(inputImageProfile)
}
var inputImageModalCreateCV = document.getElementById("btn-upload_modal-cv")
if(inputImageModalCreateCV){
    uploadImage(inputImageModalCreateCV)
}
var inputImageEmployer = document.getElementById("btn-upload_employer")
if(inputImageEmployer){
    uploadImage(inputImageEmployer)
}
var inputImageIntroLogo = document.getElementById("btn-upload_intro-logo")
if(inputImageIntroLogo){
    uploadImage(inputImageIntroLogo)
}
var inputImageIntroAddress = document.getElementById("btn-upload-img-intro_address")
if(inputImageIntroAddress){
    uploadImage(inputImageIntroAddress)
}



// Click to close edit panel
$('.btn-cancel').click(function(){
    var edit_selector = $('.edit')
    $(edit_selector).css('display', 'none')
    // disable input
    set_input_disable()
    $('.fields-company select').css('display', 'none')
    // unsave

    $('.btn-add').css('display', 'block')
})

// Click to save
$('.btn-save').click(function(){
    // set_input_disable()
    var edit_selector = $('.edit')
    $(edit_selector).css('display', 'none')
    $('.btn-add').css('display', 'block')
    // save image
    // Using PHP: Save img into DB => show

    var modal_cv = $(this).closest('.modal-cv')
    $(modal_cv).css('display', 'none')
    var displayElement = $('#modal>div')
    var countNoneElement = 0
    $(displayElement).each(function(){
        if($(this).css('display') == 'none'){
            countNoneElement+=1
        }
    })
    if(countNoneElement == displayElement.length){
        $('#modal').css('display', 'none')
    }

    $('.fields-company select').css('display', 'none')
})



// CLick to show modals
// Add Cv to DB
// view add cv modal
$('.list-cv .btns .btn-add').click(function(){
    $('#modal').css("display", "block")
    $('.modal-add_cv').css('display', 'flex')
})
// Close modal create cv

// View cv modal
$('.view-cv .btn-detail').click(function(){
    var viewCV = $(this).closest('.tag-candidate').find('.img-cv')
    $('#modal').find('.img-cv').attr('src', viewCV.attr('src'))
    $('#modal').css('display', 'block')
    $('.modal-view-cv').css('display', 'flex')
})

$('.view-cv .btn-detail').click(function(){
    var viewCV = $(this).closest('.cv').find('img')
    $('#modal').find('img').attr('src', viewCV.attr('src'))
    $('#modal').css('display', 'block')
    $('.modal-view-cv').css('display', 'flex')
})

// View post modal
$(findElementByTextPost($('.post-info-employer .btn.btn-detail'), "Xem bài đăng")).each(function(){
    $(this).click(function(){
        var modal_modal_post_closest = $(this).closest('.post-info-employer').find('.modal_modal_post')
        $(modal_modal_post_closest).css('display', 'block')
        var modal_post_closest = $(modal_modal_post_closest).find('.modal-post')
        $(modal_post_closest).css('display', 'flex')
    })
})

// View post modal
$(findElementByTextPost($('.detail-profile-employer .btn.btn-detail'), "Xem bài đăng")).each(function(){
    $(this).click(function(){
        var modal_modal_post_closest = $(this).closest('.detail-profile-employer').find('.modal_modal_post')
        console.log($(modal_modal_post_closest))
        $(modal_modal_post_closest).css('display', 'block')
        var modal_post_closest = $(modal_modal_post_closest).find('.modal-post')
        $(modal_post_closest).css('display', 'flex')
    })
})

// Close view modal
$('.btn-cancel').click(function(){
    var modal_cv = $(this).closest('.modal-cv')
    $(modal_cv).css('display', 'none')
    var displayElement = $('#modal>div')
    var countNoneElement = 0
    $(displayElement).each(function(){
        if($(this).css('display') == 'none'){
            countNoneElement+=1
        }
    })
    if(countNoneElement == displayElement.length){
        $('#modal').css('display', 'none')
    }
})

$('.btn-cancel').click(function(){
    var modal_modal_post = $('.modal_modal_post');
    $(modal_modal_post).css('display', 'none');
})

// Close modal-view-cv
$(findElementByTextPost($('.btn.btn-add'), "Ứng tuyển")).each(function(){
    $(this).click(function(){
        var modal_modal_post_closest = $(this).closest('.modal_modal_post')
        $(modal_modal_post_closest).css('display', 'block')
        var modal_post_closest = $(this).closest('.modal-post')
        $(modal_post_closest).css('display', 'flex')
    })
})

// Example post modal
$('.title-post .icon-add').each(function(){
    $(this).click(function(){
        $('.modal_modal_post').css('display', 'block')
        $('.modal-example-post').css('display', 'flex')
    })
})

$('.title-post .icon-add').each(function(){
    $(this).click(function(){
        $('.modal_modal_post').css('display', 'block')
        $('.modal-example-post').css('display', 'flex')
    })
})

var recruit = $('.recruit-jobs').html()
$('.container-recruit_job .icon-add').each(function(){
    $(this).click(function(){
        $('.recruit-jobs').append(recruit)
    })
})

// Click plus button to add info
$('.fields-company .icon-add').each(function(){
    $(this).click(function(){
        $('.fields-company select').css('display', 'block')
        $('.modal-example-post').css('display', 'flex')
        var edit_selector = $('.edit')
        $(edit_selector).each(function(){
            $(this).css('display', 'block')
        })
    })
})

// View recruiment modal
$(findElementByTextPost($('.btn-add'), 'Tuyển dụng')).each(function(){
    $(this).click(function(){
        var modal_modal_post = $(this).closest('tr').find('.modal_modal_post')
        $(modal_modal_post).css('display', 'block')
        var modal_recruiment = $(modal_modal_post).find('.modal-recruiment')
        $(modal_recruiment).css('display', 'flex')
    })
})

$(findElementByTextPost($('.btn-add'), 'Tuyển')).each(function(){
    $(this).click(function(){
        var modal_modal_post = $(this).closest('tr').find('.modal_modal_post')
        console.log($(modal_modal_post))
        $(modal_modal_post).css('display', 'none')
        var modal_recruiment = $(modal_modal_post).find('.modal-recruiment')
        $(modal_recruiment).css('display', 'none')
    })
})

// Prevent change profile
$('.status-cv').each(function(){
    if($(this).text().trim() == "Chưa duyệt" || $(this).text().trim() == "Chấp nhận"){
        var view_cv = $(this).parent()
        var icons = $(view_cv).find('.view-cv i')
        $(icons).each(function(){
            $(this).addClass('non-active')
        })
    }
})

// add intro image
// $('.some-img_company .some-img .icon-add').each(function(){
//     $(this).click(function(){

//     })
// })