<?php

function dd($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    die;
}
abstract class CiAppType{
    const SESSION = 'session';
    const DATABASE = 'database';
}
function get_ci_app_module_instance($argument = 'session' | 'database') {
    $CI =& get_instance();

    $instance = null;
    switch ($argument) {
        case 'session':
            $CI->load->library('session');
            $instance = $CI->session;
            break;
        case 'database':
            $CI->load->library('database');
            $instance = $CI->database;
            break;
        
        default:
            # code...
            break;
    }
    return $instance;
}