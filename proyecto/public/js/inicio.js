$('document').ready(function(){
    var cambia = 0;
    $('#btnCambiarFuente').click(function()
    {
        if(cambia == 0)
        {
            $('html').css('font-size','25px');
            cambia = 1;
        }
        else
        {
            $('html').css('font-size','20px');
            cambia = 0;
        }
    });
    $('#btnCerrarCovid').click(function()
    {
        $('#divCovid').remove();
    });
    $('#btnAlumnos').click(function()
    {
        location.href = "http://aprendeyconduce.com/listaAlumnos";
    });
    $('#btnProfesor').click(function()
    {
        location.href = "http://aprendeyconduce.com/listaProfesores";
    });
    $('#btnEnviarAlumnos').click(function()
    {   
        $.ajax({
            type:'POST',
            url:'/enviarAlumnos',
            dataType: 'json',
            data:datos,
            success:function(data){
                var address = '';
                for (let i = 0; i < data.length; i++) {
                    address = address + ','+ data[i].correo;
                }
                window.location.href = 'mailto:' + address+"?subject=Prueba Circular&body=mensaje de prueba a todos los alumnos de la plataforma";
            }
        });
    });
    $('#btnEnviarProfesores').click(function()
    {   
        $.ajax({
            type:'POST',
            url:'/enviarProfesores',
            dataType: 'json',
            data:datos,
            success:function(data){
                var address = '';
                for (let i = 0; i < data.length; i++) {
                    address = address + ','+ data[i].correo;
                }
                window.location.href = 'mailto:' + address+"?subject=Prueba Circular&body=mensaje de prueba a todos los profesores de la plataforma";
            }
        });
    });

});