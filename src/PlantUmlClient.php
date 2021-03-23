<?php declare(strict_types=1);

namespace Jawira\PlantUmlRequest;

use function in_array;
use function Jawira\PlantUml\encodep;
use function rtrim;

/**
 * Class PlantUmlClient
 *
 * @author  Jawira PORTUGAL <dev@tugal.be>
 */
class PlantUmlClient
{
    protected const FORMATS = ['svg', 'png', 'eps'];
    protected string $server;

    public function __construct(string $server = 'http://www.plantuml.com/plantuml')
    {
        $this->setServer($server);
    }

    public function generate(string $diagram, string $format): string
    {
        if (!in_array($format, self::FORMATS)) {
            throw new PlantUmlClientException("$format is an invalid image format.");
        }
        $url = sprintf('%s/%s/%s', $this->getServer(), $format, encodep($diagram));

        if (!($image = file_get_contents($url))) {
            throw new PlantUmlClientException('Error while getting image from server');
        }

        return $image;
    }

    public function setServer(string $server): PlantUmlClient
    {
        $this->server = rtrim($server, '/');

        return $this;
    }

    public function getServer(): string
    {
        return $this->server;
    }
}