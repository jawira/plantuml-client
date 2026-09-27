<?php declare(strict_types=1);

namespace Jawira\PlantUmlClientTests;

use Jawira\PlantUmlClient\Client;
use Jawira\PlantUmlClient\ClientException;
use PHPUnit\Framework\TestCase;

use function file_get_contents;
use function file_put_contents;
use function mime_content_type;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

/**
 * @internal
 *
 * @coversNothing
 *
 * @author Jawira Portugal <dev@tugal.be>
 * @copyright © 2021-2026 Jawira Portugal
 */
class ClientTest extends TestCase
{
  protected $chocolate;
  protected $colors;
  protected $simple;
  protected $version;
  protected $client;

  public function setUp(): void
  {
    $this->client = new Client();
    $this->client->setServer('http://localhost:35123');
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
    $this->assertStringStartsWith('https://www.plantuml.com', $server);
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::generateImage
   *
   * @dataProvider generateTextImageProvider
   */
  public function testGenerateTextImage(string $puml, string $format, string $needle)
  {
    $image = $this->client->generateImage($puml, $format);
    $this->assertStringContainsString($needle, $image);
  }

  public static function generateTextImageProvider()
  {
    return [
      // svg
      [self::loadImage('chocolate'), 'svg', 'Sienna'],
      [self::loadImage('colors'), 'svg', 'BUSINESS'],
      [self::loadImage('simple'), 'svg', 'bob'],
      [self::loadImage('version'), 'svg', 'Installation seems OK'],
      // txt
      [self::loadImage('chocolate'), 'txt', 'Sienna'],
      //      [self::loadImage('colors'), 'txt', 'BUSINESS'],
      [self::loadImage('simple'), 'txt', 'bob'],
      [self::loadImage('version'), 'txt', 'Installation seems OK'],
      // eps
      [self::loadImage('chocolate'), 'eps', 'rquadto'],
      [self::loadImage('colors'), 'eps', 'rquadto'],
      [self::loadImage('simple'), 'eps', 'rquadto'],
      [self::loadImage('version'), 'eps', 'rquadto'],
    ];
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::generateImage
   *
   * @dataProvider generateBinaryImageProvider
   */
  public function testGenerateBinaryImage(string $puml, string $format, string $mimeType)
  {
    $image = $this->client->generateImage($puml, $format);
    $filename = tempnam(sys_get_temp_dir(), 'jawira-');
    file_put_contents($filename, $image);
    $this->assertSame(mime_content_type($filename), $mimeType);
    unlink($filename);
  }

  public static function generateBinaryImageProvider()
  {
    return [
      [self::loadImage('chocolate'), 'png', 'image/png'],
      [self::loadImage('colors'), 'png', 'image/png'],
      [self::loadImage('simple'), 'png', 'image/png'],
      [self::loadImage('version'), 'png', 'image/png'],
    ];
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::setServer
   *
   * @dataProvider invalidServerProvider
   */
  public function testInvalidServerInConstructor(string $server)
  {
    $this->expectException(ClientException::class);
    new Client($server);
  }

  /**
   * @covers       \Jawira\PlantUmlClient\Client::setServer
   *
   * @dataProvider invalidServerProvider
   */
  public function testInvalidServerInMethod(string $server)
  {
    $this->expectException(ClientException::class);
    (new Client())->setServer($server);
  }

  public static function invalidServerProvider()
  {
    return [
      ['my-custom-server.com/demo'],
      ['www.plantuml.com/plantuml'],
      ['//no-schema.com/plantuml'],
    ];
  }

  /**
   * Load the content of a PlantUML file.
   */
  public static function loadImage(string $imageName): string
  {
    return file_get_contents("resources/diagrams/{$imageName}.puml");
  }
}
