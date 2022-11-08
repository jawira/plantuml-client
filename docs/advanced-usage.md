## Available formats

The following formats are supported: `png` (default), `svg`, `eps`, `txt`, and `latex`.

Each format has its own class constant in `\Jawira\PlantUmlClient\Formats`.

You can get all available formats with `\Jawira\PlantUmlClient\Formats::ALL`.

## Customizing PlantUML server

Currently, _PlantUML client_ uses the official server: <http://www.plantuml.com/plantuml>. You can set your own
_PlantUML server_ -for example for privacy purposes.

Set the server on instantiation:

```php
use Jawira\PlantUmlClient\Client;
$client = new Client('http://custom-server.com/plantuml');
```

Or, set the server after instantiation:

```php
use Jawira\PlantUmlClient\Client;
$client = new Client(); // using default server
$client->setServer('http://custom-server.com/plantuml');
```

TIP: you can find plenty of open PlantUML servers with a
[simple search](https://www.google.com/search?q="You+can+enter+here+a+previously+generated+URL").

## Generating image's url

This library only provides the minimum functionality to convert diagrams into images. If you need to do something more
fancy (eg. async), you can retrieve the image's url and do it yourself.

Generating the image's url can also be useful for websites, for example.

```php
use Jawira\PlantUmlClient\Client;
use Jawira\PlantUmlClient\Format;

$puml = <<<PLANTUML
@startuml
Bob -> Alice : hello
@enduml
PLANTUML;

$client = new Client();
$url = $client->generateUrl($puml, Format::PNG);

echo "<img src='$url'>";
```
