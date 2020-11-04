$('document').ready(function(){
    $('#btnEditar').click(function(){
        $('#btnGuardar').removeClass('d-none');
        $('#btnEditar').addClass('d-none');
        $('#nombre').prop('disabled',false);
        $('#apellido').prop('disabled',false);
        $('#correo').prop('disabled',false);
        $('#usuario').prop('disabled',false);
    });
    $('#btnGuardar').click(function(){
        let datos = {
            "datos":[]
        };
        $('#btnGuardar').addClass('d-none');
        $('#btnEditar').removeClass('d-none');
        $('#nombre').prop('disabled',true);
        $('#apellido').prop('disabled',true);
        $('#correo').prop('disabled',true);
        $('#usuario').prop('disabled',true);
        let aux = {
            "nombre":$('#nombre').val(),
            "apellido":$('#apellido').val(),
            "correo":$('#correo').val(),
            "usuario":$('#usuario').val()
            }
            datos.datos.push(aux);
        $.ajax({
            type:'POST',
            url:'/actualizarPerfil',
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
            }
        });
    });
});