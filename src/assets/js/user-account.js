// get user data from session storage
// const userData = JSON.parse(sessionStorage.user);
// console.log(userData);
// console.log(userData.city);

// greets the user when accessing the user-account page
// greetings = document.querySelector('.user-account>h2>span');
// if (sessionStorage.user) {
//     userData = JSON.parse(sessionStorage.user);
// } else if (sessionStorage.user1) {
//     userData = JSON.parse(sessionStorage.user1);
// }
// greetings.textContent = `Bienvenue ${userData.firstName} !`;

// add user data within corresponding span elements 
// const keys = Object.keys(userData);
// console.log(keys);
// keys.forEach((key) => {
//     const element = document.querySelector(`#${key} span`);
//     if (element) {
//         if (key === 'password') {
//             element.textContent = '••••••••••';
//         } else {
//             element.textContent = userData[key];
//         }
//     } else {
//         console.log(`No element found with id "${key}"`);
//     }
// });

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

//
// delete account modal
//

const deleteForm = document.getElementById('deleteAccountForm');
const deleteButton = document.getElementById('deleteAccountButton');
const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
const confirmDeletionButton = document.getElementById('confirmDeletion');

// Afficher la modale au clic sur "Supprimer mon compte"
deleteButton.addEventListener('click', function () {
    confirmationModal.show();
});

// Soumettre le formulaire si l'utilisateur confirme la suppression
confirmDeletionButton.addEventListener('click', function () {
    deleteForm.submit();
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