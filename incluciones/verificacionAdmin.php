<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 30/08/17
 * Time: 0:31
 */


session_start();
if(isset($_SESSION['usuario'])){
    $versionJs = rand();
    if($_SESSION['usuario']['admin'] == 1){
        $id = $_SESSION['usuario']['id'];
        $username = $_SESSION['usuario']['usuario'];
    }else{
        header('location: ../home.php');
    }
}else{
    session_destroy();
    header('location: ../index.php');
}

