app.controller("adminCategoriaController", function ($scope, $http, $sce, $filter) {
    

    //Carga de Editor
    $scope.editor
    $scope.cargarEditor = function(){
        CKEDITOR.replace(document.querySelector( '#mensajeNotificaciones'), {
            toolbar: toolbarArray,
            language: 'es'
        })
    }

    $scope.enviarMail = function(){
        $scope.editor = CKEDITOR.instances.mensajeNotificaciones
        console.log($scope.editor.getData())
        console.log($scope.asunto)

        $scope.fechaActual = new Date();
		$scope.fechaActual = $filter('date')($scope.fechaActual, 'yyyy-MM-dd HH:mm:ss');

        $scope.notificacionData = {
            destino: null,
            asunto: $scope.asunto,
            mensaje: String($scope.editor.getData()),
            fecha: $scope.fechaActual
        }

        $http.post('../controladores/enviarNotificacionController.php', $scope.notificacionData)
            .success(function (response) {
                $scope.respuesta = response;

                if($scope.respuesta.mensaje == 1)
                    alert('El mail se envio satisfactoriamente.');
                else
                    alert('Ocurrio un error al enviar un mensaje.');

                // $scope.cerrarCargaCategoria();
                // $scope.descripcion = "";
                // $scope.fichaTecnica = "";
                // $scope.listarCategorias();
            });

        $scope.mensajeEnviado = $sce.trustAsHtml($scope.notificacionData.mensaje)
        $scope.mensajeControl = "Hola mundo"
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