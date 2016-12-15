$(document).ready(function () {

    //desabilitar boton derecho del mouse
    $(this).bind("contextmenu", function(e) {
        e.preventDefault();
    });

    $('body').on('click','.empleado_cursar_norma_asea',function(){
        var id_normas_asea = $(this).data('id_normas_asea');
        EmpleadosES.empleado_cursar_norma(id_normas_asea);
    });

    $('body').on('click','.registrar_curso_norma_empleado_es',function(){
        var id_normas_asea = $(this).data('id_normas_asea');
        EmpleadosES.registrar_empleado_curso_norma(id_normas_asea);
    });

    $('body').on('change','.periodo_curso_empleado_es',function () {
        var periodo = $(this).val();
        EmpleadosES.obtener_cursos_actualizados_para_empleado(periodo);
    });

    $('body').on('click','.empleado_consultar_evaluaciones_norma',function(){
        var id_normas_asea = $(this).data('id_normas_asea');
        EmpleadosES.obtener_evaluacion_norma_asea(id_normas_asea);
    });

    $('body').on('click','.aceptar_envio_evaluacion',function(){
        var is_checked = $(this).is(':checked');
        if(is_checked){
            $('.mandar_evaluacion_norma_empleado').removeAttr('disabled');
        }else{
            $('.mandar_evaluacion_norma_empleado').attr('disabled',true);
        }
    });

    $('body').on('click','.mandar_evaluacion_norma_empleado',function(){
        var boton = $(this);
        boton.attr('disabled',true);
        boton.html('evaluando');
        var html_respuesta = '';
        var validar_form = EmpleadosES.validar_form_evaluacion_norma();
        if(validar_form){
            EmpleadosES.guardar_evaluacion_norma_asea(
                function(response){
                    if(response.exito){
                        ASEA.mensaje_operacion('info',response.msg);
                    }else{
                        ASEA.mensaje_operacion('warning',response.msg);
                    }
                    $('#form_enviar_evaluacion_norma_asea').find('input').prop('disabled',true);
                    $('#form_enviar_evaluacion_norma_asea').find('button.mandar_evaluacion_norma_empleado').remove();
                    setTimeout(function(){
                        window.location.replace(base_url+'EmpleadosES/CursosNormasAsea');
                    },2000);
                }
            );
        }
        boton.removeAttr('disabled');
        boton.html('<i class="glyphicon glyphicon-send"></i>Enviar evaluación');
    });

    $('body').on('click','.actualizar_empleados_es',function(){
        var boton = $(this);
        boton.attr('disabled',true);
        boton.html('Procesando...');
        var html_respuesta = '';
        var validar_form = EmpleadosES.validar_form_empleado_es_sistema();
        if(validar_form){
            EmpleadosES.guardar_empleado_es_sistema(
                function(response){
                    if(response.exito){
                        ASEA.mensaje_operacion('info',response.msg);
                        ASEA.mostrar_modal_bootstrap('modal_form_empleado_es_sistema',false);
                    }else{
                        ASEA.mensaje_operacion('warning',response.msg,'#conteiner_mensajes_modificar_empleado');
                    }
                    /*setTimeout(function(){
                        location.reload();
                    },500);*/
                }
            );
        }
        boton.removeAttr('disabled');
    });

    $('body').on('click','.ver_descargar_constancia_dc3',function () {
        EmpleadosES.ver_descargar_constancia($(this));
    });

    $('body').on('click','.modificar_empleados_sistema',function () {
        var id_empleado_es = $(this).data('id_empleado_es');
        ASEA.obtener_contenido_peticion_html(
            base_url + 'EmpleadosES/modificarEmpleadoESSistema/' + id_empleado_es,{},
            function (response) {
                $('#conteiner_modificar_empleado_es_sistema').html(response);
                ASEA.mostrar_modal_bootstrap('modal_form_empleado_es_sistema',true);
            }
        );
    });

    ASEA.funcion_tooltip();

});

var EmpleadosES = {

    validar_form_evaluacion_norma : function () {
        var form_valido = ASEA.validar('#form_enviar_evaluacion_norma_asea',{});
        if(form_valido){
            //apartado de validaciones secundarias a la validaciones general
            return form_valido;
        }
        return form_valido;
    },

    validar_form_empleado_es_sistema : function () {
        var form_valido = ASEA.validar('#form_modificar_empleado_es',{});
        if(form_valido){
            //apartado de validaciones secundarias a la validaciones general
            return form_valido;
        }
        return form_valido;
    },

    guardar_evaluacion_norma_asea :  function (funcion) {
        ASEA.enviar_formulario_post('form_enviar_evaluacion_norma_asea', base_url + 'EmpleadosES/guardarEvaluacionEmpleadoEs', funcion);
    },

    guardar_empleado_es_sistema :  function (funcion) {
        ASEA.enviar_formulario_post('form_modificar_empleado_es', base_url + 'EmpleadosES/guardarEmpleadosESSistema', funcion);
    },

    empleado_cursar_norma : function(id_norma_asea){
        ASEA.obtener_contenido_peticion_html(
            base_url + 'EmpleadosES/iniciarCursoNormaAsea/'+id_norma_asea,{},
            function (response) {
                $('#conteiner_empleado_cursar_norma_asea').html(response);
                var tiempo_actividades = $('#conteiner_empleado_cursar_norma_asea').find('input#tiempo_actividades').val();
                ASEA.mostrar_modal_bootstrap('modal_empleado_es_cursar_norma_asea',true);
                setTimeout(function () {
                    $('#btn_close_alert_info_curso_norma').trigger('click');
                },5000);
                setTimeout(function(){
                    $('#modal_empleado_es_cursar_norma_asea').find('.registrar_curso_norma_empleado_es').fadeIn();
                },tiempo_actividades);
            }
        );
    },

    registrar_empleado_curso_norma : function(id_normas_asea){
        var html_respuesta = '';
        $.ajax({
            type : "POST",
            url : base_url + 'EmpleadosES/registrarEmpleadoCursoNormaAsea',
            data : {id_normas_asea:id_normas_asea},
            dataType : "json",
            success:function (response) {
                if(response.exito){
                    exito = true;
                    ASEA.mensaje_operacion('info',response.msg);
                    EmpleadosES.obtener_cursos_actualizados_para_empleado();
                }else{
                    ASEA.mensaje_operacion('warning',response.msg,'#conteiner_mensajes_sistema_cursar_norma');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                //alert(thrownError);
                //processor(errorResponse);
            }
        });
    },

    obtener_cursos_actualizados_para_empleado :  function (periodo){
        var parametros = '';
        if(periodo != undefined && periodo != ''){
            parametros = '/'+periodo;
        }
        var container_resultados = '#conteiner_contenido_cursos_normas_asea';
        $(container_resultados).html(loader_gif);
        ASEA.obtener_contenido_peticion_html(base_url + 'EmpleadosES/consultarCursosNorma'+parametros,{},
            function (response) {
                $(container_resultados).html(response);
                ASEA.funcion_tooltip();
            }
        );
    },

    obtener_evaluacion_norma_asea : function(id_normas_asea){
        ASEA.obtener_contenido_peticion_html(
            base_url + 'EmpleadosES/obtenerEvaluacionesNormas/'+id_normas_asea,{},
            function (response) {
                $('#conteiner_empleado_evaluaciones_norma_asea').html(response);
                ASEA.mostrar_modal_bootstrap('modal_empleado_es_evaluaciones_norma',true);
            }
        );
    },

    ver_descargar_constancia : function (boton){
        var id_normas_asea = boton.data('id_normas_asea');
        var id_empleado_es = boton.data('id_empleado_es');
        var tipo = boton.data('tipo');
        $('#modal_consultar_constancia_dc3').remove();
        var html_modal_constancia = '' +
            '<div class="modal fade" role="dialog" id="modal_consultar_constancia_dc3"> ' +
                '<div class="modal-dialog modal-lg" role="document"> ' +
                    '<div class="modal-content"> ' +
                        '<div class="modal-header"> ' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> ' +
                            '<h4 class="modal-title">Constancia DC-3</h4> ' +
                        '</div> ' +
                        '<div class="modal-body">' +
                            '<div class="form-group">' +
                                '<iframe style="width: 100%; height: 500px;" ' +
                                    'src="'+base_url+'EmpleadosES/constanciaDC3/'+id_normas_asea+'/'+id_empleado_es+'/'+tipo+'">' +
                                '</iframe>' +
                            '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                            '<div class="form-group"> ' +
                                '<div class="col-sm-12" style="text-align: center"> ' +
                                    '<button type="button" class=" btn btn-primary btn-sm" data-dismiss="modal">Cerrar</button> ' +
                                '</div> ' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
        $('body').append(html_modal_constancia);
        ASEA.mostrar_modal_bootstrap('modal_consultar_constancia_dc3',true);
    }
}
