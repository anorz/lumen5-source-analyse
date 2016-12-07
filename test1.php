<?php

/**
 * class_name to ClassMame
 */
$str = 'show_time_a';

$new = ucfirst(preg_replace_callback('/_([a-zA-Z])/',function($match){
    return strtoupper($match[1]);
},$str));
echo $new.PHP_EOL;


/**
 * ClassMame to class_name
 */
$str = 'ShowTimeA';
$new = strtolower(trim(preg_replace('/[A-Z]/','_\\0',$str),'_'));
echo $new;
