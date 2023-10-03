const cartIcon = document.getElementById('cart-icon');
const accountIcon = document.getElementById('account-icon');
const cartLink = document.querySelector('.cart-link');

cartLink.addEventListener('mouseenter', (event) => {
    const cartRect = cartIcon.getBoundingClientRect();
    const centerX = cartRect.left + cartRect.width / 2;
    const centerY = cartRect.top + cartRect.height / 2;
    const mouseX = event.clientX;
    const mouseY = event.clientY;

    if (Math.abs(mouseX - centerX) < cartRect.width / 2 && Math.abs(mouseY - centerY) < cartRect.height / 2) {
        accountIcon.style.transition = 'opacity 0.3s, transform 0.3s';
        accountIcon.style.opacity = '0';
        accountIcon.style.transform = 'translateX(20px)';
    }
});

cartLink.addEventListener('mouseleave', () => {
    accountIcon.style.transition = 'opacity 0.3s, transform 0.3s';
    accountIcon.style.opacity = '1';
    accountIcon.style.transform = 'translateX(0)';
});

