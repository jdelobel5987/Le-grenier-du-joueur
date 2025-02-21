// validate searchbar input by clicking on the search icon or pressing enter
const search = document.querySelector(".searchBar>input");
const searchBtn = document.querySelector(".searchBar>button");
let input = "";

document.addEventListener("keydown", (e) => {
  if (e.key == "Enter") {
    input = search.value;
    console.log(input);
  }
});

searchBtn.addEventListener("click", () => {
  input = search.value;
  console.log(input);
});

// get user data from session storage
let userData;
if (sessionStorage.user) {
  userData = JSON.parse(sessionStorage.user);
  console.log(userData);
} else {
  // userData = null;
  console.log('No user data found in session storage');
}

// modify log button properties based on existence of user data in session storage
const logBtn = document.querySelector('.connection>button');
const logBtnText = document.querySelector('.connection span');
const iconBarUser = document.getElementById('iconAccount');

if (userData) {
  logBtnText.textContent = 'Mon compte';
  logBtn.addEventListener('click', () => {
    window.location.href = './user-account.html';
  })
  iconBarUser.href = "user-account.html";
} else {
  logBtnText.textContent = 'Connexion';
  logBtn.addEventListener('click', () => {
    window.location.href = './connection.html';
  })
  iconBarUser.href = "connection.html"
}

// modify iconbar display of the icon for current page
const icons = document.querySelectorAll('.icon-bar .fa-solid');
console.log(icons);
const pageLinks = document.querySelectorAll('.icon-bar a');
console.log(pageLinks);

// icons.forEach((icon) => {
//   icon.addEventListener('click', () => {
//     // icon.classList.replace('fa-2x', 'fa-3x');
//     icon.style.color = 'black';
//     icon.parentElement.style.border = '2px solid black';
//     icon.parentElement.style.borderRadius = '30%';
//   })
// });

pageLinks.forEach((link) => {
  if (document.location.pathname === link.pathname) {
    let icon = link.querySelector('i');
    // icon.setAttribute('data-fa-transform', 'grow-3 up-6');
    icon.style.color = 'black';
    icon.style.height = '70px';
    // // icon.style.width = '70px';
    icon.style.backgroundColor = 'var(--myColYellow)';
    // // icon.style.border = '1px solid var(--myColBrown)';
    icon.style.borderRadius = '50%';
    icon.classList.replace('fa-2x', 'fa-3x');
    // // icon.style.position = 'absolute';
    // // icon.style.top = 0;
    // // // icon.style.left = calc(((indexOf(icon) + 1) * 20) - 10) + '%';
    // // icon.style.transform = 'translate(-40%, 0%)';
  }
});


// simulate a previously registered user
let user = {};
user.email = "user1@example.com";
user.password = "Password123!";
user.firstName = "John";
user.lastName = "Doe";
user.city = "Paris";
user.zipcode = "75000";
user.phone = "0123456789";
user.address = "1 rue de la Paix";
user.addressComplement = "3ème étage";
user.communication = "email";
user.newsletter = "yes";
console.log(user);

sessionStorage.setItem('user1', JSON.stringify(user));
console.log(sessionStorage.user1);


// display or download documents in footer according to user device
// let thresholdMobile = 500; // 320; 375; 425; 768; 1024; 1440;
// let thresholdDesktop = 1000; // 320; 375; 425; 768; 1024; 1440;
let screenWidth = window.innerWidth;

let documents = document.querySelectorAll('.container-footer>a');

if (screenWidth > 1000) {
  documents.forEach((doc) => {
    doc.setAttribute('target', '_blank');
    console.log(doc.getAttribute('target'));
  })
};
