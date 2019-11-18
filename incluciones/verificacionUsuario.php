<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 8/12/17
 * Time: 14:08
 */


session_start();

if(isset($_SESSION['usuario']) ){
    if($_SESSION['usuario']['activo'] == 1){
        // $versionJs = rand();
        $id = $_SESSION['usuario']['id'];
        // $username = $_SESSION['usuario']['username'];
        $email = $_SESSION['usuario']['email'];
        $nombre = $_SESSION['usuario']['nombre'];
        $apellido = $_SESSION['usuario']['apellido'];
        $admin = $_SESSION['usuario']['admin'];
        $usuarioArray = $_SESSION['usuario'];

        if($_SESSION['usuario']['admin'] == 1){
            $url= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/';
            if($_SERVER['SERVER_NAME'] == 'localhost'){
                $url = $url . 'herlam-digital/';
            }
            $url .= 'vistas/admin-home.php';
            header('location: ' . $url);
        }else if($_SESSION['usuario']['supervisor']==1){
            // $url= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/';
            // if($_SERVER['SERVER_NAME'] == 'localhost'){
            //     $url = $url . 'herlam-digital/';
            // }
            $url = 'vistas/supervisor-home.php';
            header('location: ' . $url);
        }
    }else{
        session_destroy();
        $url= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/';
        // var_dump($_SERVER);
        if($_SERVER['SERVER_NAME'] == 'localhost'){
            $url = $url . 'herlam-digital/';
        }

        $url .= 'index2.php';

        header('location: ' . $url);
    }

    
}else{
    session_destroy();
    $url= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/';
    // var_dump($_SERVER);
    if($_SERVER['SERVER_NAME'] == 'localhost'){
        $url = $url . 'herlam-digital/';
    }

    $url .= 'index.php';

    header('location: ' . $url);

}
