# Introduction

## How to install

```console
composer require jawira/plantuml-client
```


Four methods are exposed:

* \Jawira\PlantUmlClient\Client::generateImage
* \Jawira\PlantUmlClient\Client::generateUrl
* \Jawira\PlantUmlClient\Client::setServer
* \Jawira\PlantUmlClient\Client::getServer

## Generate image from diagram

```php
use Jawira\PlantUmlClient\Client;
use Jawira\PlantUmlClient\Format;

$puml = <<<PLANTUML
@startuml
Bob -> Alice : hello
@enduml
PLANTUML;

$client = new Client();
$svg = $client->generateImage($puml, Format::SVG);
```

## Load diagram form disk

```php
use Jawira\PlantUmlClient\Client;
use Jawira\PlantUmlClient\Format;

$puml = file_get_contents('path/to/my-diagram.puml'); // load png file

$client = new Client();
$png = $client->generateImage($puml, Format::PNG);

file_put_contents('path/to/my-diagram.png', $png); // save png to disk
```
