import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.scss";

console.log("welcome to AssetMapper! 🎉");

document.addEventListener("DOMContentLoaded", () => {

  const burgerMenu = document.querySelector(".burger-menu");

  if (burgerMenu) {
    burgerMenu.addEventListener("click", () => {
      const navLinks = document.querySelector(".nav-links");
      navLinks.classList.toggle("active");
    });
  }

  let currentForm = null;
  document.addEventListener("click", (event) => {
    if (event.target.matches(".delete-button")) {
      currentForm = event.target.closest("form");
      document.querySelector("#popup-delete")?.classList.remove("hidden");
    }

    if (event.target.matches("#confirm-yes")) {
      if (currentForm) {
        currentForm.submit();
      }
      document.querySelector("#popup-delete")?.classList.add("hidden");
    }

    if (event.target.matches("#confirm-no")) {
      document.querySelector("#popup-delete")?.classList.add("hidden");
      currentForm = null;
    }
  });
});