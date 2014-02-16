<?php

$map = array(
    __DIR__.'/app',
     __DIR__.'/src',
    __DIR__.'/tests',
    __DIR__.'/web',
);
// your autoloader
$funct = function($className) use ($map){
    //if(!isInCache($className)):
        $path = str_replace('_', '/', $className);
        $path = str_replace('\\', '/', $path);
        foreach($map as $dir) :
            if(file_exists($dir.'/'.$path. '.php')):
                require_once($dir.'/'.$path . '.php');
            endif;
        endforeach;
        //addToCache($className);
    //endif;
};

spl_autoload_register($funct);

function isInCache($class){
    $map2=array();
    $chaine= file_get_contents('cache.php');
    if(!empty($chaine)) :
        $map2 = explode(' ',$chaine);
        $ret = array_search($class,$map2);
        if($ret == false) :
            return false;
        else :
            return true;
        endif;
    endif;
    return false;
}

function addToCache($class){
    $fp = fopen ("cache.php", "r+");
    fseek ($fp, 0 , SEEK_END );
    fputs ($fp, $class);
    fseek ($fp, 0 , SEEK_END );
    fputs ($fp, ' ');
    fclose ($fp);

}