# Introduction

## Install

```console
composer require jawira/plantuml-client
```

The client exposes four methods:

- `Jawira\PlantUmlClient\Client::generateImage`
- `Jawira\PlantUmlClient\Client::generateUrl`
- `Jawira\PlantUmlClient\Client::setServer`
- `Jawira\PlantUmlClient\Client::getServer`

## Generate an image from a diagram

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

## Load a diagram from disk

```php
use Jawira\PlantUmlClient\Client;
use Jawira\PlantUmlClient\Format;

$puml = file_get_contents('path/to/my-diagram.puml'); // Load the PlantUML source.

$client = new Client();
$png = $client->generateImage($puml, Format::PNG);

file_put_contents('path/to/my-diagram.png', $png); // Save the PNG image.
```
