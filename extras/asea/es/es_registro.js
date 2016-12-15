$(document).ready(function () {
    
    $('body').on('click','.guardar_registro_es',function () {
        $(this).attr('disabled',true);
        $(this).html('Procesando...');
        var html_respuesta = '';
        var validar_registro_es = ESRegistro.validar_formulario();
        //var validar_registro_es = true;
        if(validar_registro_es){
            ESRegistro.guardar_registro_es(
                function (response) {
                    if(response.exito){
                        ASEA.mensaje_operacion('info',response.msg);
                        ASEA.mostrar_modal_bootstrap('modal_registro_estacion_servicio',false);
                        $('.buscar_estaciones_servicio').trigger('click');
                        $('.form_configuracion_usuario').html(loader_gif);
                        if(response.recargar != undefined && response.recargar){
                            setTimeout(function () {
                                location.reload();
                            },500);
                        }
                    }else{
                        ASEA.mensaje_operacion('warning',response.msg,'#conteiner_mensaje_registro_es');
                    }
                    $(this).removeAttr('disabled');
                    $(this).html('Aceptar');
                }
            );
        }
        $(this).removeAttr('disabled');
        $(this).html('Aceptar');
    });

    $('body').on('click','.guardar_nueva_estacion_registro_es',function () {
        $(this).attr('disabled',true);
        $(this).html('Procesando...');
        var html_respuesta = '';
        var validar_registro_es = ESRegistro.validar_formulario();
        //var validar_registro_es = true;
        if(validar_registro_es){
            ESRegistro.guardar_nuevo_registro_es(
                function (response) {
                    if(response.exito){
                        ASEA.mensaje_operacion('info',response.msg);
                        ASEA.mostrar_modal_bootstrap('modal_registro_estacion_servicio',false);
                        $('.buscar_estaciones_servicio').trigger('click');
                    }else{
                        ASEA.mensaje_operacion('warning',response.msg,'#conteiner_mensaje_registro_es');
                    }
                    $(this).removeAttr('disabled');
                    $(this).html('Aceptar');
                }
            );
        }
        $(this).removeAttr('disabled');
        $(this).html('Aceptar');
    });

    $('body').on('click','.activar_desactivar_estacion_es',function () {
        var url = $(this).data('url');
        var msn_confirmacion = $(this).data('msg');
        var btn_trigger = $(this).data('btn_trigger');
        ASEA.mostrar_modal_confirmacion(url,msn_confirmacion,btn_trigger);
    });

    $('body').on('click','.buscar_estaciones_servicio',function () {
        ESRegistro.buscar_estaciones_servicio();
    });

    $('body').on('click','.agregar_estacion_servicio',function () {
        ESRegistro.agregar_modificar_estacion_servicio();
    });

    $('body').on('click','.modificar_estacion_servicio',function () {
        var id_estacion_servicio = $(this).data('id_estacion_servicio');
        var es_configuracion = $(this).data('es_configuracion');
        ESRegistro.agregar_modificar_estacion_servicio(id_estacion_servicio,es_configuracion);
    });

    $('body').on('click','.agregar_empleado_es',function () {
        var id_estacion_servicio = $(this).data('id_estacion_servicio');
        ESRegistro.agregar_empleados_estacion_servicio(id_estacion_servicio,true);
    });

    $('body').on('click','.agregar_nuevo_empleado_es',function () {
        var html_nuevo_empleado = ESRegistro.agregar_nuevo_empleado_es();
        $('.tbodyEmpleadosES').append(html_nuevo_empleado);
    });

    $('body').on('click','.guardar_empleados_es',function () {
        $(this).attr('disabled',true);
        $(this).html('Procesando...');
        var html_respuesta = '';
        var validar_registro_es = ESRegistro.validar_formulario_empleados_es();
        if(validar_registro_es){
            ESRegistro.guardar_registro_empleados_es(
                function (response) {
                    if(response.exito){
                        ASEA.mensaje_operacion('info',response.msg);
                        ASEA.mostrar_modal_bootstrap('modal_modificar_registrar_empleados_es',false);
                        $('#form_empleados_es').html(loader_gif);
                        setTimeout(function () {
                            location.reload();
                        },500);
                    }else{
                        ASEA.mensaje_operacion('warning',response.msg,'#guardar_form_empleados_es');
                    }
                    $(this).removeAttr('disabled');
                    $(this).html('Aceptar');
                }
            );
        }
        $(this).removeAttr('disabled');
        $(this).html('Aceptar');
    });

    $('body').on('click','.consultar_empleados_es',function () {
        var id_estacion_servicio = $(this).data('id_estacion_servicio');
        ESRegistro.agregar_empleados_estacion_servicio(id_estacion_servicio,false);
    });

    $('body').on('click','.eliminar_logo_registro_es',function () {
        var id_documento_asea = $(this).data('id_documento_asea');
        ESRegistro.elimiar_documento_asea(id_documento_asea);
    });
    
    $('body').on('click','.eliminar_empleado_es',function () {
        var url = $(this).data('url');
        var msg_elimiar = 'Se eliminara el empleado de forma permante, esto incluye las normas cursadas y sus evaluaciones,' +
            ' el cambio se realizá inmediatamente, ¿Desea continuar?';
        var btn_trigger = '';
        var remove_html = $(this).data('eliminar_html');
        ASEA.mostrar_modal_confirmacion(url,msg_elimiar,btn_trigger,remove_html);
    });

    $('body').on('click','.registrar_normas_estacion_servicio',function(){
        var id_estacion_servicio = $(this).data('id_estacion_servicio');
        ESRegistro.registrar_normas_estacion_servicio(id_estacion_servicio);
    });

    $('body').on('change','.buscar_normas_estacion_servicio',function(){
        var id_estacion_servicio = $(this).data('id_estacion_servicio');
        var anio = $(this).val();
        ESRegistro.buscar_normas_estacion_servicio(id_estacion_servicio,anio);
    });

    $('body').on('click','.guardar_normas_estacion_servicio',function () {
        $(this).attr('disabled',true);
        $(this).html('Procesando...');
        var html_respuesta = '';
        var validar_form = ESRegistro.validar_formulario_norma_estacion();
        if(validar_form){
            ESRegistro.guardar_norma_estacion_servicio(
                function (response) {
                    if(response.exito){
                        ASEA.mensaje_operacion('info',response.msg);
                        ASEA.mostrar_modal_bootstrap('modal_registro_normas_estacion_servicio',false);
                    }else{
                        ASEA.mensaje_operacion('warning',response.msg,'#guardar_form_empleados_es');
                    }
                    $(this).removeAttr('disabled');
                    $(this).html('Aceptar');
                }
            );
        }
        $(this).removeAttr('disabled');
        $(this).html('Aceptar');
    });

    $('body').on('click','.popoverShowImage',function () {
        var src_img = $(this).data('src_image');
        var nombre_archivo = $(this).data('nombre_archivo');
        $(this).popover({
            html :true,
            trigger: 'hover',
            title: nombre_archivo,
            placement: 'top',
            content: function () {
                return '<img src="'+src_img+'" width="180px" height="100px" />'
            }
        });
    });

    $('body').on('click','.check_all_normas',function(){
        var is_checked = $(this).is(':checked');
        if(is_checked){
            $('.checkbox_norma_estacion_servicio').prop('checked',true);
        }else{
            $('.checkbox_norma_estacion_servicio').prop('checked',false);
        }
    });

    $('body').on('click','.checkbox_norma_estacion_servicio',function(){
        ESRegistro.checked_normas_estacion_servicio();
    });

    $('body').on('change','#es_rfc',function () {
        var rfc = $(this).val();
        $(this).val(rfc.toUpperCase());
    });

    $('body').on('change','.input_curp',function () {
        var rfc = $(this).val();
        $(this).val(rfc.toUpperCase());
    });

    $('.buscar_estaciones_servicio').trigger('click');

    ASEA.funciones_datepicker();
    ASEA.funcion_tooltip();
});

var ESRegistro = {

    validar_formulario : function () {
        var form_valido = ASEA.validar('#form_registro_es',{});
        if(form_valido){
            //apartado de validaciones secundarias a la validaciones general
            var archivo_logo = $('#form_registro_es').find('#es_logo_registro_file').html();
            if(archivo_logo == '' || archivo_logo == undefined){
                form_valido = false;
                var html_file = '<label class="error">&nbsp;El logo es requerido</label>'
                $('#form_registro_es').find('#es_logo_registro_file').html(html_file);
            }

            if(ASEA.validar_rfc($('#form_registro_es').find('.input_rfc').val()) == null){
                form_valido = false;
                var html_file = '<label class="error">&nbsp;El RFC no tiene la estructura correcta</label>'
                $('#form_registro_es').find('.input_rfc').closest('div').append(html_file);
            }

            return form_valido;
        }
        return form_valido;
    },

    validar_formulario_empleados_es : function () {
        var form_valido = ASEA.validar('#form_empleados_es',{});
        if(form_valido){
            var num_representantes = $('.tbodyEmpleadosES').find('tr').length;
            if(num_representantes == 0){
                form_valido = false;
                $('.mensajes_empleados_guardar').html('<label class="error">Es necesario que registre por lo menos un empleado</label>');
            }else{
                var num_son_representantes = 0;
                $('.tbodyEmpleadosES').find('input#empleado_es_representante').each(function () {
                    var is_checked = $(this).is(':checked');
                    if(is_checked){num_son_representantes++}
                });
                if(num_son_representantes != 1){
                    form_valido = false;
                    $('.mensajes_empleados_guardar').html('<label class="error">Solo puede existir un empleado que sea representante</label>');
                }
                $('.tbodyEmpleadosES').find('.input_curp').each(function(){
                    if(ASEA.validar_curp($(this).val()) == null){
                        form_valido = false;
                        $(this).closest('td').append('<label class="error">El CURP tiene formato no válido</label>');
                    }
                });
            }
        }
        return form_valido;
    },

    validar_formulario_norma_estacion : function(){
        var num_checks_normas = $('.checkbox_norma_estacion_servicio:checked').length;
        if(num_checks_normas == 0){
            $('#conteiner_error_validacion_norma_estacion_servicio').html('<label class="error">Es necesario que registré por lo menos una norma para la estación de servicio</label>')
            return false;
        }return true;
    },

    guardar_registro_es : function (funcion) {
        ASEA.enviar_formulario_post('form_registro_es', base_url + 'EstacionServicio/guardarEstacionServicio', funcion);
    },

    guardar_nuevo_registro_es : function (funcion) {
        ASEA.enviar_formulario_post('form_registro_es', base_url + 'Asea/guardarEstacionServicio', funcion);
    },

    guardar_registro_empleados_es : function (funcion) {
        ASEA.enviar_formulario_post('form_empleados_es', base_url + 'EstacionServicio/guardarEmpleadosES', funcion);
    },

    guardar_norma_estacion_servicio: function (funcion) {
        ASEA.enviar_formulario_post('form_registro_normas_estacion_servicio',
            base_url + 'EstacionServicio/guardarNormasEstacionServicio', funcion);
    },

    elimiar_documento_asea : function(id_documento_asea){
        $.ajax({
            type : "POST",
            url : base_url + 'EstacionServicio/eliminarDocumentoAsea/'+id_documento_asea,
            data : {},
            dataType : "json",
            success:function (data) {
                if(data.exito){
                    $('#es_logo_registro_file').html('');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                //alert(thrownError);
                processor(errorResponse);
            }
        });
    },

    agregar_modificar_estacion_servicio : function (id_estacion_servicio,es_configuracion) {
        var parametrosController = '';
        var post = {};
        if(id_estacion_servicio != undefined && id_estacion_servicio != ''){
            parametrosController += '/'+id_estacion_servicio;
        }if(es_configuracion != undefined && es_configuracion != ''){
            post = {es_configuracion : es_configuracion}
        }
        ASEA.obtener_contenido_peticion_html(
            base_url + 'EstacionServicio/modificarAgregarEstacionServicio'+parametrosController,post,
            function (response) {
                $('#conteiner_agregar_modificar_es').html(response);
                ASEA.mostrar_modal_bootstrap('modal_registro_estacion_servicio',true);
                ASEA.funcion_fileinput();
                ESRegistro.iniciar_carga_archivos_es();
                $('.popoverShowImage').trigger('click');
            }
        );
    },

    buscar_estaciones_servicio : function () {
        var id_formulario = 'form_buscar_estacion_servicio';
        var container_resultados = '#contenedor_resultados_estacion_servicio';
        var post_formulario = ASEA.obtener_post_formulario(id_formulario);
        $(container_resultados).html(loader_gif);
        ASEA.obtener_contenido_peticion_html(base_url + 'EstacionServicio/buscarEstacionesServicio',post_formulario,
            function (response) {
                $(container_resultados).html(response);
                ASEA.funcion_tooltip();
            }
        );
    },

    buscar_normas_estacion_servicio : function (id_estacion_servicio,anio) {
        var container_resultados = '#conteiner_resultados_estacion_servicio';
        $(container_resultados).html(loader_gif);
        ASEA.obtener_contenido_peticion_html(base_url + 'EstacionServicio/normasAnioEstacionServicio',
            {id_estacion_servicio:id_estacion_servicio,anio:anio},
            function (response) {
                $(container_resultados).html(response);
                ASEA.funcion_tooltip();
                ESRegistro.checked_normas_estacion_servicio();
            }
        );
    },

    registrar_normas_estacion_servicio : function(id_estacion_servicio){
        var conteiner_resultados = '#conteiner_registro_normas_es';
        ASEA.obtener_contenido_peticion_html(
            base_url + 'EstacionServicio/registrarNormasEstacionServicio/'+ id_estacion_servicio,{},
            function(response){
                $(conteiner_resultados).html(response);
                ASEA.mostrar_modal_bootstrap('modal_registro_normas_estacion_servicio',true);
                ASEA.funcion_tooltip();
            }
        );
    },

    agregar_empleados_estacion_servicio : function(id_estacion_servicio,editarEmpleados){
        ASEA.obtener_contenido_peticion_html(base_url + 'EstacionServicio/agregarEmpleadosES/'+id_estacion_servicio,{editarEmpleados:editarEmpleados},
            function (respuesta) {
                $('#conteiner_registro_empleados_es').html(respuesta);
                ASEA.mostrar_modal_bootstrap('modal_modificar_registrar_empleados_es',true);
            }
        );
    },

    agregar_nuevo_empleado_es : function () {
        var id_random = Math.floor(Math.random() * 10000000001);
        var html_nuevo_empleado = '' +
            '<tr id="row_table_eliminar_'+id_random+'">' +
                '<input type="hidden" name="empleado_es['+id_random+'][id_empleado_es]" value="">' +
                '<input type="hidden" name="usuario['+id_random+'][id_usuario]" value="">' +
                '<td><input class="form-control input_datos_es" data-rule-required="true" placeholder="Nombre" name="empleado_es['+id_random+'][nombre]" value=""></td>' +
                '<td><input class="form-control input_datos_es" data-rule-required="true" placeholder="Apellido paterno" name="empleado_es['+id_random+'][apellido_p]" value=""></td>' +
                '<td><input class="form-control input_datos_es" data-rule-required="true" placeholder="Apellido materno" name="empleado_es['+id_random+'][apellido_m]" value=""></td>' +
                '<td><input class="form-control input_curp" data-rule-required="true" data-rule-minlength="18" data-rule-maxlength="18" placeholder="CURP" name="empleado_es['+id_random+'][curp]" value=""></td>' +
                '<td><input class="form-control input_datos_es" data-rule-required="true" placeholder="Puesto" name="empleado_es['+id_random+'][puesto]" value=""></td>' +
                '<td class="centrado">' +
                    '<input id="empleado_es_representante" type="checkbox" class="form-control" name="empleado_es['+id_random+'][es_representante]" value="si" style="height:15px;">' +
                '</td>' +
                '<td><input class="form-control input_datos_es" data-rule-required="true" placeholder="Usuario" name="usuario['+id_random+'][usuario]" value=""></td>' +
                '<td><input type="password" class="form-control input_datos_es" data-rule-required="true" placeholder="Contraseña" name="usuario['+id_random+'][password]" value=""></td>' +
                '<td><button class="btn btn-danger btn-xs eliminar_empleado_es" data-eliminar_html="#row_table_eliminar_'+id_random+'"' +
                        'data-toggle="tooltip" data-id_empleado_es="" data-url="EstacionServicio/eliminarEmpleadosES/eliminar_empleado_es"' +
                        'title="Eliminar empleado" data-placement="bottom"><i class="glyphicon glyphicon-trash"></i></button></td>' +
            '</tr>';
        return html_nuevo_empleado;
    },

    iniciar_carga_archivos_es : function () {
        //funcion para cargar archivo via ajax
        var html_respuesta = '';
        $('.fileLogoEstacionServicio').fileupload({
            url : base_url + 'Asea/uploadFileLogo',
            dataType: 'json',
            start: function () {
                $('#es_logo_registro_file').html(loader_gif);
            },
            add: function (e,data) {
                var goUpload = true;
                var uploadFile = data.files[0];
                var extenciones = 'png|jpg|jpeg|gif';
                var regExp = "\.(" + extenciones_files + ")$";
                regExp = new RegExp(regExp);
                if(!regExp.test(uploadFile.name.toLowerCase())){
                    alert('Archivo no es una imagen admitida');
                    goUpload = false;
                }if(uploadFile.size > 5000000){
                    alert('el archivo es mayor a 5 Mb');
                    goUpload = false;
                }if(goUpload){
                    data.submit();
                }
            },
            done:function (e,data) {
                if(data.result.exito){
                    html_respuesta = '' +
                        '<input type="hidden" name="estacion_servicio_tiene_documento[id_documento_asea]" value="'+data.result.documento_asea.id_documento_asea+'">' +
                        '<button type="button" class="btn btn-info btn-xs popoverShowImage" ' +
                            'data-nombre_archivo="'+data.result.documento_asea.nombre+'"' +
                            'data-src_image="'+base_url + data.result.documento_asea.ruta_directorio +'/'+ data.result.documento_asea.nombre+'" >' +
                            '<i class="glyphicon glyphicon-eye-open"></i>Ver logo' +
                        '</button> &nbsp;' +
                        '<button type="button" class="btn btn-danger btn-xs eliminar_logo_registro_es"' +
                            'data-id_documento_asea="'+data.result.documento_asea.id_documento_asea+'">' +
                            '<i class="glyphicon glyphicon-trash"></i>Eliminar logo' +
                        '</button>';
                    $('#es_logo_registro_file').html(html_respuesta);
                    ASEA.funcion_popover();
                    $('.popoverShowImage').trigger('click');
                }else{
                    ASEA.mensaje_operacion('warning',data.result.msg,'#conteiner_mensaje_registro_es');
                }
            },
            error:function (e,data) {
                ASEA.mensaje_operacion('danger',data.result.msg,'#conteiner_mensaje_registro_es');
            }
        });
    },

    checked_normas_estacion_servicio : function () {
        var checks_normas = $('.checkbox_norma_estacion_servicio').length;
        var num_checks_normas = $('.checkbox_norma_estacion_servicio:checked').length;
        if(checks_normas == num_checks_normas){
            $('.check_all_normas').prop('checked',true);
        }else{
            $('.check_all_normas').prop('checked',false);
        }
    }

}
