$(document).ready(function () {

    $('body').on('click','.aceptar_mensaje_confirmacion',function () {
        var url_eliminar = $(this).data('url_eliminar');
        var btn_trigger = $(this).data('btn_trigger');
        var eliminar_html = $(this).data('eliminar_row_html');
        ASEA.confirmar_eliminar_registro(url_eliminar,btn_trigger);
        if(eliminar_html != undefined && eliminar_html != ''){
            $(eliminar_html).remove();
        }
    });

    $(document).on('click','.asea_agregar_row_tabla', function(e){
        e.preventDefault();
        var destino = $($(this).data("row_destino"));
        var html = $($(this).data("row_origen")).html();

        html = html.replace("<!--","");
        html = html.replace("-->","");
        html = html.replace(/\{id}/g, $.now()); //cmabia el token ID por un identificador aleatorio "es un random"

        destino.append(html);
        ASEA.funcion_tooltip();
    });

    $('body').on('click','.eliminar_row_tabla',function () {
        $(this).closest('tr').remove();
    });

    $('body').on('click','.boton_carpeta',function(){
        var is_expand = $(this).hasClass('collapsed');
        if(is_expand){
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-success');
            $(this).find('i').removeClass('glyphicon-folder-open');
            $(this).find('i').addClass('glyphicon-folder-close');
        }else{
            $(this).removeClass('btn-success');
            $(this).addClass('btn-primary');
            $(this).find('i').removeClass('glyphicon-folder-close');
            $(this).find('i').addClass('glyphicon-folder-open');
        }
    });

    $('body').on('click','.eliminar_reglon_tabla',function(){
        $(this).closest('tr').remove();
    });

    $('body').on('click','.iniciar_registro_es',function () {
        $.getScript(base_url+'extras/datepicker/locales/bootstrap-datepicker.es.min.js',function(){});
        $.getScript(base_url+'extras/fileinput/js/fileinput.js',function(){});
        $.getScript(base_url+'extras/fileupload/js/vendor/jquery.ui.widget.js',function(){});
        $.getScript(base_url+'extras/fileupload/js/jquery.iframe-transport.js',function(){});
        $.getScript(base_url+'extras/fileupload/js/jquery.fileupload.js',function(){});
        $.getScript(base_url+'extras/asea/es/es_registro.js',function(){});
        $('#conteiner_registro_es').html('');
        ASEA.obtener_contenido_peticion_html(
            base_url + 'Asea/iniciarRegistroES',{},
            function (response) {
                $('#conteiner_registro_es').html(response);
                ASEA.mostrar_modal_bootstrap('modal_registro_estacion_servicio',true);
                ASEA.funcion_fileinput();
                ESRegistro.iniciar_carga_archivos_es();
            }
        );
    });

    ASEA.mensaje_ocultar_inicio_sistema();

});

var ASEA = {
    /*
     * funcion para validar un formulario con jquery vaidate
     * se necesita el ID del formulario y reglas adicionales
     * estas reglas adicionales son por campo de un formulario
     * de ser neceario
     */
    validar : function (id_form,options){
        var validator = $(id_form).validate(options);
        validator.form();
        var result = validator.valid();
        return result;
    },

    reglas_validate : function () {
        var reglas = {}
        return reglas;
    },

    validar_curp : function(stringValidar){
        return stringValidar.match(/^[A-ZÑ]{4}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z]{6}[0-9]{2}$/);
    },

    validar_rfc : function(stringValidar){
        return stringValidar.match(/^[A-ZÑ]{3}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3}$/);
    },

    mostrar_modal_bootstrap : function(id_modal,mostrar){
        if(mostrar){
            $('#'+id_modal).modal({backdrop: 'static', keyboard: false});
            $('#'+id_modal).modal('show');
        }else{
            $('#'+id_modal).modal('hide');
        }
    },

    mensaje_operacion : function (type,msg,destino) {
        var id_random = Math.floor(Math.random() * 10000000001);
        var conteiner_mensajes = '#conteiner_mensajes_sistema_asea';
        if(destino != undefined && destino != ''){
            conteiner_mensajes = destino;
        }
        var icon = type == 'danger' ? 'warning' : 'info';
        var html_respuesta = '' +
            '<div class="col-sm-12">' +
                '<div id="alert_mensaje_'+id_random+'" class="alert alert-'+type+' alert-dismissible">' +
                    '<button id="btn_close_alert_'+id_random+'" type="button" ' +
                        'class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<div class="centrado"><span class="glyphicon glyphicon-'+icon+'-sign"></span>&nbsp;<label>Información del sistema</label></div>' + msg
                '</div>' +
            '</div>';
        $(conteiner_mensajes).append(html_respuesta);
        $('#alert_mensaje_'+id_random).fadeIn();
        setTimeout(function () {
            $('#btn_close_alert_'+id_random).trigger('click');
        },8000);
    },

    mostrar_modal_confirmacion : function(url,msg_eliminar,btn_trigger,remove_html){
        var html_modal_confirmacion = '' +
            '<div class="modal fade" role="dialog" id="modal_confirmar_operacion">' +
                '<div class="modal-dialog" role="document"> ' +
                    '<div class="modal-content"> ' +
                        '<div class="modal-header"> ' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> ' +
                            '<h5 class="modal-title">Mensaje de confirmación</h5> ' +
                        '</div>' +
                        '<form class="form-horizontal" id="form_enviar_mensaje_confirmacion">' +
                            '<div id="error_eliminar_registro"></div>' +
                            '<div class="modal-body">' +
                                '<div class="form-group" style="text-align: center">' +
                                    '<div class="col-sm-12">' +
                                        '<div class="alert alert-danger">'+msg_eliminar+'</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="modal-footer" style="text-align: center;">' +
                                '<button type="button" class="btn btn-success btn-sm aceptar_mensaje_confirmacion" ' +
                                    'data-eliminar_row_html="'+remove_html+'"' +
                                    'data-url_eliminar="'+url+'" data-btn_trigger="'+btn_trigger+'" >Aceptar</button> ' +
                                '<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>' +
                            '</div>' +
                        '</form>' +
                    '</div>' +
                '</div>' +
            '</div>';
        $('#conteiner_modal_confirmacion').html(html_modal_confirmacion);
        ASEA.mostrar_modal_bootstrap('modal_confirmar_operacion',true);
    },

    confirmar_eliminar_registro : function (url,btn_trigger) {
        var html_respuesta = '';
        console.log(url);
        $.ajax({
            type: "POST",
            url: base_url + url,
            data: {},
            dataType: "json",
            success:function (respuesta) {
                if(respuesta.exito){
                    ASEA.mensaje_operacion('info',respuesta.msg);
                    ASEA.mostrar_modal_bootstrap('modal_confirmar_operacion',false);
                    $(btn_trigger).trigger('click');
                }else{
                    ASEA.mensaje_operacion('warning',respuesta.msg);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
            }
        });
    },

    //funcion para obtener el html como respuesta de una peticion de un controllador
    obtener_contenido_peticion_html : function (url,parametros,processor,metodo) {
        if (!metodo) {
            metodo = "POST";
        }
        $.ajax({
            type : metodo,
            data : parametros,
            dataType: "html",
            url : url,
            success : function (data) {
                processor(data,true);
            },
            error : function (xhr,ajaxOptions,thrownError) {
                alert(xhr.status);
                alert(thrownError);
                processor("No se pudo establecer con el servidor",false);
            }
        });
    },

    enviar_formulario_post : function (id_formulario,url,processor,parametros) {
        $.ajax({
            type : "POST",
            url : url,
            data : $('#'+id_formulario).serialize()+ASEA.serializar_json_formulario(parametros),
            dataType : "json",
            success:function (data) {
                processor(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                //alert(thrownError);
                processor(errorResponse);
            }
        });
    },

    //funcion que nos devuel el post de un formulario para enviarlo al controller
    obtener_post_formulario : function (id_formulario) {
        return $('#'+id_formulario).serialize()+ASEA.serializar_json_formulario(undefined);
    },

    //funcion que nos permite serializar en json el post un formulario
    serializar_json_formulario : function (json) {
        var strSerialized = '';
        if(json != null){
            $.each(json,function (key,value) {
                strSerialized += strSerialized == "" ? '&'+key+'='+value : '&'+key+'='+value;
            });
        }
        return strSerialized;
    },

    funcion_popover : function () {
        $('.popoverShow').popover()
    },

    funcion_tooltip : function () {
        $('[data-toggle="tooltip"]').tooltip();
    },

    funcion_fileinput : function(){
        $('.file').fileinput({
            showCaption: false,
            showPreview: false,
            showUpload: false,
            showRemove: false,
            removeLabel: '',
            removeIcon: '<i class="glyphicon glyphicon-trash"></i> ',
            browseClass: 'btn btn-primary',
            browseLabel: 'Examinar &hellip;',
            //browseIcon: '<i class="glyphicon glyphicon-upload"></i> &nbsp;',
        });
    },

    funciones_datepicker : function () {
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });
    },

    mensaje_ocultar_inicio_sistema:function () {
        setTimeout(function () {
            $('#btn_close_alert_inicio_sistema').trigger('click');
        },5000)
    }
}

var errorResponse = {
    success:false,
    printMessages:true,
    messages:[
        {
            message: "A ocurrido un error",
            priority: "error"
        }]
};