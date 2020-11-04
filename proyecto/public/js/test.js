$('document').ready(function(){
    var aciertos = 0;
    var aprobado = 0;
    var textoAprobado = 'suspendido';
    var fallos;
    var insertarDatos = {
        "datos":[]
    };
    $('#btnCorregir').click(function(){
        let inputsRadio = $("input[type='radio']");
        let datos = {
            "respuestas":[]
        };
        var aux = -1;
        for (let i = 0; i < inputsRadio.length; i++) {
            if(inputsRadio[i].checked){
                let aux = {
                    "id":inputsRadio[i].name,
                    "valor":inputsRadio[i].value
                }
                datos.respuestas.push(aux);
            }
        }
        if(datos.respuestas.length == 10){
            $.ajax({
                type:'POST',
                url:'/testValidar',
                dataType: 'json',
                data:datos,
                success:function(data){
                    inputsRadio.attr('disabled' , 'disabled');
                    for (let i = 0; i < datos.respuestas.length; i++) {
                        if(datos.respuestas[i].id == data[i].id){
                            aux = datos.respuestas[i].valor;
                            aux1 = data[i].valor;
                            if(data[i].correcta){
                                $('#miId'+ i +' div:nth-child('+aux+')').css("background-color","#4eb43d");
                                aciertos++;
                            }
                            else{
                                $('#miId'+i +' div:nth-child('+aux+')').css("background-color","#d83830");
                                $('#miId'+i +' div:nth-child('+aux1+')').css("background-color","#4eb43d");
                            }
                        }
                    }
                    if(aciertos >= 8){
                        aprobado = 1;
                    }
                    if(aciertos >= 8)
                    {
                        textoAprobado = 'aprobado';
                    }
                    fallos = 10 - aciertos;
                    let aux3 = {
                        "aciertos":aciertos,
                        "aprobado":aprobado
                    }
                    insertarDatos.datos.push(aux3);
                    $.ajax({
                        type:'POST',
                        url:'/insertarDatos',
                        dataType: 'json',
                        data:insertarDatos,
                        success:function(data){
                            
                        }
                    });  
                }
            });
            $('#corregir').addClass('d-none');
            $('#btnCancelar').addClass('d-none');
            $('#btnEstadisticas').removeClass('d-none');
        }else{
            alert("Seleccione una respuesta para cada pregunta por favor");
        }
    });
    $('#btnEstadisticas').click(function(){
        $('#bodyEstadisticas').html('Has '+textoAprobado+'! <br/><br/> Has tenido '+ aciertos + ' aciertos <br/><br/> Has fallado un total de '+ fallos + ' veces <br/><br/> Recuerda que para aprobar tienes que acertar al menos 8 respuestas.');
    });
    $('#btnSalir').click(function(){
        location.href = "http://aprendeyconduce.com/inicio";
    });
    $('#btnVolver').click(function(){
        location.href = "http://aprendeyconduce.com/tests";
    });
    $('#btnCancelar').click(function(){
        $('input[type="radio"]').prop('checked',false);
    });
});