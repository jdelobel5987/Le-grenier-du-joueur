const search = document.querySelector(".searchBar>input");
const searchBtn = document.querySelector(".searchBar>button");

document.addEventListener("keydown", (e) => {
  if (e.key == "Enter") {
    let input = search.value;
    console.log(input);
  }
});

searchBtn.addEventListener("click", () => {
  let input = search.value;
  console.log(input);
});

// get user data from session storage
let userData;
if (sessionStorage.user) {
  userData = JSON.parse(sessionStorage.user);
  console.log(userData);
} else {
  userData = null;
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