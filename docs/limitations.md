## Limitations

Default PlantUml server (<https://www.plantuml.com/plantuml>) cannot handle huge diagrams. If you have problems it is
suggested to use your own PlantUml server (<https://github.com/plantuml/plantuml-server>).

Additionally, you have to set PLANTUML_LIMIT_SIZE environment variable in your server, otherwise your diagram will be
cropped.

```console
$ docker run -d -p 8080:8080 -e PLANTUML_LIMIT_SIZE=10000 plantuml/plantuml-server
```

Your PlantUml server is listening at <http://localhost:8080>.

For example: <http://localhost:8080/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000>

```php
use Jawira\PlantUmlClient\Client;
$client = new Client('http://localhost:8080'); 
```

Or using appropriate setter:

```php
use Jawira\PlantUmlClient\Client;
$client = new Client(); 
$client->setServer('http://localhost:8080'); 
```
