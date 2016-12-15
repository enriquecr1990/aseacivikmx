<div class="modal fade" role="dialog" id="modal_registrar_modificar_usuario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><?=isset($usuario_admin) ? 'Modificar usuario administrador' : 'Agregar usuario administrador'?></h5>
            </div>
            <form class="form-horizontal" id="form_guardar_usuario_administrador">
                <div class="col-sm-12">
                    <div id="form_mensajes_usuario_administrador" class="mensajes_sistema_asea"></div>
                </div>

                <?php if(isset($es_configuracion) && $es_configuracion): ?>
                    <input type="hidden" name="es_configuracion" value="1">
                <?php endif; ?>
                <input type="hidden" name="usuario_admin[id_usuario_admin]" value="<?=isset($usuario_admin) ? $usuario_admin->id_usuario_admin : ''?>">
                <input type="hidden" name="usuario[id_usuario]" value="<?=isset($usuario) ? $usuario->id_usuario : ''?>">
                <input type="hidden" name="usuario[tipo]" value="<?=isset($tipo_usuario) ? $tipo_usuario : 'admin'?>">
                <input type="hidden" name="usuario[update_password]" value="<?=isset($usuario) ? $usuario->update_password + 1 : '0'?>">

                <div class="modal-body">
                    <div class="form-group">
                        <div id="guardar_form_busqueda_normas_asea_modal">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Nombre:</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Nombre" data-rule-required="true"
                                   name="usuario_admin[nombre]" value="<?=isset($usuario_admin) ? $usuario_admin->nombre : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Apellido paterno:</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Apellido paterno" data-rule-required="true"
                                   name="usuario_admin[apellido_p]" value="<?=isset($usuario_admin) ? $usuario_admin->apellido_p : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Apellido materno:</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Apellido materno" data-rule-required="true"
                                   name="usuario_admin[apellido_m]" value="<?=isset($usuario_admin) ? $usuario_admin->apellido_m : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Teléfono:</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Teléfono" data-rule-required="true"
                                   name="usuario_admin[telefono]" value="<?=isset($usuario_admin) ? $usuario_admin->telefono : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Correo:</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Correo" data-rule-required="true" data-rule-email="true"
                                   name="usuario_admin[correo]" value="<?=isset($usuario_admin) ? $usuario_admin->correo : ''?>">
                        </div>
                    </div>
                    <?php
                        $disable_usr = 'readonly="readonly"';
                        if((isset($usuario) && $usuario->tipo == 'administrador' && $usuario->update_password == 0)
                            || !isset($usuario)){
                            $disable_usr = '';
                        }
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3">Usuario:</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Usuario" data-rule-required="true" <?=$disable_usr?>
                                   name="usuario[usuario]" value="<?=isset($usuario) ? $usuario->usuario : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Contraseña:</label>
                        <div class="col-sm-9">
                            <input type="password" id="password" class="form-control" placeholder="Constraseña" data-rule-required="true"
                                   name="usuario[password]" value="<?=isset($usuario) ? $usuario->password : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Repetir contraseña:</label>
                        <div class="col-sm-9">
                            <input type="password" id="repeat_password" class="form-control" placeholder="Constraseña"
                                   data-rule-required="true" value="<?=isset($usuario) ? $usuario->password : ''?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button type="button" class="btn btn-success btn-sm guardar_usuario_admin_asea">Aceptar</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>