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
