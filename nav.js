const navToggle = document.querySelector(".nav-toggle")
const navMenu = document.querySelector(".sf-menu")

navToggle.addEventListener("click", () => {
    navMenu.classList.toggle("nav-menu_visible")
})
