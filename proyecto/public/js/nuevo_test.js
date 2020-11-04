let inputsCheckbox = $("input[type='checkbox']");
let datos = {
    "preguntas":[]
};
var selectTipo = $('#tipoTest option:selected').val();
var contador = 10;
$('#contador1').html(contador + ' preguntas ');
inputsCheckbox.on('change',function(){
    if( $(this).is(':checked') ) {
        contador--;
        if(contador <= 0)
        {
            $('#contador').hide();
        }
        else if(contador < 2)
        {
            $('#contador1').html(contador + ' pregunta ');
        }
        else
        {
            $('#contador1').html(contador + ' preguntas ');
        }
        let aux = {
            "id":$(this).val(),
            }
            datos.preguntas.push(aux);
    }else{
        for (let i = 0; i < datos.preguntas.length; i++) {
            if(datos.preguntas[i].id == $(this).val()){
                datos.preguntas.splice(i,1);
            }
        }
        contador++;
        if(contador == 1)
        {
            $('#contador').show();
        }
        else if(contador >= 2)
        {
            $('#contador1').html(contador + ' preguntas ');
        }
        else
        {
            $('#contador1').html(contador + ' pregunta ');
        }
    }
})
$('#btnCrear').click(function(){
    if(datos.preguntas.length == 10){
        inputsCheckbox.attr('disabled' , 'disabled');
        var selectTipo = $('#tipoTest option:selected').val();
        let aux = {
            "tipo":selectTipo,
            }
        datos.preguntas.push(aux);
        $.ajax({
            type:'POST',
            url:'/crearTest',
            dataType: 'json',
            data:datos,
            success:function(data){
                    toastr.success(data.message, data.title);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    setTimeout(function(){
                        location.href = "http://aprendeyconduce.com/nuevo/test";
                    }, 2000);
                
        }
        });
    }
    else if(datos.preguntas.length <= 9)
    {
        alert("Por favor seleccione 10 preguntas");
    }
    else
    {
        alert("Seleccione sólo 10 preguntas por favor");
    }
});
$('#btnCancelar').click(function(){
    $('input[type="checkbox"]').prop('checked',false);
    contador = 10;
    datos = {
        "preguntas":[]
    }
    $('#contador1').html(contador + ' preguntas ');
});
