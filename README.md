# PlantUML client

![PlantUML client](./docs/images/plantuml-client.png)

**_PlantUML client_ uses a remote server to convert PlantUML diagrams to images. Now you don't need to install PlantUML
locally!**

[![Latest Stable Version](https://poser.pugx.org/jawira/plantuml-client/v)](//packagist.org/packages/jawira/plantuml-client)
[![Total Downloads](https://poser.pugx.org/jawira/plantuml-client/downloads)](//packagist.org/packages/jawira/plantuml-client)
[![composer.lock](https://poser.pugx.org/jawira/plantuml-client/composerlock)](//packagist.org/packages/jawira/plantuml-client)
[![.gitattributes](https://poser.pugx.org/jawira/plantuml-client/gitattributes)](//packagist.org/packages/jawira/plantuml-client)
[![License](https://poser.pugx.org/jawira/plantuml-client/license)](//packagist.org/packages/jawira/plantuml-client)

## Usage

```php
use Jawira\PlantUmlClient\{Client, Format};

$puml = <<<PLANTUML
@startuml
Bob -> Alice : hello
@enduml
PLANTUML;

$client = new Client();
$svg = $client->generateImage($puml, Format::SVG);

```

## Documentation

<https://jawira.github.io/plantuml-client/>

## How to install

```console
composer require jawira/plantuml-client
```
