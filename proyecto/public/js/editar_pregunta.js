$('document').ready(function(){
    $('#btnEditarPregunta').click(function(e){
        e.preventDefault();
        $('#formEditarPregunta').submit();
    });
    $('#formEditarPregunta').submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log($(this)[0]);
        datos.img = formData;
        $.ajax({
            type:'POST',
            url:'/edicionPregunta',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data:formData,
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
                    location.href = "http://aprendeyconduce.com/preguntas";
                }, 1500);
            }
        });
    });
});