var desde = 0;
var desdeConRespuesta = 0;
var limite = 15;
var arrayPreguntaSinRespuesta = [];

app.controller("adminPregunta", function ($scope, $http, $sce, $filter, $window) {
   
   $scope.listarPreguntasSinRespuesta = function(){
   		$http.post('../controladores/listarPreguntasAdminController.php', {sinRespuesta: false, desde: desde, limite: limite})
   		.success(function(response){
            if(desde == 0){
               arrayPreguntaSinRespuesta = response;
               $scope.preguntasSinRespuestas = arrayPreguntaSinRespuesta;   
            }else{
               arrayPreguntaSinRespuesta = arrayPreguntaSinRespuesta.concat(response);
               $scope.preguntasSinRespuestas = arrayPreguntaSinRespuesta;
            }
   		});
   }

   $scope.listarPreguntasConRespuesta = function(){
   		$http.post('../controladores/listarPreguntasAdminController.php', {sinRespuesta: true, desde: desdeConRespuesta, limite: limite})
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

   $scope.traerMasPreguntasSinRespuesta = function(){
      desde = desde + limite;
   }
});


