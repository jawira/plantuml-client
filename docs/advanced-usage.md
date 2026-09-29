## Available formats

The client supports `png` (the default), `svg`, `eps`, and `txt` output formats.

Each format has a constant in `Jawira\PlantUmlClient\Format`. Use
`Jawira\PlantUmlClient\Format::ALL` to get the list of formats accepted by the
client.

## Customize the PlantUML server

By default, the client uses the official PlantUML server
at <https://www.plantuml.com/plantuml>. You can configure a different PlantUML
server, for example, to keep diagram requests on your own infrastructure.

Set the server when creating the client:

```php
use Jawira\PlantUmlClient\Client;

$client = new Client('https://custom-server.example/plantuml');
```

Or set it after creating the client:

```php
use Jawira\PlantUmlClient\Client;

$client = new Client(); // Uses the default server.
$client->setServer('https://custom-server.example/plantuml');
```

## Generate an image URL

This library provides a minimal interface for converting diagrams into images.
If you need additional behavior, such as asynchronous processing, generate the
image URL and handle the request yourself. You can also use the URL directly in
a web page.

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
