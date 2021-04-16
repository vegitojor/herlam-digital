$(document).ready(function(){
    $("#submit").click(function(){
        let mail = $("#mail").val();
        let pass = $("#pass").val();
        let userAgent = window.navigator.userAgent

        if(mail != undefined && mail != '' && pass != undefined && pass != ''){
            $.ajax({
                url: 'controladores/loginController.php',
                type:'post',
                data: JSON.stringify( {'email': mail, 'pass': pass, 'userAgent': userAgent}),
                contentType:'application/json' 
            })
            .success(function(response){
                response = JSON.parse(response);
                if(response.respuesta == 1){
                    if(response.admin == 1){
                        window.location.href = "vistas/admin-home.php";
                    }else {
                        window.location.href = "home.php";	
                    }
                }else if(response.respuesta == 0){
                    bootbox.alert("El email o la contraseña son incorrectos.");
                }else{
                    bootbox.alert("Ha ocurrido un error con la conexion a la base de datos. Por favor vuelva a intenter iniciar sesión.");
                }
            })
        }
        return false;  
    })
})