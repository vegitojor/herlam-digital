app.controller("adminCategoriaController", function ($scope, $http, $sce, $filter, $window) {
    

    $scope.notificacionesEnviadas = []

    $scope.listarNotificacionesEnviadas = function(){
        $http.post('../controladores/listarNotificacionesEnviadasController.php', {'desde': $scope.desde, 'limite': $scope.limite})
            .success(function (response) {
                $scope.notificacionesEnviadas = response
                $scope.cantidadDePaginacion();
            });
    }

    $scope.mostrarModal = function(notificacion){
        $scope.mensaje = $sce.trustAsHtml(notificacion.mensaje)
        $scope.notificacionModal = notificacion
        document.getElementById('mensajeModal').style.display='block';
    }

    $scope.mostrarModalBusquedaDeGrupos = function(){
        // $scope.mensaje = $sce.trustAsHtml(notificacion.mensaje)
        // $scope.notificacionModal = notificacion
        document.getElementById('busquedaDeGrupos').style.display='block';
    }

    $scope.cerrarModal = function(pedido){
        $scope.mostrarDestinatarios = false
        document.getElementById('mensajeModal').style.display='none';
    }
    

    $scope.cerrarModalBusquedaDeGrupos = function(){
        // $scope.mostrarDestinatarios = false
        document.getElementById('busquedaDeGrupos').style.display='none';
    }

    $scope.enviarMail = function(){
        $scope.editor = CKEDITOR.instances.mensajeNotificaciones
        console.log($scope.editor.getData())
        console.log($scope.asunto)

        $scope.fechaActual = new Date();
		$scope.fechaActual = $filter('date')($scope.fechaActual, 'yyyy-MM-dd HH:mm:ss');

        $scope.notificacionData = {
            destino: $scope.destino == undefined ? null : $scope.destino,
            asunto: $scope.asunto,
            mensaje: String($scope.editor.getData()),
            fecha: $scope.fechaActual
        }

        if($scope.notificacionData.mensaje != undefined && $scope.notificacionData.mensaje != null && $scope.notificacionData.mensaje != ""){
            if($scope.notificacionData.destino == null){
                if(confirm("Esta por enviar un mensaje a TODOS los contactos. ¿Desea continuar?"))
                    $scope.postMail()
            }else{
                $scope.postMail()
            }
        }
        else
            alert('Verifique el contenido del mensaje antes de continuar.');
    }

    $scope.postMail = function(){
        $http.post('../controladores/enviarNotificacionController.php', $scope.notificacionData)
            .success(function (response) {
                $scope.respuesta = response;

                if($scope.respuesta.mensaje == 1){
                    alert('El mail se envio satisfactoriamente.');
                    $window.location.reload();
                }
                else
                    alert('Ocurrio un error al enviar un mensaje.');
            });
    }

    $scope.mostrarDestinatarios = false
    $scope.mostrarOcultarDestinatarios = function(){
        $scope.mostrarDestinatarios = !$scope.mostrarDestinatarios
    }


    


      /**************** PAGINACION ***********************/
      $scope.desde = 0;
      $scope.limite = 9;
      $scope.claseActive = {'w3-green': true};
  
      //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS
      $scope.cantidadDePaginacion = function(){
          $http.post('../controladores/contarNotificacionController.php')
          .success(function(response){
              $scope.cantidadProductos = response.cantidad;
              resto = $scope.cantidadProductos % $scope.limite;
              $scope.numeroDePaginas = ($scope.cantidadProductos - resto) / $scope.limite;
              if(resto > 0){
                  $scope.numeroDePaginas++;
              }
              array = [];
              for(var i = 0; i<$scope.numeroDePaginas; i++){
                  array.push((i+1));
              }
              $scope.paginaciones = array;
          });
      } 
  
  
  
      //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LA PAGINA SELECCIONADA
      $scope.buscarSegunPagina = function( desdePaginacion){
          $scope.desde = desdePaginacion*$scope.limite - $scope.limite;
          $scope.listarNotificacionesEnviadas();
      }
  
      //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LAS FLACHAS PULSADAS (ADELANTE O ATRAS)
      $scope.cambiarPagina = function(direccion, categoria){
          if(direccion == 0){
              if($scope.desde > 0)
                  $scope.desde = $scope.desde - $scope.limite;
          }else{
              cantidadMaxima = $scope.numeroDePaginas * $scope.limite - $scope.limite;
              if($scope.desde < cantidadMaxima)
                  $scope.desde = $scope.desde + $scope.limite;
          }
          $scope.listarNotificacionesEnviadas();
      }
      /****************** FIN PAGINACION */


    //Carga de Editor
    $scope.editor
    $scope.cargarEditor = function(){
        CKEDITOR.replace(document.querySelector( '#mensajeNotificaciones'), {
            toolbar: toolbarArray,
            language: 'es'
        })
    }


    //CONSTANTES PARA CKEDITOR - CONFIG
    const fontColorConfig = {
        colors: [
            {
                color: 'hsl(0, 0%, 0%)',
                label: 'Black'
            },
            {
                color: 'hsl(0, 0%, 30%)',
                label: 'Dim grey'
            },
            {
                color: 'hsl(0, 0%, 60%)',
                label: 'Grey'
            },
            {
                color: 'hsl(0, 0%, 90%)',
                label: 'Light grey'
            },
            {
                color: 'hsl(0, 0%, 100%)',
                label: 'White',
                hasBorder: true
            },
            {
                color: 'hsl(0, 75%, 60%)',
                label: 'Red'
            },
            {
                color: 'hsl(30, 75%, 60%)',
                label: 'Orange'
            },
            {
                color: 'hsl(60, 75%, 60%)',
                label: 'Yellow'
            },
            {
                color: 'hsl(90, 75%, 60%)',
                label: 'Light green'
            },
            {
                color: 'hsl(120, 75%, 60%)',
                label: 'Green'
            },
            {
                color: 'hsl(150, 75%, 60%)',
                label: 'Aquamarine'
            },
            {
                color: 'hsl(180, 75%, 60%)',
                label: 'Turquoise'
            },
            {
                color: 'hsl(210, 75%, 60%)',
                label: 'Light blue'
            },
            {
                color: 'hsl(240, 75%, 60%)',
                label: 'Blue'
            },
            {
                color: 'hsl(270, 75%, 60%)',
                label: 'Purple'
            }
        ]
    };

    const fontFamilyConfig = {
        options: [
            'default',
            'Arial, Helvetica, sans-serif',
            'Courier New, Courier, monospace',
            'Georgia, serif',
            'Lucida Sans Unicode, Lucida Grande, sans-serif',
            'Tahoma, Geneva, sans-serif',
            'Times New Roman, Times, serif',
            'Trebuchet MS, Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif'
        ]
    };

    const toolbarArray = [
        { 
            name: 'basicstyles', 
            groups: [ 'basicstyles', 'cleanup' ], 
            items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] 
        },
        { 
            name: 'paragraph', 
            groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], 
            items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] 
        },
        { 
            name: 'links', 
            items: [ 'Link', 'Unlink' ] 
        },
        { 
            name: 'insert', 
            items: [ 'Image', 'FontAwesome', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] 
        },
        { 
            name: 'clipboard', 
            groups: [ 'clipboard', 'undo' ], 
            items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] 
        },
        { 
            name: 'editing', 
            groups: [ 'selection', 'spellchecker' ], 
            items: [  'SelectAll', '-', 'Scayt' ] 
        },
        '/',
        { 
            name: 'styles', 
            items: [ 'Styles', 'Format', 'Font', 'FontSize' ] 
        },
        { 
            name: 'colors', 
            items: [ 'TextColor', 'BGColor' ] 
        }
    ]
})