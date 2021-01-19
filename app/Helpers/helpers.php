<?php
if(!function_exists('active_class')){
    function active_class($url){
        $current_url = url()->current();
        if($url == $current_url){
            return 'active';
        }
    }
}

if (!function_exists('user')) {
    function user(){
        return auth()->user();
    }
}

// Recibe dos parámetros, la fecha y el formato deseado.
// Después verifica que la fecha no sea nulo, lo cual es requerido por nuestro sistema
// Si no es nulo, retorna la fecha formateada.
// En caso de ser nulo retorna un valor nulo.
if(!function_exists('carbon_format'))
{
    function carbon_format($date, $format = 'Y-m-d')
    {
        if(!is_null($date)){
            $date = \Carbon\Carbon::parse($date)->format($format);
            return $date;
        }else{
            return null;
        }
    }
}