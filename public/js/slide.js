// main.js

// Fungsi untuk mengatur animasi gerakan
function animateSections() {
    const sections = document.querySelectorAll(".animated-section");

    sections.forEach((section, index) => {
        const sectionPosition = section.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (sectionPosition < windowHeight - 200) {
            section.classList.add("slide-in");

            if (index % 2 === 0) {
                section.classList.add("slide-right");
            } else {
                section.classList.add("slide-left");
            }
        } else {
            section.classList.remove("slide-in", "slide-right", "slide-left");
        }
    });
}

// Panggil fungsi saat halaman dimuat dan saat digulir
window.addEventListener("load", animateSections);
window.addEventListener("scroll", animateSections);