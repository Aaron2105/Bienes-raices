document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);

    //Muestra campos condicionales

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]'); //Selecciona todos los inputs con el name contacto[contacto]

    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContacto)); //Se recorre toda la lista del querry selector y se le asigna un eventlistener a cada atributo
}

function mostrarMetodosContacto( event ){
    const contactoDiv = document.querySelector("#contacto");

    if(event.target.value === "telefono"){
        contactoDiv.innerHTML = `
        <label for="telefono">Número Teléfono</label>
        <input type="tel" placeholder="Tu teléfono" id="telefono" name="contacto[telefono]">

        <p>Elija la fecha y la hora para la llamada
        </p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-Mail</label>
        <input type="email" placeholder="Tu E-Mail" id="email" name="contacto[email]" required>
        `;
    }

}

function darkMode() {
    // 1. Seleccionamos las preferencias del sistema
    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
    
    // 2. Leemos si el usuario ya eligió algo antes en LocalStorage
    const memoria = localStorage.getItem('dark-mode');

    // 3. APLICAR MODO: 
    // Si hay memoria, la respetamos. Si no, usamos la del sistema.
    if (memoria === 'true') {
        document.body.classList.add('dark-mode');
    } else if (memoria === 'false') {
        document.body.classList.remove('dark-mode');
    } else {
        // Si no hay memoria, revisamos el sistema
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        }
    }

    // 4. EVENTO CLICK EN EL BOTÓN
    const botonDarkMode = document.querySelector('.boton-darkmode');
    
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        
        // 5. GUARDAR EN MEMORIA CADA VEZ QUE SE DA CLICK
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'true');
        } else {
            localStorage.setItem('dark-mode', 'false');
        }
    });
}

function navegacionResponsive(){
    const navegacion = document.querySelector(".navegacion");

    //Hace lo mismo que el if de abajp
    navegacion.classList.toggle("mostrar");
    /*
    if (navegacion.classList.contains("mostrar")){
        navegacion.classList.remove("nostrar"); 
    } else {
        navegacion.classList.ass("mostrar");
    }*/
}