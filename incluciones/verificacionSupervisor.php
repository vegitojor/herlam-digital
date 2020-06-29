<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 30/08/17
 * Time: 0:31
 */

 include_once('../incluciones/versionRand.php');

session_start();
if(isset($_SESSION['usuario'])){
    // $versionJs = rand();
    if($_SESSION['usuario']['supervisor'] == 1){
        $id = $_SESSION['usuario']['id'];
        $nombre = $_SESSION['usuario']['usuario'];
        $usuarioArray = $_SESSION['usuario'];
    }else{
        header('location: ../home.php');
    }
}else{
    session_destroy();
    header('location: ../index.php');
}

