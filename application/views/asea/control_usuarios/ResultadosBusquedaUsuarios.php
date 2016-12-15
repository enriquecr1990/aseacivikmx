<?php if($listaUsuario): ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Activo</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="tbodyEstacionesServicio">
            <?php foreach ($listaUsuario as $usuario): ?>
                <tr>
                    <td><?=$usuario->nombre.' '.$usuario->apellido_p.' '.$usuario->apellido_m?></td>
                    <td><?=$usuario->correo?></td>
                    <td><?=$usuario->telefono?></td>
                    <td><span class="label label-<?=$usuario->es_activo ? 'success': 'danger'?>"><?=$usuario->activo?></span></td>
                    <td>
                        <button class="btn btn-info btn-xs modificar_usuario_admin_asea" data-toggle="tooltip"
                                title="Modificar usuario administrador" data-placement="bottom"
                                data-tipo_usuario="admin"
                                data-id_usuario="<?=$usuario->id_usuario_admin?>">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </button>
                        <button class="btn btn-<?=$usuario->es_activo ? 'warning' : 'success'?> btn-xs activar_desactivar_usario_sistema" data-toggle="tooltip"
                                data-url="ControlUsuarios/activarDesactivarUsuario/<?=$usuario->id_usuario_admin?>"
                                data-msg="Se <?=$usuario->es_activo ? 'desactivará' : 'activará'?> el usuario administrador, ¿Deseá continuar?"
                                title="<?=$usuario->es_activo ? 'Desactivar' : 'Activar'?> usuario sistema" data-placement="bottom"
                                data-btn_trigger=".buscar_usuarios_sistema"
                                data-id_usuario="<?=$usuario->id_usuario_admin?>">
                            <i class="glyphicon glyphicon-<?=$usuario->es_activo ? 'remove':'ok'?>"></i>
                        </button>
                        <button class="btn btn-danger btn-xs eliminar_usuario_admin" data-toggle="tooltip"
                                data-url="ControlUsuarios/eliminarUsuarioAdmin/<?=$usuario->id_usuario_admin?>"
                                data-btn_trigger=".buscar_usuarios_sistema"
                                title="Eliminar usuario administrador" data-placement="bottom"
                                data-id_usuario="<?=$usuario->id_usuario_admin?>">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-info-sign"></span>No se encontraron registros
    </div>
<?php endif; ?>