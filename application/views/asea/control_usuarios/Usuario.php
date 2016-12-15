<!-- cargar header del proyecto -->
<?php $this->load->view('default/header') ?>

<div class="container">
    <div class="panel panel-success">
        <div class="panel-heading">Administración de los usuarios administradores del sistema</div>
        <div class="panel-body">

            <div class="panel panel-default">
                <div class="panel-heading">Búsqueda usuarios administradores</div>
                <div class="panel-body">
                    <form class="form-horizontal" id="form_buscar_usuarios_asea">
                        <div class="form-group">
                            <div class="col-sm-3"><input class="form-control" placeholder="Nombre" name="nombre"></div>
                            <div class="col-sm-3"><input class="form-control" placeholder="Apellido paterno" name="apellido_p"></div>
                            <div class="col-sm-3"><input class="form-control" placeholder="Apellido materno" name="apellido_m"></div>
                            <div class="col-sm-3"><input class="form-control" placeholder="Correo electrónico" name="correo"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3"><input class="form-control" placeholder="Teléfono" name="telefono"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12" style="text-align: right">
                                <button type="button" class=" btn btn-success btn-sm buscar_usuarios_sistema"><span class="glyphicon glyphicon-search"></span>Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Usuarios administradores</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-12" style="text-align: right">
                            <button class="btn btn-info btn-sm agregar_nuevo_administrador_asea" data-backdrop="static">
                                <span class="glyphicon glyphicon-plus"></span>Nuevo administrador
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-12" id="contenedor_resultados_usuarios_sistema">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- conteiners para las peticiones de las operaciones -->
<div id="conteiner_agregar_modificar_usuario_admin"></div>

<!-- cargar footer del proyecto -->
<?php $this->load->view('default/footer') ?>