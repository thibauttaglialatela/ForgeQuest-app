import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

console.log('welcome to AssetMapper! 🎉');

const burgerMenu = document.querySelector('.burger-menu');

burgerMenu.addEventListener('click', () => {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
});

document.querySelector('.close-menu').addEventListener('click', () => {
    document.querySelector('.nav-links').classList.remove('active');
});

const deleteButtons = document.querySelectorAll('.delete-button');
const popupDelete = document.querySelector('#popup-delete');
const confirmYes = document.querySelector('#confirm-yes');
const confirmNo = document.querySelector('#confirm-no');
let currentForm = null; // Stocke le formulaire à soumettre

// Associer un événement à chaque bouton de suppression
deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
         // Trouve le formulaire associé
        currentForm = button.closest('form'); // Stocke le formulaire pour confirmation
        popupDelete.classList.remove('hidden'); // Affiche la popup
    });
});

// Gestion du bouton "Oui"
confirmYes.addEventListener('click', () => {
    if (currentForm) {
        currentForm.submit(); // Soumet le formulaire si l'utilisateur confirme
    }
    popupDelete.classList.add('hidden'); // Cache la popup
});

// Gestion du bouton "Non"
confirmNo.addEventListener('click', () => {
    popupDelete.classList.add('hidden'); // Cache la popup sans soumettre
    currentForm = null; // Réinitialise le formulaire
});

