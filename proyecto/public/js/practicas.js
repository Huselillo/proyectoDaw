$('document').ready(function(){
    $('input:button').click(function(){
            var idPractica = $(this).parents("tr").find(".valor").html();
            var accion = $(this).attr('name');
            if(accion == 'realizar')
            {
                var idPractica = $(this).parents("tr").find(".valor").html();
                var idUsuario = $(this).parents("tr").find(".valorUsuario").html();
                let datos = {
                    "datos":[]
                };
                let aux = {
                    "idPractica":idPractica,
                    "idUsuario":idUsuario
                }
                datos.datos.push(aux);
                console.table(datos);
                $.ajax({
                    type:'POST',
                    url:'/realizarPractica',
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
                            location.href = "http://aprendeyconduce.com/practicas";
                        }, 2000);
                    }
                });
            }
            else
            {
                let datos = {
                    "datos":[]
                };
                let aux = {
                    "idPractica":idPractica,
                    "accion":accion
                }
                    datos.datos.push(aux);
                    $.ajax({
                        type:'POST',
                        url:'/confirmarPractica',
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
                                location.href = "http://aprendeyconduce.com/practicas";
                            }, 2000);
                        }
                    });
            }
    });
});