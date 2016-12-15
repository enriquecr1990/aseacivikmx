$(document).ready(function () {

    $('body').on('click','.siguiente_tab',function (e) {
        var tab_actual = $('.menu_wizard').find('li.active');
        var aplica_anterio = $(tab_actual).find('a').data('aplica_anterior');
        if(!aplica_anterio){
            $('button.anterior_tab').remove();
        }
        var time_button = $(tab_actual).find('a').data('time_button');
        $(tab_actual).hide();
        var tab_siguiente = $(tab_actual).find('a').data('siguiente');
        $(tab_siguiente).closest('li').show();
        $(tab_siguiente).trigger('click');
        $('button.siguiente_tab').hide();
        Wizard.boton_siguiente(time_button);
        console.log('tab actual'+$(tab_actual).find('a').html());
        console.log('tiempo '+time_button);
    });

    $('body').on('click','.anterior_tab',function (e) {
        var tab_actual = $('.menu_wizard').find('li.active');
        $(tab_actual).hide();
        var tab_anterio = $(tab_actual).find('a').data('anterior');
        $(tab_anterio).closest('li').show();
        $(tab_anterio).trigger('click');
    });

    Wizard.boton_siguiente(5000);

});

var Wizard = {

    boton_siguiente : function(time){
        $('button.siguiente_tab').delay(time).show(1500);
    }

}
