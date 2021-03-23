<?php declare(strict_types=1);

namespace Jawira\PlantUmlClient;

use function file_get_contents;
use function in_array;
use function Jawira\PlantUml\encodep;
use function rtrim;
use function sprintf;

/**
 * @author  Jawira PORTUGAL <dev@tugal.be>
 */
class Client
{
  public const FORMATS = ['svg', 'png', 'eps'];
  protected string $server;

  public function __construct(string $server = 'http://www.plantuml.com/plantuml')
  {
    $this->setServer($server);
  }

  /**
   * @throws \Jawira\PlantUmlClient\ClientException
   * @throws \Exception
   */
  public function generate(string $diagram, string $format): string
  {
    if (!in_array($format, self::FORMATS)) {
      throw new ClientException("'$format' is not a valid image format.");
    }

    $url = sprintf('%s/%s/%s', $this->getServer(), $format, encodep($diagram));

    if (!($image = file_get_contents($url))) {
      throw new ClientException("Error while requesting image from '$url'");
    }

    return $image;
  }

  public function setServer(string $server): Client
  {
    $this->server = rtrim($server, '/');

    return $this;
  }

  public function getServer(): string
  {
    return $this->server;
  }
}