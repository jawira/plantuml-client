# Advanced usage

## Customizing PlantUML server

Currently, _PlantUML client_ uses the official server: <http://www.plantuml.com/plantuml>.

You can set your own _PlantUML server_ -for example for privacy purposes.

```php
use Jawira\PlantUmlClient\Client;
$client = new Client('http://custom-server.com/plantuml');
```

## Well known problems

- Includes don't work.
- Png images are cropped.
