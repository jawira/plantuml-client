## Incomplete diagrams

The default PlantUML server at <https://www.plantuml.com/plantuml> may not be
able to process very large diagrams. If a diagram is cropped or the request fails, try running your own [PlantUML server](https://github.com/plantuml/plantuml-server).

Set the `PLANTUML_LIMIT_SIZE` environment variable on your server to increase the maximum diagram size. For example:

```console
docker run -d -p 8080:8080 -e PLANTUML_LIMIT_SIZE=10000 plantuml/plantuml-server
```

The server is then available at <http://localhost:8080>. For example, you can open
<http://localhost:8080/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000>.

Pass the server URL to the client when creating it:

```php
use Jawira\PlantUmlClient\Client;

$client = new Client('http://localhost:8080');
```

Or configure it after creating the client:

```php
use Jawira\PlantUmlClient\Client;

$client = new Client();
$client->setServer('http://localhost:8080');
```
