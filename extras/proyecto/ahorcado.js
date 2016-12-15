$(document).ready(function () {

    $('body').on('click','.letra_teclado_ahorcado',function(){
        var id_pregunta = $('#form_juego_ahorcado').find('input.id_pregunta').val();
        var letra = $(this).html();
        Ahorcado.buscar_letra_en_respuesta(id_pregunta,letra,$(this));
    });

    $('body').on('click','.nuevo_intento_ahorcado',function () {
        $('.respuesta').find('input.repuesta_letras').val('');
        $('.teclado_ahorcado').find('.letra_teclado_ahorcado').removeAttr('disabled');
        $('.teclado_ahorcado').find('.letra_teclado_ahorcado').removeClass('btn-success btn-danger');
        $('.teclado_ahorcado').find('.letra_teclado_ahorcado').addClass('btn-default');
        $('#form_juego_ahorcado').find('span.numero_intentos').html(7);
        var imagen_html = '<img class="img-responsive" src="'+base_url+'extras/imagenes/Ahorcado/01base.png">';
        $('div.imagen_ahorcado').html(imagen_html);
        $('.opciones_ahorcado').html('');
    });

});

var Ahorcado = {

    buscar_letra_en_respuesta : function (id_pregunta,letra,boton) {
        var numero_intentos = parseInt($('#form_juego_ahorcado').find('span.numero_intentos').html());
        if(numero_intentos >= 1){
            $.ajax({
                type : "POST",
                url  : base_url+"Ahorcado/jugar_ahorcado",
                data : {id_pregunta:id_pregunta,letra:letra,numero_intentos:numero_intentos},
                success: function(data){
                    if(data.correcta == true){
                        Ahorcado.agregar_letras_corectas(data.letra_mayus);
                        var numero_letras_respuesta = $('.respuesta').find('input.repuesta_letras').length;
                        var numero_letras_sin_valor = numero_letras_respuesta;
                        $('.respuesta').find('input.repuesta_letras').each(function () {
                            if($(this).val() != '')numero_letras_sin_valor--;
                        });
                        if(numero_letras_sin_valor == 0){
                            $('.teclado_ahorcado').find('.letra_teclado_ahorcado').attr('disabled',true);
                            var imagen_html = '<img class="img-responsive" src="'+base_url+'extras/imagenes/Ahorcado/munecoGanaste.png">';
                            $('div.imagen_ahorcado').html(imagen_html);
                            var opciones_ahorcado = '<button type="button" class="btn btn-info nuevo_intento_ahorcado">Otra vez</button>';
                            $('.opciones_ahorcado').html(opciones_ahorcado);
                        }
                    }else{
                        var imagen_html = '<img class="img-responsive" src="'+data.imagen+'">';
                        $('div.imagen_ahorcado').html(imagen_html);
                        numero_intentos--;
                    }
                    $('#form_juego_ahorcado').find('span.numero_intentos').html(numero_intentos);
                    if(numero_intentos == 0){
                        $('.teclado_ahorcado').find('.letra_teclado_ahorcado').attr('disabled',true);
                        var opciones_ahorcado = '<button type="button" class="btn btn-danger nuevo_intento_ahorcado">Nuevo intento</button>';
                        $('.opciones_ahorcado').html(opciones_ahorcado);
                    }
                    Ahorcado.actualizar_juego_ahorcado(boton,data.correcta);
                },
                error: function(e){
                    alert('ocurrio un error en el sistema, favor de reportarlo al área de sistemas');
                },
                complete: function(){},
                dataType: 'json'
            });
        }
    },

    actualizar_juego_ahorcado: function (boton, correcto) {
        boton.removeClass('btn-default');
        boton.attr('disabled', true);
        if (correcto) {
            boton.addClass('btn-success');
        }
        else boton.addClass('btn-danger');
    },

    agregar_letras_corectas : function (letra) {
        $('.respuesta').find('input.respuesta_letra_'+letra).val(letra);
    }

}