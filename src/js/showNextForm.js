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
                checkResidentInfo()
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




function checkResidentInfo() {
    let firstName = $('input[name=firstName]').val()
    let middleName = $('input[name=middleName]').val()
    let lastName = $('input[name=lastName]').val()
    let suffix = $('input[name=suffix]').val()
    let birthDate = $('input[name=birthDate]').val()
    let gender = $('input[name=gender]:checked').val()

    let formData = { firstName: firstName, middleName: middleName, lastName: lastName, suffix: suffix, birthDate: birthDate, gender: gender }

    $.ajax({
        type: 'POST',
        url: '../src/includes/checkResidentInfo.php',
        data: formData,
        success: function (response) {
            let res = JSON.parse(response)
            result = res.result
            residentId = result

            if (result > 0) {
                showCurrentStep()
                $('#residentIdContainer').html('<input type="hidden" id="residentId" name="residentId" value="' + result + '">')
                $('#message').html("")
            } else {
                currentStep--
                $('#message').html("<p>Resident not found. Please make sure that you input correct informations.</p>")
            }
        }
    })
}



// function submitApplication() {
//     let firstName = $('input[name=firstName]').val()
//     let middleName = $('input[name=middleName]').val()
//     let lastName = $('input[name=lastName]').val()
//     let suffix = $('input[name=suffix]').val()
//     let birthDate = $('input[name=birthDate]').val()
//     let gender = $('input[name=gender]:checked').val()

//     let formData = { firstName: firstName, middleName: middleName, lastName: lastName, suffix: suffix, birthDate: birthDate, gender: gender }

//     $.ajax({
//         type: 'POST',
//         url: '../src/includes/checkResidentInfo.php',
//         data: formData,
//         success: function (response) {
//             let res = JSON.parse(response)
//             result = res.result

//             if (result > 0) {
//                 showCurrentStep()
//                 document.getElementById(residentId).setAttribute('value', result)
//                 console.log($('#residentId').val(result))
//             } else {
//                 $('#message').html("<p>Resident not found. Please make sure that you input correct informations.</p>")
//             }
//         }
//     })
// }

