<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 16/10/17
 * Time: 12:12
 */

session_start();
if(isset($_SESSION['usuario'])){
    if($_SESSION['usuario']['admin'] == 0){
        header('location: ../index.php');
    }
}else{
    session_destroy();
    header('location: ../index.php');
}