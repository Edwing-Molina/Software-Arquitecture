document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Buscamos todos los formularios que tengan la clase .ajax-cart-form
    const forms = document.querySelectorAll('.ajax-cart-form');
    const cartBadge = document.getElementById('cart-count'); 

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // ¡ALTO! No recargues la página

            const formData = new FormData(this);
            const actionUrl = this.getAttribute('action');
            const button = this.querySelector('button');
            const originalContent = button.innerHTML; // Guardamos el icono y texto original

            // Efecto visual: "Cargando..."
            button.disabled = true;
            button.innerHTML = "Añadiendo..."; 

            // Enviamos los datos por detrás (AJAX)
            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Actualizamos el contador rojo del header
                    if(cartBadge) {
                        // 1. Actualizamos el número
                        cartBadge.innerText = data.cartCount;
                        
                        // 2. IMPORTANTE: Le quitamos lo "oculto" por si es el primer producto
                        cartBadge.classList.remove('hidden'); 

                        // 3. Pequeña animación de pulso
                        cartBadge.classList.add('scale-125');
                        setTimeout(() => cartBadge.classList.remove('scale-125'), 200);
                    }
                    
                    // Feedback visual en el botón (Verde)
                    button.innerHTML = "¡Listo!";
                    button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    button.classList.add('bg-green-500');
                    
                    // Regresamos el botón a la normalidad después de 2 segundos
                    setTimeout(() => {
                        button.innerHTML = originalContent; 
                        button.disabled = false;
                        button.classList.remove('bg-green-500');
                        button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.disabled = false;
                button.innerHTML = originalContent;
            });
        });
    });
});