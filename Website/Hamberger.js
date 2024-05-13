
const menuIcon = document.getElementById("menu-icon");
const navLinks = document.querySelector(".nav-links");

menuIcon.addEventListener("click", function () {
    console.log("Hoi")
    navLinks.classList.toggle("active");
});

