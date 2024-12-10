document.querySelectorAll('.cantidad').forEach(input => {
    input.addEventListener('change', function() {
        const id = this.getAttribute('data-id');
        const cantidad = parseInt(this.value);
        const precio = parseFloat(this.getAttribute('data-precio'));
        
        // Validar que la cantidad sea un número y mayor a 0
        if (isNaN(cantidad) || cantidad < 1) {
            alert('Por favor, introduce una cantidad válida.');
            this.value = 1; // Restablecer a 1 si la cantidad es inválida
            return;
        }

        // Actualizar el subtotal en la interfaz
        const subtotal = cantidad * precio;
        this.closest('.producto').querySelector('.subtotal-valor').textContent = subtotal.toFixed(2);

        // Actualizar el total general
        let total = 0;
        document.querySelectorAll('.subtotal-valor').forEach(subtotalElem => {
            total += parseFloat(subtotalElem.textContent);
        });
        document.getElementById('total').textContent = 'Total Compra: $' + total.toFixed(2);

        // Enviar la nueva cantidad al servidor
        fetch(`actualizar_cantidad.php?id=${id}&cantidad=${cantidad}`, {
            method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Manejar respuesta si es necesario
        })
        .catch(error => console.error('Error:', error));
    });
});