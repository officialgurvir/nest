<?php

function print_array(array $array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function write($msg): void
{
   echo $msg;
}

function concat(...$strings) {
    $stringConcated = "";

    foreach ($strings as $stringToCat) {
        $stringConcated .= $stringToCat;
    }

    return $stringConcated;
}

/**
 * Dump variables and die.
 */
if ( ! function_exists('dd') ) {

   function dd() {
      call_user_func_array( 'dump' , func_get_args() );
      die();
   }

}

function csrf_token() {
    $token = md5(uniqid(rand(), true));
    $_SESSION['csrf_token'] = $token;

    return $token;
}