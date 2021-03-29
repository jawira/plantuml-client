<?php

use Jawira\PlantUmlClient\Client;
use Jawira\PlantUmlClient\ClientException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
  protected $chocolate;
  protected $colors;
  protected $simple;
  protected $version;

  public function __construct(?string $name = null, array $data = [], $dataName = '')
  {
    parent::__construct($name, $data, $dataName);

    $this->chocolate = file_get_contents('resources/diagrams/chocolate.puml');
    $this->colors    = file_get_contents('resources/diagrams/colors.puml');
    $this->simple    = file_get_contents('resources/diagrams/simple.puml');
    $this->version   = file_get_contents('resources/diagrams/version.puml');
  }

  /**
   * @covers \Jawira\PlantUmlClient\Client::getServer
   * @covers \Jawira\PlantUmlClient\Client::setServer
   */
  public function testDefaultServer()
  {
    $client = new Client();
    $server = $client->getServer();
    $this->assertIsString($server);
    $this->assertStringStartsWith('http://www.plantuml.com', $server);
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::generateImage
   * @dataProvider generateTextImageProvider
   */
  public function testGenerateTextImage(string $puml, string $format, string $needle)
  {
    $client = new Client();
    $image  = $client->generateImage($puml, $format);
    $this->assertStringContainsString($needle, $image);
  }

  public function generateTextImageProvider()
  {
    return [
      // svg
      [$this->chocolate, 'svg', 'Sienna'],
      [$this->colors, 'svg', 'BUSINESS'],
      [$this->simple, 'svg', 'bob'],
      [$this->version, 'svg', 'Installation seems OK'],
      // latex
      [$this->chocolate, 'latex', 'Sienna'],
      [$this->colors, 'latex', 'BUSINESS'],
      [$this->simple, 'latex', 'bob'],
      [$this->version, 'latex', 'Installation seems OK'],
      // txt
      [$this->chocolate, 'txt', 'Sienna'],
      [$this->colors, 'txt', 'BUSINESS'],
      [$this->simple, 'txt', 'bob'],
      [$this->version, 'txt', 'Installation seems OK'],
      // eps
      [$this->chocolate, 'eps', '0.74 0.56 0.56 setrgbcolor'],
      [$this->colors, 'eps', '17500 2800 17500 8400 simplerect'],
      [$this->simple, 'eps', '3500 2229 7400 8129 100 roundrect'],
      [$this->version, 'eps', '41500 11559 translate'],
    ];
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::generateImage
   * @dataProvider generateBinaryImageProvider
   */
  public function testGenerateBinaryImage(string $puml, string $format, string $mimeType)
  {
    $client   = new Client();
    $image    = $client->generateImage($puml, $format);
    $filename = tempnam(sys_get_temp_dir(), 'jawira-');
    file_put_contents($filename, $image);
    $this->assertSame(mime_content_type($filename), $mimeType);
    unlink($filename);
  }

  public function generateBinaryImageProvider()
  {
    return [
      [$this->chocolate, 'png', 'image/png'],
      [$this->colors, 'png', 'image/png'],
      [$this->simple, 'png', 'image/png'],
      [$this->version, 'png', 'image/png'],
    ];
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::setServer
   * @dataProvider invalidServerProvider
   */
  public function testInvalidServerInConstructor(string $server)
  {
    $this->expectException(ClientException::class);
    new Client($server);
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::setServer
   * @dataProvider invalidServerProvider
   */
  public function testInvalidServerInMethod(string $server)
  {
    $this->expectException(ClientException::class);
    (new Client())->setServer($server);
  }

  public function invalidServerProvider()
  {
    return [
      ['my-custom-server.com/demo'],
      ['www.plantuml.com/plantuml'],
      ['//no-schema.com/plantuml'],
    ];
  }
}
