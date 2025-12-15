function checkLogo() {
    const logo = document.querySelectorAll("#logo");
    logo.forEach((logo) => {
        const widthLogo = logo.naturalWidth;
        const heightLogo = logo.naturalHeight;
        if (widthLogo > heightLogo) {
            logo.classList.add("horizontal");
        }
    });
}
window.addEventListener("load", checkLogo());
