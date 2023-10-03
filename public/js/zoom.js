    document.addEventListener("DOMContentLoaded", function () {
        const cartLink = document.querySelector(".cart-link");
        const accountIcon = document.getElementById("account-icon");

        // Ketika gambar cart dihover pertama kali
        cartLink.addEventListener("mouseenter", function () {
            // Periksa apakah gambar account sudah dihover sebelumnya
            if (accountIcon.getAttribute("data-hovered") === "false") {
                // Atur ulang animasi gambar account
                accountIcon.style.opacity = "0";
                accountIcon.style.transform = "scale(1)";
                setTimeout(function () {
                    accountIcon.style.opacity = "1";
                    accountIcon.style.transform = "scale(1)";
                }, 0);
                // Tandai bahwa gambar account sudah dihover
                accountIcon.setAttribute("data-hovered", "true");
            }
        });
    });
