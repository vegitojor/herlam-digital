<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 30/08/17
 * Time: 0:31
 */


session_start();
if(isset($_SESSION['usuario'])){
    if($_SESSION['usuario']['admin'] == 1){
        $id = $_SESSION['usuario']['id'];
        $username = $_SESSION['usuario']['username'];
    }else{
        header('location: ../index.php');
    }
}else{
    session_destroy();
    header('location: ../index.php');
}

