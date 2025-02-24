
app.controller("adminPregunta", function ($scope, $http, $sce, $filter, $window) {
   
   $scope.listarPreguntasSinRespuesta = function(){
   		$http.post('../controladores/listarPreguntasAdminController.php', {sinRespuesta: false, desde: $scope.desde, limite: $scope.limite})
   		.success(function(response){
            $scope.preguntasSinRespuestas = response;
   		});
   }

   $scope.listarPreguntasConRespuesta = function(){
   		$http.post('../controladores/listarPreguntasAdminController.php', {sinRespuesta: true, desde: $scope.desdeConRespuesta, limite: $scope.limite})
   		.success(function(response){
   			$scope.preguntasConRespuestas = response;
   		});
   }
   $scope.divRespuesta = false;

   $scope.responderPregunta = function($id){
      $scope.divRespuesta = true;
      $scope.idPregunta = $id;
   }

   $scope.cerrarRespuestaForm = function(){
      $scope.divRespuesta = false;
      $scope.respuesta = null;

   }

   $scope.enviarRespuesta = function(){
      $scope.fechaRespuesta = new Date();
      $scope.fechaRespuesta = $filter('date')($scope.fechaRespuesta, 'yyyy-MM-dd HH:mm:ss');
      $http.post('../controladores/guardarRespuestaController.php', {'idPregunta':$scope.idPregunta, 'respuesta':$scope.respuesta, 'fecha':$scope.fechaRespuesta})
      .success(function(response){
         if (response.respuesta == 1) {
             alert('La pregunta se respondió exitosamente. Puede continuar respondiendo otras.');
             $window.location = 'preguntas.php';
         }
         else if (response.respuesta.respuesta == 2)
             alert('Falló el intento de responder la pregunta. Por favor vuelva a intentarlo mas tarde.');
         else if (response.respuesta.respuesta == 3)
             alert('Se introducieron valores erroneos!');
         else
             alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
      });

      $scope.respuesta = null;
      $scope.divRespuesta = false;
   }

   /**************** PAGINACION ***********************/
   $scope.desde = 0;
   $scope.desdeConRespuesta = 0;
   $scope.limite = 10;

   //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS
   $scope.cantidadDePaginacion = function(){
     $http.get('../controladores/contarCantidadPreguntasAdminController.php')
     .success(function(response){
        //Preguntas
        $scope.cantidadPreguntas = response.cantidad;
        resto = $scope.cantidadPreguntas % $scope.limite;
        $scope.numeroDePaginasPreguntas = ($scope.cantidadPreguntas - resto) / $scope.limite;
        if(resto > 0){
           $scope.numeroDePaginasPreguntas++;
        }
        arrayPaginasPreguntas = [];
        for(var i = 0; i<$scope.numeroDePaginasPreguntas; i++){
         arrayPaginasPreguntas.push((i+1));
        }
        $scope.paginacionesPreguntas = arrayPaginasPreguntas;

        //Respuestas
        $scope.cantidadPreguntasConRespuesta = response.cantidadConRespuesta;
        restoRespuestas = $scope.cantidadPreguntasConRespuesta % $scope.limite;
        $scope.numeroDePaginasRespuestas = ($scope.cantidadPreguntasConRespuesta - restoRespuestas) / $scope.limite;
        if(restoRespuestas > 0){
           $scope.numeroDePaginasRespuestas++;
        }
        arrayPaginasRespuestas = [];
        for(var i = 0; i<$scope.numeroDePaginasRespuestas; i++){
         arrayPaginasRespuestas.push((i+1));
        }
        $scope.paginacionesRespuestas = arrayPaginasRespuestas;
     });
   } 

   //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LA PAGINA SELECCIONADA
   //Pregunta
   $scope.buscarSegunPagina = function( desdePaginacion){
     $scope.desde = desdePaginacion*$scope.limite - $scope.limite;
     $scope.listarPreguntasSinRespuesta();
   }

   //Respuesta
   $scope.buscarSegunPaginaRespuesta = function( desdePaginacion){
      $scope.desdeConRespuesta = desdePaginacion*$scope.limite - $scope.limite;
      $scope.listarPreguntasConRespuesta();
    }

   //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LAS FLeCHAS PULSADAS (ADELANTE O ATRAS)
   //Preguntas
   $scope.cambiarPagina = function(direccion, categoria){
     if(direccion == 0){
        if($scope.desde > 0)
           $scope.desde = $scope.desde - $scope.limite;
     }else{
        cantidadMaxima = $scope.numeroDePaginasPreguntas * $scope.limite - $scope.limite;
        if($scope.desde < cantidadMaxima)
           $scope.desde = $scope.desde + $scope.limite;
     }
     $scope.listarPreguntasSinRespuesta();
   }

   //Respuestas
   $scope.cambiarPaginaRespuesta = function(direccion){
      if(direccion == 0){
         if($scope.desdeConRespuesta > 0)
            $scope.desdeConRespuesta = $scope.desdeConRespuesta - $scope.limite;
      }else{
         cantidadMaximaRespuesta = $scope.numeroDePaginasRespuestas * $scope.limite - $scope.limite;
         if($scope.desdeConRespuesta < cantidadMaximaRespuesta)
            $scope.desdeConRespuesta = $scope.desdeConRespuesta + $scope.limite;
      }
      $scope.listarPreguntasConRespuesta();
    }
   /****************** FIN PAGINACION */
});


