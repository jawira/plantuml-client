# PlantUML client

![PlantUML client](./docs/images/plantuml-client.svg)

**_PlantUML client_ uses a remote server to convert PlantUML diagrams into images.  
Now you don't need to install PlantUML locally!**

***

[![Latest Stable Version](https://poser.pugx.org/jawira/plantuml-client/v)](//packagist.org/packages/jawira/plantuml-client)
[![Total Downloads](https://poser.pugx.org/jawira/plantuml-client/downloads)](//packagist.org/packages/jawira/plantuml-client)
[![composer.lock](https://poser.pugx.org/jawira/plantuml-client/composerlock)](//packagist.org/packages/jawira/plantuml-client)
[![.gitattributes](https://poser.pugx.org/jawira/plantuml-client/gitattributes)](//packagist.org/packages/jawira/plantuml-client)
[![License](https://poser.pugx.org/jawira/plantuml-client/license)](//packagist.org/packages/jawira/plantuml-client)

## Methods

Four methods are exposed:

* \Jawira\PlantUmlClient\Client::generateImage
* \Jawira\PlantUmlClient\Client::generateUrl
* \Jawira\PlantUmlClient\Client::setServer
* \Jawira\PlantUmlClient\Client::getServer

## Examples

**Generate image:**

```php
use Jawira\PlantUmlClient\{Client, Format};

$puml = file_get_contents('path/to/my-diagram.puml'); // loading diagram

$client = new Client();
$svg = $client->generateImage($puml, Format::SVG); // svg image
file_put_contents('path/to/my-diagram.png', $svg);
```

**Generate url:**

```php
use Jawira\PlantUmlClient\{Client, Format};

$puml = file_get_contents('path/to/my-diagram.puml'); // loading diagram

$client = new Client();
$url = $client->generateUrl($puml, Format::PNG); // image's url
echo "<img src='$url'>";
```

## Limitation

Default PlantUml server (<https://www.plantuml.com/plantuml>) cannot handle huge diagrams. If you have problems it is suggested to use your own PlantUml server (<https://github.com/plantuml/plantuml-server>). Additionally, you have to set PLANTUML_LIMIT_SIZE environment variable in your server, otherwise your diagram will be cropped.

## How to install

```console
composer require jawira/plantuml-client
```

## Documentation

<https://jawira.github.io/plantuml-client/>

## Contributing

If you liked this project, ⭐ star it on GitHub.

## License

This library is licensed under the [MIT license](LICENSE.md).

***

## Packages from jawira

<dl>
<dt>
  <a href="https://packagist.org/packages/jawira/plantuml">jawira/plantuml
  <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/plantuml?icon=github"/></a>
</dt>
<dd>Provides PlantUML executable and plantuml.jar</dd>
<dt>
  <a href="https://packagist.org/packages/jawira/plantuml-encoding"> jawira/plantuml-encoding
  <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/plantuml-encoding?icon=github"/></a>
</dt>
<dd>PlantUML encoding functions.</dd>
<dt><a href="https://packagist.org/packages/jawira/">more...</a></dt>
</dl>
