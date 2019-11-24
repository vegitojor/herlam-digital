var _urlServer = '';

var app = angular.module("index", []);

app.controller("indexCambioPass", function ($scope, $http, $filter, $window){
	$scope.cambiarPass = function(valid){
        if(valid){
            let url = '../controladores';
            let ruta = window.location.pathname.search('/home.php');
            if(ruta >= 0)
                url = './controladores';

            url += '/cambioPassController.php';

            $http.post(url, {
                'pass': $scope.pass,
                'newPass': $scope.newPass,
                'id': $scope.usuario.id
            })
            .success(function(response){
                $('#passModal').modal('hide');
                $scope.pass = '';
                $scope.newPass = '';
                $scope.passValid = '';
                if(response.respuesta == 1){
                    bootbox.alert('La contraseña se ha cambiado con exito. Le será requerida en su proximo login.');
                }else{
                    bootbox.alert('Los datos ingresados no son correctos.');
                }
            })
            .error(function(error){
                console.log('fallo el cambio de pass', error);
            })
        }else{
            bootbox.alert('El formulario no es válido. Algunos datos requeridos pueden no estar presentes.');
        }
    }
    
    $scope.obtenerUsuarioParaPass = function(array){
        $scope.usuario = array;
    }
});

app.directive('passChangeCheck', [function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ctrl) {
        var firstPassword = '#' + attrs.passChangeCheck;
        elem.add(firstPassword).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(firstPassword).val();
            ctrl.$setValidity('pwchangematch', v);
          });
        }); 
      }
    }
  }]);