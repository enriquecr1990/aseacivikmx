<!-- construccion del menu -->
<nav class="navbar navbar-default">
    <!-- opcion para que mejore con el diseño adaptable -->
    <div class="navbar-header">
        <a class="nav-brand" href="<?= base_url() ?>" style="">
            <img src="<?= base_url() . 'extras/imagenes/logo-ASEA.png' ?>" width="60px" height="40px;">
        </a>
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target=".navbar-ex1-collapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <?php if (isset($usuario->activo) && $usuario->activo
                    && isset($usuario->verificado) && $usuario->verificado): ?>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="glyphicon glyphicon-menu-down"></i>&nbsp;Normas y buenas practicas
                    </a>
                    <ul class="dropdown-menu">
                        <?php if((isset($usuario->es_administrador) && $usuario->es_administrador)
                            || (isset($usuario->es_admin) && $usuario->es_admin)): ?>
                            <li>
                                <a href="<?= base_url() . 'NormasAsea/ControlNormasAsea' ?>">
                                    <i class="glyphicon glyphicon-list-alt"></i>&nbsp;Administración de normas ASEA
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url().'BuenasPracticasAsea'?>" ><i class="glyphicon glyphicon-list"></i> Administración de buenas practicas</a>
                            </li>
                        <?php endif; ?>
                        <?php if(isset($usuario->es_rh_empresa) && $usuario->es_rh_empresa): ?>
                            <li>
                                <a href="<?= base_url() . 'NormasAsea/ControlNormasAsea' ?>">
                                    <i class="glyphicon glyphicon-list-alt"></i>Normas ASEA
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url().'BuenasPracticasAsea'?>" ><i class="glyphicon glyphicon-list"></i>Buenas practicas</a>
                            </li>
                        <?php endif; ?>
                        <?php if((isset($usuario->es_trabajador) && $usuario->es_trabajador)): ?>
                            <li>
                                <a href="<?= base_url() . 'EmpleadosES/CursosNormasAsea' ?>">
                                    <i class="glyphicon glyphicon-list-alt"></i>&nbsp;Normas ASEA
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url().'BuenasPracticasAsea'?>" ><i class="glyphicon glyphicon-list"></i>Buenas practicas</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php if((isset($usuario->es_administrador) && $usuario->es_administrador)
                        || (isset($usuario->es_admin) && $usuario->es_admin)): ?>
                    <li>
                        <a href="<?= base_url() . 'EstacionServicio/ControlEs' ?>">
                            <i class="glyphicon glyphicon-tint"></i>&nbsp;Estaciones de servicio
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(isset($usuario->es_rh_empresa) && $usuario->es_rh_empresa): ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="glyphicon glyphicon-menu-down"></i>&nbsp;Empleados
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?=base_url().'EstacionServicio/administracionEmpleadosES/'.$usuario->id_estacion_servicio?>">
                                    <i class="glyphicon glyphicon-user"></i>&nbsp;Control de empleados
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url().'EstacionServicio/seguimientoEmpleadosEs/'.$usuario->id_estacion_servicio?>">
                                    <i class="glyphicon glyphicon-sunglasses"></i>&nbsp;Seguimiento a empleados
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(isset($usuario->es_administrador) && $usuario->es_administrador): ?>
                    <li>
                        <a href="<?= base_url() . 'ControlUsuarios' ?>"><i class="glyphicon glyphicon-user"></i>&nbsp;Control de usuarios</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li><a href="#"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Contacto</a></li>
        </ul>

        <?php if (isset($usuario) && $usuario): ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown btn_link_menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="glyphicon glyphicon-menu-down"></i>
                        <?=$usuario->usuario_sistema?>
                        <img src="<?=$usuario->imagen_usuario?>" class="img-rounded" width="20px" height="20px">
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url().'ControlUsuarios/configuracion'?>">
                                <i class="glyphicon glyphicon-cd"></i>&nbsp;Configuración
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url() . 'Asea/cerrarSesionAsea' ?>"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Cerrar sessión</a>
                        </li>
                    </ul>
                </li>
            </ul>
        <?php else: ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a role="button" href="#" class="iniciar_registro_es"><i class="glyphicon glyphicon-cd"></i>&nbsp;Registrar ES</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-right" role="form" method="post"
                  action="<?= base_url() . 'Asea/iniciarSesionAsea' ?>">
                <input class="form-control" placeholder="Usuario" name="usuario">
                <input type="password" class="form-control" placeholder="Contraseña" name="password">
                <button type="submit" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-user"></i>Iniciar
                    Sesión
                </button>
            </form>
        <?php endif; ?>

    </div>
</nav>

