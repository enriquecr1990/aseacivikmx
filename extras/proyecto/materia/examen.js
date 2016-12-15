$(document).ready(function () {

    $('body').on('change','.tipo_pregunta', function (e) {
        var valor_tipo_pregunta = $(this).val();
        if(valor_tipo_pregunta == ''){ //opcion seleccione
            $('div.opcion_vf').hide();
            $('div.opcion_unica').hide();
            $('div.opcion_multiple').hide();
        }if(valor_tipo_pregunta == 1){ //opcion vf
            $('div.opcion_vf').show();
            $('div.opcion_unica').hide();
            $('div.opcion_multiple').hide();
        }if(valor_tipo_pregunta == 2){ //opcion unica
            $('div.opcion_vf').hide();
            $('div.opcion_unica').show();
            $('div.opcion_multiple').hide();
        }if(valor_tipo_pregunta == 3){ //opcion multiple
            $('div.opcion_vf').hide();
            $('div.opcion_unica').hide();
            $('div.opcion_multiple').show();
        }
    });

});
