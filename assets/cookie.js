// any CSS you import will output into a single css file (app.scss in this case)
import './scss/app.scss';

// start the Stimulus application
import 'jquery';
import 'bootstrap'
import './bootstrap';

const cookieContainer = document.querySelector(".cookie-container");
const cookieButton = document.querySelector(".cookie-btn")

cookieButton.addEventListener("click", () => {
    cookieContainer.classList.remove("active");
    localStorage.setItem("cookieBannerDisplayed", "true")
});

setTimeout(() => {
    if (!localStorage.getItem("cookieBannerDisplayed"))
    cookieContainer.classList.add("active")
}, 2000);
