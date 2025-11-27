<main class="contenedor seccion contenido-centrado">
    <h1>¡Gracias por tu interés!</h1>
    
    <div class="alerta exito">
        <p>Tu solicitud para adquirir la propiedad ha sido enviada correctamente.</p>
    </div>

    <div class="resumen-propiedad" style="margin-top: 3rem;">
        <h3>Has seleccionado: <?php echo $propiedad->titulo; ?></h3>
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen Propiedad" style="max-width: 400px; display: block; margin: 0 auto;">
        <p class="precio" style="text-align: center;">Valor: $<?php echo number_format($propiedad->precio); ?></p>
        
        <p style="text-align: center;">Un agente se pondrá en contacto contigo a tu correo: <span><?php echo $_SESSION['usuario']; ?></span></p>
    </div>

    <a href="/" class="boton-verde" style="display: block; width: 200px; margin: 3rem auto; text-align: center;">Volver al Inicio</a>
</main>