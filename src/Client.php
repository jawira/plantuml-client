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
  public const SERVER = 'https://www.plantuml.com/plantuml';
  /** PlantUml server. */
  protected string $server;

  /**
   * @throws ClientException
   */
  public function __construct(string $server = self::SERVER)
  {
    $this->setServer($server);
  }

  /**
   * Returns $diagram in requested $format. It's up to you to dump the image into a file.
   *
   * @param string $diagram Diagram in PlantUml format.
   * @param string $format Destination format.
   * @return string Converted diagram.
   * @throws ClientException Problems downloading image from server. Usually diagram is too big.
   */
  public function generateImage(string $diagram, string $format = Format::PNG): string
  {
    $url = $this->generateUrl($diagram, $format);

    if (!($image = file_get_contents($url))) {
      throw new ClientException("Error while requesting image from '$this->server'. Maybe diagram is too big, use custom PlantUml server instead.");
    }

    return $image;
  }

  /**
   * Generates the URL from where you can download your image later.
   *
   * @param string $diagram Diagram in PlantUml format.
   * @param string $format Destination format.
   * @return string Url from PlantUml server.
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
   * Use this method to replace default PlantUml server.
   *
   * Default server (from plantuml.com) cannot handle big diagrams, custom servers doesn't have this limitation.
   * Nevertheless, you also have to set PLANTUML_LIMIT_SIZE variable properly.
   *
   * @link https://hub.docker.com/r/plantuml/plantuml-server
   * @throws \Jawira\PlantUmlClient\ClientException
   */
  public function setServer(string $server): Client
  {
    $this->server = rtrim($server, '/');
    if (!filter_var($server, FILTER_VALIDATE_URL)) {
      throw new ClientException("Server '$server' is not a valid url.");
    }

    return $this;
  }

  /**
   * Get server used to generate images.
   */
  public function getServer(): string
  {
    return $this->server;
  }
}
