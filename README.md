# FacebookGlobalCities
[![Build Status](https://travis-ci.org/riquedev/FacebookGlobalCities.svg?branch=master)](https://travis-ci.org/riquedev/FacebookGlobalCities)

Obtenha ID, Nome, Latitude, Longitude de determinado local a partir do próprio Facebook.

## Uso
Com os dados fornecidos pela requisição é possível obter dados de determinados locais a partir de sua ID no Facebook.

## Como usar
```php
<?php
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

?>
```

