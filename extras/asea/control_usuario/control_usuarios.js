$(document).ready(function () {

    $('body').on('click','.buscar_usuarios_sistema',function () {
        ControlUsuarios.buscar_usuarios_sistema();
    });

    $('body').on('click','.agregar_nuevo_administrador_asea',function () {
        ControlUsuarios.agregar_modificar_usuario_admin($(this));
    });

    $('body').on('click','.modificar_usuario_admin_asea',function () {
        ControlUsuarios.agregar_modificar_usuario_admin($(this));
    });

    $('body').on('click','.eliminar_usuario_admin',function () {
        var url = $(this).data('url');
        var msg_elimiar = 'Se eliminara el usuario administrador de forma permante del sistema, ¿Desea continuar?';
        var btn_trigger = $(this).data('btn_trigger');
        ASEA.mostrar_modal_confirmacion(url,msg_elimiar,btn_trigger);
    });

    $('body').on('click','.activar_desactivar_usario_sistema',function () {
        var url = $(this).data('url');
        var msn_confirmacion = $(this).data('msg');
        var btn_trigger = $(this).data('btn_trigger');
        ASEA.mostrar_modal_confirmacion(url,msn_confirmacion,btn_trigger);
    });

    $('body').on('click','.guardar_usuario_admin_asea',function () {
        var btn_guardar = $(this);
        btn_guardar.attr('disabled',true);
        btn_guardar.html('Procesando...');
        var html_respuesta = '';
        var validar = ControlUsuarios.validar_usuario_admin();
        if(validar){
            ControlUsuarios.guardar_usuario_admin(
                function (response) {
                    if(response.exito){
                        ASEA.mensaje_operacion('info',response.msg);
                        ASEA.mostrar_modal_bootstrap('modal_registrar_modificar_usuario',false);
                        $('.buscar_usuarios_sistema').trigger('click');
                        $('#msg_cambio_pass_asea').remove();
                        $('.form_configuracion_usuario').html(loader_gif);
                        if(response.recargar != undefined && response.recargar){
                            setTimeout(function () {
                                location.reload();
                             },500);
                        }
                    }else{
                        ASEA.mensaje_operacion('warning',response.msg,'#form_mensajes_usuario_administrador');
                    }
                    btn_guardar.removeAttr('disabled');
                    btn_guardar.html('Aceptar');
                }
            );
        }else{
            btn_guardar.removeAttr('disabled');
            btn_guardar.html('Guardar')
        }
    });

    $('.buscar_usuarios_sistema').trigger('click');

});

var ControlUsuarios = {

    buscar_usuarios_sistema : function () {
        var id_formulario = 'form_buscar_usuarios_asea';
        var container_resultados = '#contenedor_resultados_usuarios_sistema';
        var post_formulario = ASEA.obtener_post_formulario(id_formulario);
        $(container_resultados).html(loader_gif);
        ASEA.obtener_contenido_peticion_html(base_url + 'ControlUsuarios/buscarUsuariosSistema',post_formulario,
            function (response) {
                $(container_resultados).html(response);
                ASEA.funcion_tooltip();
            }
        );
    },

    agregar_modificar_usuario_admin : function (btn) {
        var id_usuario = btn.data('id_usuario');
        var tipo_usuario = btn.data('tipo_usuario');
        var es_configuracion = btn.data('es_configuracion')
        var post = {};
        if(tipo_usuario != undefined && tipo_usuario != ''){
            post = {tipo_usuario : tipo_usuario}
        }if(es_configuracion != undefined && es_configuracion != ''){
            post = $.extend(post,{es_configuracion:es_configuracion});
        }
        var parametrosController = '';
        if(id_usuario != undefined && id_usuario != ''){
            parametrosController += '/'+id_usuario;
        }
        ASEA.obtener_contenido_peticion_html(
            base_url + 'ControlUsuarios/agregarModificarUsuario'+parametrosController,post,
            function (response) {
                $('#conteiner_agregar_modificar_usuario_admin').html(response);
                ASEA.mostrar_modal_bootstrap('modal_registrar_modificar_usuario',true);
            }
        );
    },

    validar_usuario_admin : function () {
        $('.error').remove();
        var form_valido = ASEA.validar('#form_guardar_usuario_administrador',{});
        if(form_valido){
            //apartado de validaciones secundarias a la validaciones general
            var input_password = $('#form_guardar_usuario_administrador').find('#password');
            var input_repeat_password = $('#form_guardar_usuario_administrador').find('#repeat_password');
            var password = input_password.val();
            var repeat_password = input_repeat_password.val();
            if(password != repeat_password){
                form_valido = false;
                input_repeat_password.closest('div').append('<label class="error" for="repeat_password">Contraseñas diferentes</label>')
            }
            return form_valido;
        }
        return form_valido;
    },

    guardar_usuario_admin : function (funcion) {
        ASEA.enviar_formulario_post('form_guardar_usuario_administrador', base_url + 'ControlUsuarios/guardarUsuario', funcion);
    },

}
