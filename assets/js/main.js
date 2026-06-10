// Main JavaScript for izinnow.id

document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle logic
    const menuBtn = document.querySelector('nav button');
    const navLinks = document.querySelector('nav .md\\:flex');

    if (menuBtn && navLinks) {
        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('hidden');
            navLinks.classList.toggle('flex');
            navLinks.classList.toggle('flex-col');
            navLinks.classList.toggle('absolute');
            navLinks.classList.toggle('top-full');
            navLinks.classList.toggle('left-0');
            navLinks.classList.toggle('w-full');
            navLinks.classList.toggle('bg-white');
            navLinks.classList.toggle('shadow-lg');
            navLinks.classList.toggle('p-6');
            navLinks.classList.toggle('gap-4');
        });
    }

    // Scroll effect for navbar
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            nav.classList.add('shadow-md');
            nav.classList.remove('border-gray-100');
        } else {
            nav.classList.remove('shadow-md');
            nav.classList.add('border-gray-100');
        }
    });
});
