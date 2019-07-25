<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 8/12/17
 * Time: 14:08
 */
session_start();

if(isset($_SESSION['usuario'])){
    $id = $_SESSION['usuario']['id'];
    // $username = $_SESSION['usuario']['username'];
    $email = $_SESSION['usuario']['email'];
    $nombre = $_SESSION['usuario']['nombre'];
    $apellido = $_SESSION['usuario']['apellido'];
    $admin = $_SESSION['usuario']['admin'];
}else{
    // session_destroy();
    $id = 0;
    $username = null;
    $email = null;
    $nombre = null;
    $apellido = null;
    $admin = null;
}
