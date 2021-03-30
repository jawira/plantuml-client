# PlantUML client

![PlantUML client](images/plantuml-client.png)

**Use a remote server to convert PlantUML diagrams into images. You don't need to install PlantUML locally!**

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

$puml = file_get_contents('path/to/my-diagram.puml'); // load png file

$client = new Client();
$png = $client->generateImage($puml); // Default format 'png'

file_put_contents('path/to/my-diagram.png', $png); // save png to disk
```

## How to install

```console
composer require jawira/plantuml-client
```

## Credits

- PlantUML Icon-Font Sprites - https://github.com/tupadr3/plantuml-icon-font-sprites
