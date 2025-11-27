<main class="contenedor seccion">
    <h2>Administrador Bienes Raices</h2>

    <?php  
        if(isset($resultado)){
            $mensaje = mostrarNoti(intval($resultado));
            if($mensaje){ ?>
                <p class="alerta exito"> <?php echo s($mensaje); ?></p>
            <?php }
        }
    ?>

    <div class="contenedor-botones" style="margin-bottom: 2rem;">
        
        <?php if(tienePermiso('crear_propiedad')): ?>
            <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <?php endif; ?>

        <?php if(tienePermiso('crear_vendedor')): ?>
            <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
        <?php endif; ?>

        <?php if($_SESSION['rol'] == 'Super Admin'): ?>
            <a href="/usuarios" class="boton boton-amarillo" style="background-color: #333;">Gestión Usuarios</a>
            <a href="/roles/crear" class="boton boton-amarillo" style="background-color: #333;">Crear Roles</a>
        <?php endif; ?>
        
    </div>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> 
        <?php foreach ($propiedades as $propiedad): ?>
            <tr>
                <td><p><?php echo $propiedad->id; ?></p></td>
                <td><p><?php echo $propiedad->titulo; ?></p></td>
                <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen"></td>
                <td><p>$ <?php echo number_format($propiedad->precio); ?></p></td>
                <td>
                    <?php if(tienePermiso('eliminar_propiedad')): ?>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    <?php endif; ?>
                    
                    <?php if(tienePermiso('actualizar_propiedad')): ?>
                        <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if(tienePermiso('crear_vendedor')): // Usamos 'crear_vendedor' para ver la tabla ?>
        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> 
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><p><?php echo $vendedor->id; ?></p></td>
                    <td><p><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></p></td>
                    <td><p><?php echo $vendedor->telefono; ?></p></td>
                    <td>
                        <?php if(tienePermiso('eliminar_vendedor')): ?>
                            <form method="POST" class="w-100" action="/vendedores/eliminar">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                        <?php endif; ?>

                        <?php if(tienePermiso('actualizar_vendedor')): ?>
                            <a class="boton-amarillo-block" href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</main>