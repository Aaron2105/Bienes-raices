<main class="contenedor seccion">
    <h1>Gestión de Usuarios</h1>
    
    <a href="/admin" class="boton boton-verde">Volver al Panel</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Rol Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td><p><?php echo $usuario->id; ?></p></td>
                    <td><p><?php echo $usuario->email; ?></p></td>
                    <td>
                        <?php if($usuario->id == 6): ?>
                            <span class="alerta exito" style="display:inline-block; margin:0; padding: 0.5rem 1rem;">👑 Super Admin</span>
                        <?php else: ?>
                            
                            <form method="POST" action="/usuarios" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                
                                <select name="rol_id" onchange="this.form.submit()" style="margin:0; width:100%; border-color: #e1e1e1;">
                                    
                                    <option value="" <?php echo $usuario->rol_id === null ? 'selected' : ''; ?>>
                                        -- Sin Permisos --
                                    </option>

                                    <?php foreach($roles as $rol): ?>
                                        <?php 
                                            
                                            if($rol->id == 1) continue; 
                                        ?>
                                        <option value="<?php echo $rol->id; ?>" 
                                            <?php echo $usuario->rol_id === $rol->id ? 'selected' : ''; ?> >
                                            <?php echo $rol->nombre; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </form>

                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($usuario->id != 6): ?>
                            <form method="POST" class="w-100" action="/usuarios/eliminar"> <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>