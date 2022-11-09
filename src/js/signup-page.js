const togglePwd = document.querySelector('#toggle_pwd');
const pwdInput = document.querySelector('#password_input');
const toggleConPwd = document.querySelector('#toggle_con_pwd');
const conPwdInput = document.querySelector('#con_password_input');

togglePwd.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
    pwdInput.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('eye-slash');
});

toggleConPwd.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = conPwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
    conPwdInput.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('eye-slash');
});





const multiStepForm = document.querySelector("[data-multi-step]")
const formSteps = [...multiStepForm.querySelectorAll("[data-step]")]
let currentStep = formSteps.findIndex(step => {
    return step.classList.contains("active")
})



if (currentStep < 0) {
    currentStep = 0
    showCurrentStep()
}


multiStepForm.addEventListener("click", e => {
    let incrementor
    if (e.target.matches("[data-next]")) {
        incrementor = 1
        const inputs = [...formSteps[currentStep].querySelectorAll("input")]
        const allValid = inputs.every(input => input.reportValidity())
        if (allValid) {
            currentStep += incrementor

            if (currentStep == 1) {
                checkInfo()
            } else {
                showCurrentStep()
            }

        }
    } else if (e.target.matches("[data-previous]")) {
        incrementor = -1
        currentStep += incrementor
        showCurrentStep()
    }

    if (incrementor == null) return
})


function showCurrentStep() {
    formSteps.forEach((step, index) => {
        step.classList.toggle("active", index === currentStep)
    })
}




function checkInfo() {

    let mobileNumber = $('input[name=mobileNumber]').val()
    let password = $('input[name=password]').val()
    let confirmPassword = $('input[name=confirmPassword]').val()
    let agreeTerms = $("input[name='agreeTerms']:checked").val()
    //showCurrentStep()

    let formData = { mobileNumber: mobileNumber, password: password, confirmPassword: confirmPassword, agreeTerms: agreeTerms }
    $("#mobileNumber").text(mobileNumber)

    setTimeout(showResend, 8000);

    $.ajax({
        type: 'POST',
        url: '../src/includes/verify-user-input.php',
        data: formData,
        success: function (response) {
            let res = JSON.parse(response)
            result = res.result
            residentId = result

            if (result == "none") {
                showCurrentStep()
                // $('#residentIdContainer').html('<input type="hidden" id="residentId" name="residentId" value="' + result + '">')
                $('#message').html("")
            } else if (result == "mobileNumberTaken") {
                currentStep--
                $('#message').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>Mobile number is taken. Try another.</p></div>')
            } else if (result == "passwordDidNotMatch") {
                currentStep--
                $('#message').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>Passwords did not match. Try again.</p></div>')
            } else if (result == "agreeTerms") {
                currentStep--
                $('#message').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>You need to agree to our terms and condition before you can create an account.</p></div>')
            } else if (result == "emptyInput") {
                currentStep--
                $('#message').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>Please make sure that you provide all the needed information.</p></div>')
            } else if (result == "invalidMobileNumber") {
                currentStep--
                $('#message').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>Please enter valid mobile number. Example 09123456789.</p></div>')
            } else if (result == "invalidPassword") {
                currentStep--
                $('#message').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>Password should be at least 4 digits or more.</p></div>')
            } else if (result == "invalidConfirmPassword") {
                currentStep--
                $('#message').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>Confirm password should be at least 4 digits or more.</p></div>')
            }
        }
    })
}

function verifyOtp() {

    let otp = $('input[name=otp]').val()
    let mobileNumber = $('input[name=mobileNumber]').val()
    let password = $('input[name=password]').val()
    let confirmPassword = $('input[name=confirmPassword]').val()
    let agreeTerms = $("input[name='agreeTerms']:checked").val()
    //showCurrentStep()

    let formData = { otp: otp, mobileNumber: mobileNumber, password: password, confirmPassword: confirmPassword, agreeTerms: agreeTerms }

    $.ajax({
        type: 'POST',
        url: '../src/includes/verify-otp.php',
        data: formData,
        success: function (response) {
            let res = JSON.parse(response)
            let result = res.result
            //let result = "invalid"

            if (result == "invalid") {
                currentStep--
                $('#otpMessage').html('<div class="form-error"><svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg><p>Invalid.</p></div>')
            } else if (result == "none") {
                window.location.replace("login.php");
            }
        }
    })
}


function resendOtp() {

    let mobileNumber = $('input[name=mobileNumber]').val()
    //showCurrentStep()

    let formData = { mobileNumber: mobileNumber }

    $('#resend').css("display", "none")
    $('#loader').css("display", "block")

    setTimeout(showResend, 3000);

    $.ajax({
        type: 'POST',
        url: '../src/includes/resend-otp.php',
        data: formData,
        success: function () {

        }
    })
}

function showResend() {
    $('#resend').css("display", "block")
    $('#loader').css("display", "none")
}