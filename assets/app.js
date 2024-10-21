import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

console.log('welcome to AssetMapper! 🎉');

const burgerMenu = document.querySelector('.burger-bar');

burgerMenu.addEventListener('click', () => {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
});

document.querySelector('.close-menu').addEventListener('click', () => {
    document.querySelector('.nav-links').classList.remove('active');
});
