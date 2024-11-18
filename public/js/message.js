  // Esperar 5 segundos (5000 ms) y luego ocultar el mensaje
  setTimeout(function() {
    const messageDiv = document.getElementById('successMessage');
    if (messageDiv) {
        // Desaparece suavemente el mensaje con una transición
        messageDiv.style.transition = "opacity 1s";
        messageDiv.style.opacity = 0;
        // Remueve el mensaje del DOM después de la animación
        setTimeout(() => messageDiv.remove(), 1000);
    }
}, 3000);