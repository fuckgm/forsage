<?php

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
       $name = trim($parts[0]);
    if($name!='country'){
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
    }
}
   
    
   echo '<script> window.location.replace("/"); </script>';
  header("Location: /");