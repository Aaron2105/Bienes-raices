<main class="contenedor seccion">
    <h1>Crear Nuevo Rol</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" action="/roles/crear">
        <fieldset>
            <legend>Información del Rol</legend>

            <label for="nombre">Nombre del Rol:</label>
            <input type="text" id="nombre" name="rol[nombre]" placeholder="Ej: Editor, Comprador" value="<?php echo s($rol->nombre); ?>">
        </fieldset>

        <fieldset>
            <legend>Permisos Asignados</legend>
            <p>Selecciona qué podrá hacer este rol:</p>
            
            <div class="listado-permisos" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                <?php foreach($permisos as $permiso): ?>
                    <div class="campo-permiso">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input 
                                type="checkbox" 
                                name="permisos[]" 
                                value="<?php echo $permiso->id; ?>"
                                style="width: 20px; height: 20px; margin: 0;"
                            >
                            <?php echo $permiso->nombre; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <input type="submit" value="Guardar Rol" class="boton boton-amarillo">
    </form>
</main>