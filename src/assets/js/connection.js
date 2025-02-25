////////////////////////////////////////////////////////////
/////////////////////// FORM DISPLAY ///////////////////////
////////////////////////////////////////////////////////////

let currentStep = 1;
let errorMessage = "";
validateDisplayedStep();

// function to display form content step by step
function showStep(step) {

    console.log(`current step: ${step}`);

    // remove "active" class from the current active step of the form
    const steps = document.querySelectorAll(".step");
    steps.forEach((el) => el.classList.remove("active"));

    // add "active" class to the selected step (called in the function)
    const newStep = document.getElementById(`step${step}`);
    newStep.classList.add("active");

    // display the corresponding step-indicator
    const indicator = document.querySelectorAll(".step-indicator span");
    indicator.forEach((el, index) => {
        el.classList.toggle("active", index + 1 === step);
    });

    // modify the prevBtn and nextBtn according to the step
    const prevBtn = document.getElementById("prevButton");
    const nextBtn = document.getElementById("nextButton");

    prevBtn.disabled = step === 1; // disable the prevBtn during 1st step
    nextBtn.innerText = step === 3 ? "Valider" : "Suivant"; // modify the nextBtn during last (3rd) step

    // check fields validity within the current display step
    validateDisplayedStep();
}

// function to collect form data
function collectFormData() {
    let fields = document.querySelectorAll(".step input, .step select");
    let formData = {};
    fields.forEach((field) => {
        formData[field.name] = field.value;
    });

    let userDataJson = JSON.stringify(formData);
    sessionStorage.setItem('user', userDataJson);
    console.log(userDataJson);
}

// function to call the next step
function nextStep() {
    if (currentStep < 3) {
        currentStep++;
        showStep(currentStep);
    // } else {
    //     collectFormData();
    //     const result = document.getElementById("result");
    //     result.innerText = "Informations soumises avec succès! Redirection vers la page compte utilisateur...";
    //     function toAccount() {
    //         window.location.href = "/user-account";
    //     }
    //     setTimeout(toAccount, 3000);
    // }
    } else if (currentStep === 3) {
        document.getElementById("nextButton").setAttribute('type', 'submit');
    }
}

//function to call the previous step
function prevStep() {
    if (currentStep === 3) {
        const result = document.getElementById("result");
        result.innerText = "";
    }
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

// call the nextStep or prevStep
document.getElementById("nextButton").addEventListener("click", nextStep);
document.getElementById("prevButton").addEventListener("click", prevStep);


////////////////////////////////////////////////////////////
///////////////////// FORM VALIDATION //////////////////////
////////////////////////////////////////////////////////////

// 2 base functions returning boolean (true if empty/required, respectively, false otherwise)

function isEmpty(input) {
    return input.value === "";
}

function isRequired(input) {
    return input.hasAttribute("required");
}

// a function to validate the input against regular expressions, calling validateInput()
// returns boolean (true if the input respects the specified regular expression)

function isValidInput(input) {
    switch (input.type) {
        case "email":
            return validateInput(input, emailPattern);
        case "password":
            if (input.id === "pwdConfirm") {
                return input.value === document.getElementById("password").value;
            } else {
                return validateInput(input, passwordPattern);
            }
        case "tel":
            return validateInput(input, phonePattern);
        default:
            if (input.id === "zipcode") {
                return validateInput(input, zipcodePattern);
            } else {
                return validateInput(input, standardPattern);
            }
    }
}

function validateInput(input, pattern) {
    return pattern.test(input.value);
}

const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/;
const phonePattern = /^0([67]\d{8}|([1-5]|9)\d{8})$/;
const zipcodePattern = /^[0-9]{5}$/;
const standardPattern = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9-, ]+$/;

// a function assessing the validity of the field based on isEmpty(), isRequired() and isValidInput()
// returns boolean, and specifies an errorMessage if the field is not valid


// let errorMessage = "";
function isValidField(input) {
    // const isEmpty = isEmpty(input);
    // const isRequired = isRequired(input);
    // const isValidInput = isValidInput(input);

    if (isEmpty(input) && isRequired(input)) {
        errorMessage = "Ce champs est requis.";
        return false;
    } else if (!isEmpty(input) && !isValidInput(input)) {
        errorMessage = "Format invalide.";
        return false;
    } else if ((isEmpty(input) && !isRequired(input)) | (!isEmpty(input) && isValidInput(input))) {
        errorMessage = "";
        return true;
    }
}

// a function checking if isValidField() is false for at least one field then disables the nextButton

function checkFormValidity(array) {
    const allFieldsValid = array.every((value) => value === true);
    if (allFieldsValid) {
        document.getElementById("nextButton").disabled = false;
    } else {
        document.getElementById("nextButton").disabled = true;
    }
}

// evaluate the validity of each field in the currently displayed form step

function validateDisplayedStep() {
    let fields = document.querySelectorAll(`#step${currentStep} input, #step${currentStep} select`);
    console.log(fields);
    let fieldValidity = Array.from(fields).map(isValidField);
    console.log(fieldValidity);
    checkFormValidity(fieldValidity);

    fields.forEach((field) => {
        field.addEventListener("keyup", () => {
            errorElement = field.nextElementSibling;
            if (isValidField(field)) {
                field.classList.remove("invalid");
                field.classList.add("valid");
                if (errorElement) {
                    document.querySelector(`#error-${field.name}>span`).innerText = "";
                    document.querySelector(`#error-${field.name}>i`).classList.replace("fa-exclamation-triangle", "fa-check");
                }
            } else {
                field.classList.remove("valid");
                field.classList.add("invalid");
                if (!errorElement) {
                    field.parentElement.insertAdjacentHTML(
                        "beforeend",
                        `<p class="error" id="error-${field.name}" ><i class="fa fa-exclamation-triangle"></i> <span>${errorMessage}</span></p>`);
                } else {
                    document.querySelector(`#error-${field.name}>span`).innerText = errorMessage;
                }
            }
            fieldValidity = Array.from(fields).map(isValidField);
            checkFormValidity(fieldValidity);
            // console.log(fieldValidity);
        });
    });
}

// function do display the password

const passwordInput = document.getElementById("password");
const pwdConfirmInput = document.getElementById("pwdConfirm");

function showPassword(input) {
    if (input.type === "password") {
        input.type = "text";
    } else if (input.type === "text") {
        input.type = "password";
    }
}

const viewPassword = document.getElementById("pwd-eye");
const viewConfirmPassword = document.getElementById("pwdConfirm-eye");

viewPassword.addEventListener("click", () => {
    showPassword(passwordInput);
});

viewConfirmPassword.addEventListener("click", () => {
    showPassword(pwdConfirmInput);
});

// function to display password security rules

const pwdRules = document.querySelector('.pwdRules');

function showRules() {
    pwdRules.classList.remove("hidden");
    pwdRules.classList.add("showed");
    pwdRules.textContent = pwdRules.title;
}

function hideRules() {
    pwdRules.classList.remove("showed");
    pwdRules.classList.add("hidden");
    pwdRules.textContent = "Règles de sécurité";
}

pwdRules.addEventListener("click", () => {
    if (pwdRules.classList.contains('showed')) {
        hideRules();
    } else if (pwdRules.classList.contains('hidden')) {
        showRules();
    }
});






// simulate retrieved userData from server and user login
const loginEmail = document.getElementById("emailConnect");
const loginPassword = document.getElementById("passwordConnect");
const loginButton = document.getElementById("loginBtn");

userData = JSON.parse(sessionStorage.user1);

loginButton.addEventListener("click", () => {
    if (loginEmail.value === userData.email && loginPassword.value === userData.password) {
        window.location.pathname = "/user-account";
    } else {
        alert("Email ou mot de passe incorrect");
    }
});


// const simulateLogin = () => {
//     const user = {
//         email: "xYHdM@example.com",
//         password: "password",
//     };
//     localStorage.setItem("user", JSON.stringify(user));
//     window.location.href = "user-account.html";
// }

// const loginButton = document.getElementById("loginButton");

// loginButton.addEventListener("click", () => {
//     simulateLogin();
// });
