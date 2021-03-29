<?php declare(strict_types=1);

namespace Jawira\PlantUmlClient;

use function file_get_contents;
use function in_array;
use function Jawira\PlantUml\encodep;
use function rtrim;
use function sprintf;
use const FILTER_VALIDATE_URL;

/**
 * @author Jawira PORTUGAL <dev@tugal.be>
 */
class Client
{
  public const SERVER = 'http://www.plantuml.com/plantuml';
  /**
   * @var string
   */
  protected $server;

  public function __construct(string $server = self::SERVER)
  {
    $this->setServer($server);
  }

  /**
   * @throws \Jawira\PlantUmlClient\ClientException
   * @throws \Exception
   */
  public function generateImage(string $diagram, string $format = Format::PNG): string
  {
    $url = $this->generateUrl($diagram, $format);

    if (!($image = file_get_contents($url))) {
      throw new ClientException("Error while requesting image from '$url'");
    }

    return $image;
  }

  /**
   * @throws \Jawira\PlantUmlClient\ClientException
   */
  public function generateUrl(string $diagram, string $format = Format::PNG): string
  {
    if (!in_array($format, Format::ALL)) {
      throw new ClientException("'$format' is not a valid image format.");
    }

    return sprintf('%s/%s/%s', $this->getServer(), $format, encodep($diagram));
  }

  /**
   * @throws \Jawira\PlantUmlClient\ClientException
   */
  public function setServer(string $server): Client
  {
    $this->server = rtrim($server, '/');
    if (!filter_var($server, FILTER_VALIDATE_URL)) {
      throw new ClientException("Server '$server' is invalid.");
    }

    return $this;
  }

  public function getServer(): string
  {
    return $this->server;
  }
}
