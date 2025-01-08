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

// // define an empty object that will receive field names as keys and a counter of "validity status" as values
// const formValidCounter = {};

// // select the fields displayed in the active step of the form
// const fields = document.querySelectorAll(
//     `#step${currentStep} input, #step${currentStep} select`
// );

// // validation patterns for specific fields of the form
// const emailPattern = /^[a-zA-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
// const passwordPattern =
//     /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
// const phonePattern = /^0([67]\d{8}|([1-5]|9)\d{8})$/;
// const zipcodePattern = /^[0-9]{5}$/;
// const standardCondition = /^[a-zA-Z0-9 ]+$/;

// // validate each displayed field at loading then redo at each input change event 
// fields.forEach((field) => {
//     checkFieldStatus(field);
//     if (formValidCounter[field.name] !== 3) {
//         document.getElementById("nextButton").disabled = true;
//     }
//     // // console.log(`counter: ${formValidCounter[field.name]}`);
//     field.addEventListener("change", () => {
//         validateField(field);
//     });
// });


/// VALIDATION FUNCTIONS ///
// function to validate a field: check the field status and update the HTML accordingly. Calls checkFieldStatus()
function validateField(field) {
    let isValid = true;
    let errorMessage = "";

    // Check if the field is required
    const isRequired = field.required;

    // Check if the field is empty
    const isEmpty = field.value === "";

    // Check the input validity based on the field name and value
    switch (field.name) {
        case "firstname":
        case "lastname":
            if (isEmpty) {
                errorMessage = "Champ requis";
            } else if (!/^[a-zA-Z ]+$/.test(field.value)) {
                errorMessage = "Ce champ ne doit contenir que des lettres et des espaces";
            }
            break;
        case "email":
            if (isEmpty) {
                errorMessage = "Champ requis";
            } else if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(field.value)) {
                errorMessage = "Ce champ doit être une adresse email valide";
            }
            break;
        case "password":
            if (isEmpty) {
                errorMessage = "Champ requis";
            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(field.value)) {
                errorMessage = "Ce champ doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial";
            }
            break;
        case "phone":
            if (isEmpty) {
                errorMessage = "Champ requis";
            } else if (!/^0([67]\d{8}|([1-5]|9)\d{8})$/.test(field.value)) {
                errorMessage = "Ce champ doit être un numéro de téléphone valide";
            }
            break;
        case "zipcode":
            if (isEmpty) {
                errorMessage = "Champ requis";
            } else if (!/^[0-9]{5}$/.test(field.value)) {
                errorMessage = "Ce champ doit être un code postal valide";
            }
            break;
        // Add more cases for other fields as needed
    }

    // Update the HTML based on the validation result
    if (isEmpty && !isRequired) {
        field.parentElement.classList.remove("invalid");
        field.parentElement.classList.remove("valid");
        const errorElement = document.querySelector(`#error-${field.name}`);
        if (errorElement) {
            errorElement.remove();
        }
    } else if (isEmpty && isRequired) {
        field.parentElement.classList.add("invalid");
        field.parentElement.classList.remove("valid");
        const errorElement = document.querySelector(`#error-${field.name}`);
        if (errorElement) {
            errorElement.innerText = errorMessage;
        } else {
            field.parentElement.insertAdjacentHTML(
                "beforeend",
                `<p id=error-${field.name}" style="color: red">${errorMessage}</p>`
            );
        }
    } else if (!isEmpty && isValid) {
        field.parentElement.classList.remove("invalid");
        field.parentElement.classList.add("valid");
        const errorElement = document.querySelector(`#error-${field.name}`);
        if (errorElement) {
            errorElement.remove();
        }
    } else {
        field.parentElement.classList.add("invalid");
        field.parentElement.classList.remove("valid");
        const errorElement = document.querySelector(`#error-${field.name}`);
        if (errorElement) {
            errorElement.innerText = errorMessage;
        } else {
            field.parentElement.insertAdjacentHTML(
                "beforeend",
                `<p id=error-${field.name}" style="color: red">${errorMessage}</p>`
            );
        }
    }

    // Check the overall form validity
    checkFormValidity();
}

// function to check the overall form validity
function checkFormValidity() {
    const invalidFields = document.querySelectorAll(".invalid");
    const nextButton = document.getElementById("nextButton");

    if (invalidFields.length === 0) {
        nextButton.disabled = false;
    } else {
        nextButton.disabled = true;
    }
}

// Add event listeners to each field
const fields = document.querySelectorAll("input");
fields.forEach((field) => {
    field.addEventListener("change", () => {
        validateField(field);
    });
});


// // check whether empty fields are required and whether not empty fields are valid. Gives a counter of 3 if valid (empty + not required or not empty + valid), 2 if missing (empty + required) or 4 if invalid (not empty + not valid).
// // calls isValid()
// function checkFieldStatus(field) {
//     formValidCounter[field.name] = 0;
//     console.log(formValidCounter[field.name]);
//     if (field.value === "") {
//         console.log(`Field ${field.name} is empty`);
//         formValidCounter[field.name]++;
//         if (field.hasAttribute("required")) {
//             formValidCounter[field.name]++;
//         } else {
//             formValidCounter[field.name] += 2;
//         }
//     } else {
//         console.log(`Field ${field.name} is not empty`);
//         formValidCounter[field.name] += 2;
//         if (isValid(field)) {
//             formValidCounter[field.name]++;
//         } else {
//             formValidCounter[field.name] += 2;
//         }
//     }
//     console.log(formValidCounter);
//     checkFormValidity();
// }

// // switch case algorithm to validate a field in the case it is an email, a password, a telephone, a zipcode or a default condition. Calls validateInput()
// function isValid(field) {
//     switch (field.type) {
//         case "email":
//             return validateInput(field, emailPattern);
//         case "password":
//             return validateInput(field, passwordPattern);
//         case "tel":
//             return validateInput(field, phonePattern);
//         default:
//             if (field.id === "pwdConfirm") {
//                 return field.value === document.getElementById("pwd").value;
//             }
//             if (field.id === "zipcode") {
//                 return validateInput(field, zipcodePattern);
//             } else {
//                 return standardCondition.test(field.value);
//             }
//     }
// }

// // validate an input based on the corresponding pattern
// function validateInput(input, pattern) {
//     return pattern.test(input.value);
// }
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
