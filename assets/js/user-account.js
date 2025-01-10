// get user data from session storage
const userData = JSON.parse(sessionStorage.user);
console.log(userData);
console.log(userData.city);

// greets the user when accessing the user-account page
greetings = document.querySelector('.user-account>h2>span');
greetings.textContent = `Bienvenue ${userData.firstName} !`;

// add user data within corresponding span elements 
const keys = Object.keys(userData);
console.log(keys);
keys.forEach((key) => {
    const element = document.querySelector(`#${key} span`);
    if (element) {
        if (key === 'password') {
            element.textContent = '••••••••••';
        } else {
            element.textContent = userData[key];
        }
    } else {
        console.log(`No element found with id "${key}"`);
    }
});

// display the correponding content when clicking on a given card
// const detailsCard = document.getElementById('card-details');

// detailsCard.addEventListener('click', () => {
//     const content = document.querySelectorAll('.content');
//     content.forEach((element) => {
//         element.classList.remove('active');
//     });

//     const userDetails = document.getElementById('user-details');
//     userDetails.classList.add('active');

//     const close = document.querySelector('#user-details>i');
//     close.addEventListener('click', (event) => {
//         userDetails.classList.remove('active');
//     });
// });

const cards = document.querySelectorAll('.card');
console.log(cards);

cards.forEach((card) => {
    card.addEventListener('click', () => {
        const content = document.querySelectorAll('.content');
        content.forEach((element) => {
            element.classList.remove('active');
        });

        const cardContent = document.querySelector(`.${card.id}`);
        cardContent.classList.add('active');

        const close = document.querySelector(`.${card.id}>i`);
        close.addEventListener('click', (event) => {
            cardContent.classList.remove('active');
        });
    });
});

// function showContent(content) {
//     const content = document.querySelectorAll('.content');
//     content.forEach((element) => {
//         element.classList.remove('active');
//     });



// const buttons = document.querySelectorAll('.content>button');
// buttons.forEach((button) => {
//     button.addEventListener('click', () => {
//         const content = document.querySelectorAll('.content');)