// public/js/scroll-reveal.js

document.addEventListener("DOMContentLoaded", function() {

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // Si el elemento entra en pantalla (es visible)
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-8');
            } 
            // Si el elemento SALE de la pantalla
            else {
                // Lo volvemos a esconder y bajar para que se anime la próxima vez
                entry.target.classList.add('opacity-0', 'translate-y-8');
            }
        });
    }, {
        threshold: 0.1 // Se activa al ver el 10% del elemento
    });

    // Buscamos y observamos todos los elementos
    const elements = document.querySelectorAll('.scroll-reveal');
    elements.forEach((el) => {
        observer.observe(el);
    });
});