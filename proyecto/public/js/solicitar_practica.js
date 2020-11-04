$('document').ready(function(){
    $('#btnSolicitar').click(function(e){
        e.preventDefault();
        var fecha = $('#fecha').val();
        var hora =  $('#hora').val();
        var profesor = $('#selector').find(":selected").val();
        var nombreProfesor = $('#selector').find(":selected").text();

        let datos = {
            "cita":[]
        };

        let aux = {
            "fecha":fecha,
            "hora":hora,
            "profesor":profesor,
            "nombreProfesor":nombreProfesor
            }
        datos.cita.push(aux);
        $.ajax({
            type:'POST',
            url:'/solicitudPractica',
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
                        location.href = "http://aprendeyconduce.com/solicitarPracticas";
                    }, 2000);
            }
        });
    });
});