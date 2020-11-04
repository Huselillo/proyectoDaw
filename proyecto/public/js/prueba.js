for (let i = 0; i < datos.respuestas.length; i++) {
    if(datos.respuestas[i].id == data[i].id){
        aux = datos.respuestas[i].valor;
        console.log(aux);
            if(data[i].correcta){
                $('#miId'+ i +' div:nth-child('+aux+')').css("background-color","green");
            }
            else{
                $('#miId'+i +' div:nth-child('+aux+')').css("background-color","red");
            }
        }
}