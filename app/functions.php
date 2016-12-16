<?php

if (!function_exists('pretty_json')){
    function pretty_response($data){
        if(is_array($data)){
            return str_replace(['{','}',',"'],["{\n  " ,"\n}",",\n  \""],json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
        }else{
            return str_replace(['{','}',',"'],["{\n  " ,"\n}",",\n  \""],json_encode(json_decode($data),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
        }
    }
}