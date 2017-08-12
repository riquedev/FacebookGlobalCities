# FacebookGlobalCities
[![Build Status](https://travis-ci.org/riquedev/FacebookGlobalCities.svg?branch=master)](https://travis-ci.org/riquedev/FacebookGlobalCities)

Obtenha ID, Nome, Latitude, Longitude de determinado local a partir do próprio Facebook.

## Requisitos
* PHP 7.0 ou superior.

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


## Retorno JSON
```json
[
    {
        "city_id": 2490299,
        "city_local_name": "Nova Iorque, New York, Estados Unidos",
        "latitude": 40.7142,
        "longitude": -74.0064,
        "text": "Nova Iorque, New York, Estados Unidos",
        "uid": 108424279189115
    },
    {
        "city_id": 2429126,
        "city_local_name": "New York, Florida, Estados Unidos",
        "latitude": 30.8383,
        "longitude": -87.2008,
        "text": "New York, Florida, Estados Unidos",
        "uid": 106578779375574
    },
    {
        "city_id": 2487397,
        "city_local_name": "Bronx, New York, Estados Unidos",
        "latitude": 40.85,
        "longitude": -73.8667,
        "text": "Bronx, New York, Estados Unidos",
        "uid": 106325172737569
    },
    {
        "city_id": 2491013,
        "city_local_name": "Nova Iorque, New York, Estados Unidos",
        "latitude": 40.7042,
        "longitude": -73.9178,
        "text": "Nova Iorque, New York, Estados Unidos",
        "uid": 110521052305522
    },
    {
        "city_id": 2487404,
        "city_local_name": "Nova Iorque, New York, Estados Unidos",
        "latitude": 40.65,
        "longitude": -73.95,
        "text": "Nova Iorque, New York, Estados Unidos",
        "uid": 112111905481230
    },
    {
        "city_id": 2487444,
        "city_local_name": "Buffalo, New York, Estados Unidos",
        "latitude": 42.9047,
        "longitude": -78.8494,
        "text": "Buffalo, New York, Estados Unidos",
        "uid": 109324835754083
    },
    {
        "city_id": 2703980,
        "city_local_name": "Nova Iorque, New York, Estados Unidos",
        "latitude": 40.7779,
        "longitude": -73.9675,
        "text": "Nova Iorque, New York, Estados Unidos",
        "uid": 110334498996314
    },
    {
        "city_id": 2491158,
        "city_local_name": "Rochester, New York, Estados Unidos",
        "latitude": 43.1655,
        "longitude": -77.6115,
        "text": "Rochester, New York, Estados Unidos",
        "uid": 107611279261754
    },
    {
        "city_id": 2486858,
        "city_local_name": "Albany, New York, Estados Unidos",
        "latitude": 42.6598,
        "longitude": -73.7813,
        "text": "Albany, New York, Estados Unidos",
        "uid": 107384699291109
    },
    {
        "city_id": 2491890,
        "city_local_name": "Syracuse, New York, Estados Unidos",
        "latitude": 43.046899,
        "longitude": -76.144423,
        "text": "Syracuse, New York, Estados Unidos",
        "uid": 109748972377870
    },
    {
        "city_id": 2489367,
        "city_local_name": "Queens, New York, Estados Unidos",
        "latitude": 40.6914,
        "longitude": -73.8061,
        "text": "Queens, New York, Estados Unidos",
        "uid": 111046035586548
    },
    {
        "city_id": 2490260,
        "city_local_name": "New City, New York, Estados Unidos",
        "latitude": 41.1456,
        "longitude": -73.995,
        "text": "New City, New York, Estados Unidos",
        "uid": 109241542435052
    },
    {
        "city_id": 2673557,
        "city_local_name": "Suffolk County, New York, Estados Unidos",
        "latitude": 41.0327,
        "longitude": -72.208,
        "text": "Suffolk County, New York, Estados Unidos",
        "uid": 100245043351197
    },
    {
        "city_id": 2490320,
        "city_local_name": "Niagara Falls, New York, Estados Unidos",
        "latitude": 43.0943,
        "longitude": -79.0377,
        "text": "Niagara Falls, New York, Estados Unidos",
        "uid": 107530655943611
    },
    {
        "city_id": 2673555,
        "city_local_name": "Staten Island, New York, Estados Unidos",
        "latitude": 40.622,
        "longitude": -74.1,
        "text": "Staten Island, New York, Estados Unidos",
        "uid": 115726071774858
    }
]
```

