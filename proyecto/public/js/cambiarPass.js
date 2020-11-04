$('document').ready(function(){
    $('#btnCambiar').click(function(){
        var expresion = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        var contraseña1 = $('#pass1').val();
        var contraseña2 = $('#pass2').val();
        if(expresion.test(contraseña1) && expresion.test(contraseña2))
        {
            let datos = {
                "datos":[]
            };
            let aux = {
                "pass1":$('#pass1').val(),
                "pass2":$('#pass2').val()
            }
            datos.datos.push(aux);
            $.ajax({
                type:'POST',
                url:'/cambiarPass',
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
                        location.href = "http://aprendeyconduce.com/perfil";
                    }, 1500);
                }
            });
        }
        else
        {
            alert("La contraseña debe tener al menos 8 caracteres y una letra");
        }
    });
});