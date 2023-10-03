// Dapatkan URL saat ini
var currentUrl = window.location.pathname;

// Fungsi untuk menandai halaman aktif
function setActiveNavLink() {
    var navLinks = document.querySelectorAll(".nav-link");
    navLinks.forEach(function (link) {
        if (link.getAttribute("href") === currentUrl) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
}
