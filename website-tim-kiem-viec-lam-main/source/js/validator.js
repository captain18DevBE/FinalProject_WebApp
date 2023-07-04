
//Create obj Validator
function Validator(option) {
    selectorRules = {}
    selectorErrorMess = {}

    function validate(inputElement, rule) {
        var errorElement = inputElement.parentElement.querySelector(".form-message")
        var errorMessage = rule.test(inputElement.value)
        var tmpErr = 0;


        if(errorMessage) {
            errorElement.style.display = "inline"
            errorElement.innerText = errorMessage
            inputElement.parentElement.classList.add("invalid");
            tmpErr = -1;
         } else {
            errorElement.innerText = ""
            // errorElement.style.display = "none"
            inputElement.parentElement.classList.remove("invalid")
        }
        return tmpErr
    }

// Lấy element của form cần validate
    var formElement = document.querySelector(option.form)
    if(formElement) {
        // formElement.onsubmit = function (e) {
        //     console.log(formElement);
        //     var isFormValid = true
        //     e.preventDefault()
        //     option.rules.forEach(function (rule) {
        //         var inputElement = formElement.querySelector(rule.selector)
        //         var isValid = validate(inputElement, rule)
        //         if(isValid == -1)
        //             isFormValid = false
        //     })
        //     if(isFormValid) {
        //         formElement.submit();
        //     }
        // }

        // formElement.addEventListener('submit', function(event) {
        //     // Hủy sự kiện mặc định của form
        //     event.preventDefault();
        //     var isFormValid = true
        //     option.rules.forEach(function (rule) {
        //         var inputElement = formElement.querySelector(rule.selector)
        //         var isValid = validate(inputElement, rule)
        //         if(isValid == -1)
        //             isFormValid = false
        //     })
        //     if(isFormValid) {
        //         formElement.submit();
        //     }
        // });        

        option.rules.forEach(function (rule) {
            var inputElement = formElement.querySelector(rule.selector)
            var errorElement = inputElement.parentElement.querySelector(".form-message")

            if(Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test)
            } else {
                selectorRules[rule.selector] = rule.test
            }

            if(inputElement) {
                inputElement.onblur = function () {
                    validate(inputElement, rule)
                }
                
                inputElement.oninput = function () {
                    errorElement = ""
                    inputElement.parentElement.classList.remove("invalid")
                }
            }
        }) 
    }    

}

Validator.isRequired = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : "Vui lòng nhập thông tin!"
        }
    }
}

Validator.lengthRange = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return stringLength(value, 6, 21)
        }
    }
}

var stringLength = function(string, minLength, maxLength) {
    var strLength = string.length
    return (strLength <= minLength || strLength >= maxLength) ? `Vui lòng nhập từ ${minLength} đến ${maxLength} kí tự` : undefined
}

Validator.isEmail = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
            return regex.test(value) ? undefined : "Địa chỉ email không hợp lệ!";
        }
    }
}

Validator.checkPassWord = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{3,21}$/;
            return (value.match(paswd)) ? undefined : "Mật khẩu phải bao gồm chữ số, in hoa, thường, từ 3 đến 21 kí tự và chưa kí tự đặc biệt!" 
        }
    }
}

Validator.confirmPassWord = function (idConfirmPassWord, ipPassWord) {
    return {
        selector: idConfirmPassWord,
        test: function (value) {
            var conPw = document.getElementById(ipPassWord).value 
            return (value == conPw) ? undefined : "Mật khẩu xác nhận không khớp!"
        }
    }
}

Validator.isPhoneNumber = function (selector) {
    return {
        selector: selector,
        test: function(value) {
            var phoneno = /^\d{10}$/;
            return  (value.match(phoneno))? undefined : "Số điện thoại không hợp lệ!"
        }
    }
}

Validator.isGender = function (selector) {
    return {
        selector: selector,
        test: function(value) {
            return  (value == "null")? undefined : "Vui lòng chọn giới tính!"
        }
    }
}

Validator.checkBox = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return (value == "agree")? undefined : "Error"
        }
    }
}