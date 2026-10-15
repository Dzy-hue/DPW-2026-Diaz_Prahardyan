document.addEventListener("DOMContentLoaded", function () {
    const navToggleBtn = document.getElementById("nav-toggle-btn");
    const mainNav = document.getElementById("main-nav");

    if (navToggleBtn && mainNav) {
        navToggleBtn.addEventListener("click", function () {
            mainNav.classList.toggle("nav-open");
        });
    }
});