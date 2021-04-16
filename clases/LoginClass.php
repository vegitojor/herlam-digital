<?php

class Login
{
    
    public static function registrarLogin($conexcion, $id_cliente, $fecha, $time, $userAgent){
        $consulta  = "INSERT INTO login (id_cliente, fecha, fecha_timestamp, user_agent) 
                        VALUEs (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexcion, $consulta);
        mysqli_stmt_bind_param($stmt, 'isis', $id_cliente, $fecha, $time, $userAgent);
        mysqli_stmt_execute($stmt);

        //se obtiene el id autogenerado y se retorna el valor
        $id = mysqli_insert_id($conexcion);
        return $id;

    }


}