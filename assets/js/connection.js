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

// function to call the next step
function nextStep() {
  if (currentStep < 3) {
    currentStep++;
    showStep(currentStep);
  } else {
    let inputData = document.querySelectorAll(".step>input");
    let selectData = document.querySelectorAll(".step>select");
    console.log(inputData);
    console.log(selectData);
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

//// data validation ////

/// 1- required fields are filled ///

//look for any required filed in the current displayed step
// and define a boolean checking that all required fields are filled
const required = document.querySelectorAll(
  `#step${currentStep} input[required]`
);
console.log(required);
const isFormValid = Array.from(required).every((input) => input.value !== "");

// disable the next-button if the form is invalid
const nextButton = document.getElementById("nextButton");
nextButton.disabled = !isFormValid;

// at each change event of a required field, re-check the form validity
// and update the next-button accordingly
required.forEach((el) => {
  el.addEventListener("change", () => {
    const isFormValid = Array.from(required).every(
      (input) => input.value !== ""
    );
    nextButton.disabled = !isFormValid;
  });
});

/// 2- specific field inputs are valid ///

// function to validate an input
function validateInput(input, pattern) {
  return pattern.test(input.value);
}

// password validation
passwordPattern =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
const pwd = document.getElementById("password");
const pwdConfirm = document.getElementById("pwdConfirm");

function checkPwd(input) {
  if (!validateInput(input, passwordPattern)) {
    document.querySelector(".pwd-error").innerText =
      "mot de passe non valide (1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial)";
    nextButton.disabled = true;
  } else {
    document.querySelector(".pwd-error").innerText = "";
    nextButton.disabled = false;
  }
}

pwd.addEventListener("change", (e) => checkPwd(e.target));

// pwdConfirm.addEventListener("change", () => {
//   if (pwdConfirm.value !== pwd.value) {

// email validation
emailPattern = /^[a-zA-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

// phone number validation
phoneFRPattern = /^0([67]\d{8}|([1-5]|9)\d{8})$/;
mobilePhoneFRPattern = /^0[67]\d{8}$/;
fixedPhoneFRPattern = /^0([1-5]|9)\d{8}$/;
