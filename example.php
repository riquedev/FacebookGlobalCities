<?php

header('Content-Type: application/json');

require_once(realpath(dirname(__FILE__)) . '/GlobalCities.php');

// Local a ser procurado
$search = 'New York';


$Global = new rqdev\Facebook\utils\GlobalCities();

$Global->setLocale('pt-br') // Sub-domain
        ->setUseHttps(true) // Usar Https
        ->setUse_unicorn(true)
        ->setValue($search)
        ->Search(); // Faz requisição.

$Cidades = $Global->GetCities(); // Obtem objeto
$prettyJson = true;
$Json = $Cidades->toJson($prettyJson); // Em Json
$Array = $Cidades->toArray(); // Em Array
$Object = $Cidades->toObject(); // Em Object

echo $Json;
