////// FORM DISPLAY /////
let currentStep = 1;

// function to display form content step by step
function showStep(step) {
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
}

// function to collect form data
function collectFormData() {
    let fields = document.querySelectorAll(".step input, .step select");
    let formData = {};
    fields.forEach((field) => {
        formData[field.name] = field.value;
    });

    let userDataJson = JSON.stringify(formData);
    console.log(userDataJson);
}

// function to call the next step
function nextStep() {
    if (currentStep < 3) {
        currentStep++;
        showStep(currentStep);
    } else {
        collectFormData();
        const result = document.getElementById("result");
        result.innerText = "Informations soumises avec succès!";
    }
}

//function to call the previous step
function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

// call the nextStep or prevStep
document.getElementById("nextButton").addEventListener("click", nextStep);
document.getElementById("prevButton").addEventListener("click", prevStep);

//////////////////////
///// VALIDATION /////
//////////////////////

// define an empty object that will receive field names as keys and a counter of "validity status" as values
const formValidCounter = {};

// select the fields displayed in the active step of the form
const fields = document.querySelectorAll(
    `#step${currentStep} input, #step${currentStep} select`
);

// validation patterns for specific fields of the form
const emailPattern = /^[a-zA-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordPattern =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
const phonePattern = /^0([67]\d{8}|([1-5]|9)\d{8})$/;
const zipcodePattern = /^[0-9]{5}$/;
const standardCondition = /^[a-zA-Z0-9 ]+$/;

// validate each displayed field at loading then redo at each input change event 
fields.forEach((field) => {
    checkFieldStatus(field);
    if (formValidCounter[field.name] !== 3) {
        document.getElementById("nextButton").disabled = true;
    }
    // // console.log(`counter: ${formValidCounter[field.name]}`);
    field.addEventListener("change", () => {
        validateField(field);
    });
});


/// VALIDATION FUNCTIONS ///
// function to validate a field: check the field status and update the HTML accordingly. Calls checkFieldStatus()
function validateField(field) {
    checkFieldStatus(field);
    if (formValidCounter[field.name] !== 3) {
        field.parentElement.classList.add("invalid");
        field.parentElement.classList.remove("valid");
        field.parentElement.insertAdjacentHTML(
            "beforeend",
            `<p class="error" style="color: red">Ce champ est invalide</p>`
        );
    } else {
        field.parentElement.classList.remove("invalid");
        field.parentElement.classList.add("valid");
        document.querySelector(".error").innerText = "";
    }
    checkFormValidity();
}

// function to check the validity of the entire form
function checkFormValidity() {
    let allFieldsValid = true;
    for (let counter in formValidCounter) {
        if (formValidCounter[counter] !== 3) {
            allFieldsValid = false;
            break;
        }
    }
    document.getElementById("nextButton").disabled = !allFieldsValid;
}

// check whether empty fields are required and whether not empty fields are valid. Gives a counter of 3 if valid (empty + not required or not empty + valid), 2 if missing (empty + required) or 4 if invalid (not empty + not valid).
// calls isValid()
function checkFieldStatus(field) {
    formValidCounter[field.name] = 0;
    console.log(formValidCounter[field.name]);
    if (field.value === "") {
        console.log(`Field ${field.name} is empty`);
        formValidCounter[field.name]++;
        if (field.hasAttribute("required")) {
            formValidCounter[field.name]++;
        } else {
            formValidCounter[field.name] += 2;
        }
    } else {
        console.log(`Field ${field.name} is not empty`);
        formValidCounter[field.name] += 2;
        if (isValid(field)) {
            formValidCounter[field.name]++;
        } else {
            formValidCounter[field.name] += 2;
        }
    }
    console.log(formValidCounter);
    checkFormValidity();
}

// switch case algorithm to validate a field in the case it is an email, a password, a telephone, a zipcode or a default condition. Calls validateInput()
function isValid(field) {
    switch (field.type) {
        case "email":
            return validateInput(field, emailPattern);
        case "password":
            return validateInput(field, passwordPattern);
        case "tel":
            return validateInput(field, phonePattern);
        default:
            if (field.id === "pwdConfirm") {
                return field.value === document.getElementById("pwd").value;
            }
            if (field.id === "zipcode") {
                return validateInput(field, zipcodePattern);
            } else {
                return standardCondition.test(field.value);
            }
    }
}

// validate an input based on the corresponding pattern
function validateInput(input, pattern) {
    return pattern.test(input.value);
}
//////////////////////////////






// // attribute each filed name as a property of the formValidCounter object
// fields.forEach((field) => (formValidCounter[field.name] = 0));
// // console.log(formValidCounter);


// // validate an input based on the pattern
// function validateInput(input, pattern) {
//   if (checkPattern(input, pattern)) {
//     input.classList.remove("invalid");
//     input.classList.add("valid");
//     return true;
//   } else {
//     input.classList.remove("valid");
//     input.classList.add("invalid");
//     return false;
//   }
// }

// // checking the pattern
// function checkPattern(input, pattern) {
//   return pattern.test(input.value);
// }
