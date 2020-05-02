<?php

function startsWith($string, $startString) { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

$request = $_SERVER['REQUEST_URI'];

if(startsWith($request, '/PHPComposerDoctrine/Entities')){
    require __DIR__ . '/src/views/entities.php';
} elseif (startsWith($request, '/PHPComposerDoctrine/Relations')){
    require __DIR__ . '/src/views/relations.php';
} elseif (startsWith($request, '/PHPComposerDoctrine/')){
    print('
        <a href="Entities">Go to ORM ENTITIES examples</a><br>
        <a href="Relations">Go to ORM RELATIONS examples</a><br>
        <a href="About">Go to ABOUT page</a>
    ');
} else {
    http_response_code(404);
    print('<p>Path not found</p>');
}