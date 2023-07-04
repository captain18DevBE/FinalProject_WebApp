//------------------------------Function-----------------------------
// const fs = require('fs')
// const path = require('path')

const imageFolder = './assets/images/Slides/'

var index_circle = 0
var index_image = 0
var list_slide = createSlidesList()
var pages = document.querySelectorAll('.page')
var arrows = document.querySelectorAll('.icon-arrow')
createIconCircle()
var circles = document.querySelectorAll('.circle')
var listContainer = Array.from($('.list-company .container.non-active'))
var listTitle = document.querySelectorAll('.title-other li')


// Create slide list
function createSlidesList(){
    var slidesList = []
    for(var i = 0; i <= 3; i++){
        slidesList.push(`${'Slide'+i+'.jpg'}`)
    }
    return slidesList
}

// Create switch-icon-circle 
function createIconCircle(){
    var icon_circle = $('.icons-circle')
    for(var i = 0; i < createSlidesList().length; i++){
        var circle = ''
        if(i == 0){
            circle = '<div class="circle active"></div>'
        }
        else{
            circle = '<div class="circle"></div>'
        }
        icon_circle.append(circle)
    }
}

// const logoFolder = '../assets/images/Logo_Company'

// function countNumberOfFile(nameFolder){

// Set Active for element
function setActive(circle){
    if(circle){
        circle.classList.add('active')
    }
}

// Set non-active for element
function setNonActive(circles){
    if(circles){
        circles.forEach(function(circle){
            try{
                circle.classList.remove('active')
            }
            catch{
                
            }
        })
    }
}

// Set Source for image
function setSourceImage(slide){
    var currSlide = $('.show img')
    currSlide.attr('src', `${imageFolder + slide}`)
}


// function switch slide
function switch_slide(){
    // get current slide
    if(index_image >= list_slide.length){
        index_image = 0
    }
    // Non-active circle
    setNonActive(circles)
    if(index_circle >= list_slide.length - 1){
        index_circle = -1
    }

    // Active circle
    setActive(circles[index_circle+1])
    if($('.show img').attr('src') === `${imageFolder + list_slide[index_image]}`){
        index_image++
    }
    // Set Source Image
    setSourceImage(list_slide[index_image])
    index_image++
    index_circle++
}

// Reverse switch slide
function reverse_switch_slide(){
    // get current slide
    if(index_image <= 0){
        index_image = list_slide.length - 1
    }
    // Non-active circle
    setNonActive(circles)
    if(index_circle <= 0){
        index_circle = list_slide.length
    }

    // Active circle
    setActive(circles[index_circle-1])
    if($('.show img').attr('src') === `${imageFolder + list_slide[index_image]}`){
        index_image--
    }
    // Set Source Image
    setSourceImage(list_slide[index_image])
    index_image--
    index_circle--
}

// Create 'click dropdown item' function
function click_dropdown_item(){
    var name_feature = (this.parentElement.parentElement)
    var nameNode = name_feature.querySelector('a')
    nameNode.innerHTML = (this.innerHTML)
}

// Create effect when load image
function loadImage(){
    var slide = document.querySelector("#slide-curr")
    slide.addEventListener('load', function(){
        $('#slide-curr').css('animation', 'moveRightToLeft 0.5s ease')
    })
}


// Change title list when click 
function changeList(curr, clicked){
    var textCurr = curr.innerHTML
    curr.innerHTML = clicked.innerHTML
    clicked.innerHTML= textCurr
}

// Change container content
function changeContainer(objCurr, clicked){
    var obj = objCurr
    objCurr = listContainer[clicked]
    listContainer[clicked] = obj
}

// split array when length more than 20
function splitArrayCompany(list_company_show){
    var list_containers = []
    var array_company_show = Array.from(list_company_show)

    var list_company_left = array_company_show.splice(20)
    list_containers.push(array_company_show)
    if(list_company_show.length > 20){
        while(list_company_left.length > 20){
            array_company_show = list_company_left.splice(20)
            list_containers.push(list_company_left)
            list_company_left = array_company_show
        }   
    } 
    if(list_company_left.length > 0){
        list_containers.push(list_company_left)
    }
    return list_containers
}

// Set dipslay for block
function setDisplay(list, index){
    list[index].forEach(function(container){
        container.classList.remove('non-active')
    })
}

// Set Non-dipslay for block
function setNonDisplay(list, index){
    list[index].forEach(function(container){
        container.classList.add('non-active')
    })
}

// Create new page-item
function createPageItem(companies, currContainer, currContent){
    var pagination = $(currContent).find('.pagination')
    $(pagination).html("")
    var numberPage = 1
    var list_pagination = []
    list_pagination.push('<li class="page-item"><a class="page-link" href="#">Previous</a></li>')
    for(var i = 0; i < companies.length; i++){
        var value = `<li class="page-item"><a class="page-link" href="#">${numberPage}</a></li>`
        numberPage++
        list_pagination.push(value)
    }
    list_pagination.push('<li class="page-item"><a class="page-link" href="#">Next</a></li>')

    list_pagination.forEach(function(pagi){
        $(pagination).append(pagi)
    })

    var items = pagination.find('.page-item')
    $(items[1]).addClass('action')
    clickPageItem(currContainer, pagination)
}

// Action Container
function actionContainer(index, currContainer){ 
    var currContent = $(currContainer).closest('.companies').parent()
    var list_company_show = $(currContainer)
    if(($('.list-company').has($(currContainer))).length > 0){
        if(list_company_show.length < 5){
            $('.list-company').css('height', '500px')
        }
        else if(list_company_show.length < 9){
            $('.list-company').css('height', '680px')
        }
        else{
            $('.list-company').css('height', '1030px')
        }
        createPageItem(splitArrayCompany(list_company_show), currContainer, currContent)
    }
    else if(($('.list-company_search').has($(currContainer))).length > 0){
        if(list_company_show.length < 5){
            $('.list-company_search').css('height', '500px')
        }
        else if(list_company_show.length < 9){
            $('.list-company_search').css('height', '680px')
        }
        else{
            $('.list-company_search').css('height', '1030px')
        }
        createPageItem(splitArrayCompany(list_company_show), currContainer, currContent)
    }
    
    setDisplay(splitArrayCompany(list_company_show), index)
}


// Show current container
function showCurrContainer(list, currContainer){
    var currContent = $(currContainer).closest('.companies').parent()
    setDisplay(splitArrayCompany(list), 0)
    createPageItem(splitArrayCompany(list), currContainer, currContent)
}

// create function to find by text
function findElementByText(elements, text){
    var value = ''
    elements.each(function(){
        if($(this).text().trim() == text){
            value = $(this)
        }
    })
    return value
}

// switch container
function switchContainer(obj, indexNext, indexPre, container){
    var list_company_show = $(container)
    setDisplay(splitArrayCompany(list_company_show), indexNext)
    setNonDisplay(splitArrayCompany(list_company_show), indexPre)
    changeContainer(obj, indexNext)
}

// function add click function 
function clickPageItem(containers, pagination){
    var page_link = $(pagination).find('.page-link')
    $(page_link).each(function(){
        $(this).click(function(e){
            e.preventDefault()
            var value_item = $(this).text()
            var action_item = $(pagination).find('.action')
            var currIndex = $(action_item).text()
            var currContainer = $(pagination).find('.action')
            var index = 1
            var check = true
            switch(value_item){
                case 'Previous':
                    if(currIndex != 1){
                        if(findElementByText($(page_link), currIndex - 1).length != 0){
                            $(action_item).removeClass('action')
                            findElementByText($(page_link), currIndex - 1).addClass('action')
                            index = currIndex - 1
                            check = true
                        }
                        else{
                            index = currIndex
                            check = false
                        }
                    }
                    break
                case 'Next':
                    if(currIndex < page_link.length - 2){
                        if(findElementByText($(page_link), parseInt(currIndex) + 1.0).length != 0){
                            $(action_item).removeClass('action')
                            findElementByText($(page_link), parseInt(currIndex) + 1.0).addClass('action')
                            check = true
                            index = parseInt(currIndex) + 1.0
                        }
                        else{
                            index = parseInt(currIndex)
                            check = false
                        }
                    }
                    else{
                        index = page_link.length - 2
                    }
                    break
                default:
                    $(action_item).removeClass('action')
                    $(this).addClass('action')
                    index = $(this).text()
                    break
            }
            if(index != currIndex && check){
                switchContainer(currContainer, index - 1, currIndex - 1, containers)
            }
        })
    })
}


// Create function to switch page
function switchTitle(title, listTitle, listContainer, containers){
    var curr = document.querySelector('.list-company .title-curr')
    var arrayTitle = Array.from(listTitle)
    var index = arrayTitle.indexOf(title)  
    var containerCurr = document.querySelector('.list-company .container.show')

    // non display for current container
    containerCurr.classList.remove('show')
    containerCurr.classList.add('non-active')
    

    // display for clicked container
    listContainer[index].classList.remove('non-active')
    listContainer[index].classList.add('show')

    var list_company_show = $(containers).find('.container.show .container-company')
    changeContainer(containerCurr, index)
    changeList(curr, title)
    actionContainer(0, list_company_show)
}

// display: search navigation
function displaySearchNavi(){
    if($('.list-feature_search').css('display') == 'none'){
        $('.list-feature_search').css({'display':'block', 'opacity':'1'})
    }
    else{
        $('.list-feature_search').css({'display':'none', 'opacity':'0'})
    }
}

// ---------------------------------Use function & Event--------------------
// Show search navigation
$('.btn-search').click(function(){
    displaySearchNavi()
})

$('.btn-search_glass').click(function(){
    displaySearchNavi()
})


// Select feature in navigation
$('.nav-ftr').click(function(){
    try{
        $('.nav-ftr').each(function(){
            $(this).removeClass('item-selected')
        })
    }
    catch{}
    $(this).addClass('item-selected')
})

// Build for responsive
$('.navbar-toggler').click(function(){
    if($('.collapse').css('display') != 'flex'){
        $('.collapse').css('display', 'flex')
        var list_search = $('.btn-search')
        list_search.click(function(){
            $('.nav-ftr_search').css('width', '100%')
            $('.nav-ftr_search div').css('display', 'none')
            $('.nav-ftr_search').each(function(){
                $(this).click(function(){
                    if($(this).find('div').css('display') == 'none'){
                        $(this).find('div').css('display', 'block')
                    }
                    else{
                        $(this).find('div').css('display', 'none')
                    }
                })
            })
        })
    }
    else{
        $('.list-feature .collapse').css('display', 'none')
    }
})

// Click to read news   
$('.not-read').click(function(){
    $(this).removeClass('not-read')
    var currNumber = $('.number-notifi').html()
    var nextNumber = currNumber - 1
    if(nextNumber <= 0){
        $('.number-notifi').css('display', 'none')
    }
    else{
        $('.number-notifi').html(nextNumber)
    }
})

var slide = document.querySelector("#slide-curr")
if(slide){
    slide.addEventListener('load', function(){
        $('#slide-curr').css('animation', 'moveRightToLeft 2s ease')
    })
}

// select selected dropdown-item
var items = document.querySelectorAll('.dropdown-item') 
items.forEach(function(item){
    item.addEventListener('click', click_dropdown_item)
})

// ------------------------------Switch slide---------------------------------

// Set timeout for Slider: 5s will switch to other page
// switch_slide()

// Click circle icon and arrow icon

circles.forEach(function(circle){
    circle.addEventListener('click', function(){

        index_circle = Array.from(circles).indexOf(circle)
        index_image = Array.from(circles).indexOf(circle)

        setNonActive(circles)
        setActive(circles[index_circle])
        setSourceImage(list_slide[index_image])
    })
})

// ----------------------------------------reverse switch----------------- 
if(pages[0]){
    pages[0].addEventListener('click', function(){
        reverse_switch_slide()
    })
}
if(pages[1]){  
    pages[1].addEventListener('click', function(){
        switch_slide()
    })
}

// Automactically switch slide after 5s
if(circles){
    setInterval(function(){
        switch_slide()
    }, 5000)
}


// ---------------------------------------------Load title-----------------------
var class_company_show = $('#content div.running')
var container_content = $("#content>div")
var list_company_show = $('#content .container.show .container-company')

listTitle.forEach(function(title){
    title.addEventListener('click', function(){
        switchTitle(title, listTitle, listContainer, class_company_show)
    })
})

// Automatically add container if number of company is more than 20 => 5 rows
// Get number of companies which contained in container show



// Click into pagination to swtich content
$(container_content).each(function(){
    var list_company_content = $(this).find(".container.show .container-company")
    showCurrContainer($(list_company_content),$(list_company_content))
})

// -------------------------------------Click pagination---------------------------------
// var pages = document.querySelectorAll('.page-link')

// add click function for detail feature
$('.feature-detail li').click(function(){
    var context = $(this).text().trim()
    if(context != $('.title-curr').text().trim()){
        listTitle.forEach(function(title){
            var context_title = title.innerHTML
            if(context == context_title.trim()){
                switchTitle(title, listTitle, listContainer, class_company_show)
            }
        })
    }
})

// ------------------------------------Search Button-------------------------------------

$('.btn-search_glass').click(function(){
    var link = ""
    var list_text_items = ['Tỉnh thành', 'Nghề nghiệp','Mức lương', 'Chất lượng']
    var items_search = $('.nav-ftr_search .dropdown-toggle')
    var address = ""
    var job = ""
    var salary = ""
    var quality = ""
    if(items_search[0].text.trim() != "Tỉnh thành"){
        address = items_search[0].text.trim()
    }
    if(items_search[1].text.trim() != "Nghề nghiệp"){
        job = items_search[1].text.trim()
    }
    if(items_search[2].text.trim() != "Mức lương"){
        salary = items_search[2].text.trim()
    }
    if(items_search[3].text.trim() != "Chất lượng"){
        quality = items_search[3].text.trim()
    }
    link = `?page=job&search&address=${address}&job=${job}&salary=${salary}&quality=${quality}`
    createHref(link)
    if($('.item-search i').length > 0){
        $('.list-company_search').removeClass('non-active')
        actionContainer(0, $('.list-company_search .container.show .container-company'))
    }
    else{
        $('.list-company_search').addClass('non-active')
    }
})

var items_search = $('.nav-ftr_search .dropdown-toggle')
var list_text_items = ['Tỉnh thành', 'Nghề nghiệp','Mức lương', 'Chất lượng']
var item_search = $('.item-search')
for(var i = 0; i < 4; i++){
    if(items_search[i].text.trim() != list_text_items[i]){
        $(item_search[i]).css('display', 'block')
        $(item_search[i]).text(items_search[i].text.trim())
        $(item_search[i]).append('<i class="fa-solid fa-xmark"></i>')
        var index = i
        $('.item-search i').click(function(){
            console.log("ok")
            $(this).parent().css('display', 'none')
            $(this).parent().empty()
            items_search[index].text = list_text_items[index]
            console.log(items_search[index].text )
        })
    }
    else{
        $(item_search[i]).css('display', 'none')
    }
}

// create href for btn_search_glass
function createHref(link){
    $('.btn-search_glass').attr('href', link)
}


// subLogo display when scroll web to top
var elementPosition = document.querySelector('#header').clientHeight;

// Check the scroll position of the window
window.addEventListener('scroll', function() {
    var scrollPosition = window.pageYOffset;
    // If the user has scrolled to the position of the element, display it
    if (scrollPosition >= elementPosition) {
        document.querySelector('.logo_sub').style.display = 'block';
    }
    else{
        document.querySelector('.logo_sub').style.display = 'none';
    }
}); 

$('#content>div').each(function(){
    if($($(this).find('.container.show .container-company')).length > 0){
        if($($(this).find('.container.show .container-company')).length < 5){
            $($(this)).css('height', '550px')
        }
        else if($($(this).find('.container.show .container-company')).length < 9){
            $($(this)).css('height', '850px')
        }
        else if($($(this).find('.container.show .container-company')).length > 9){
            $($(this)).css('height', '1030px')
        }
    }
    else if($($(this).find('.container.show .container-company')).length == 0 && $($(this).find('.post')).length == 0){
        $($(this)).css('height', '200px')
    }
})