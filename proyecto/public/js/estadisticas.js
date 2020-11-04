$('document').ready(function(){
    $.ajax({
        type:'POST',
        url:'/estadisticas',
        dataType: 'json',
        data:datos,
        success:function(data){
            var testRealizados = $('#testRealizados');
            var testAprobados = $('#testAprobados');
            var fallosTotales = $('#fallosTotales');
            var aciertosTotales = $('#aciertosTotales');
            var practicasRealizadas = $('#practicasRealizadas');
            var fallos = (data[0].testRealizados * 10) - data[0].aciertosTotales;
            console.log(data);
            
            testRealizados.text(data[0].testRealizados);
            testAprobados.text(data[0].testAprobados);
            aciertosTotales.text(data[0].aciertosTotales);
            fallosTotales.text(fallos);
            practicasRealizadas.text(data[0].practicasRealizadas);
        }
    });
});