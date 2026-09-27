<?php declare(strict_types=1);

namespace Jawira\PlantUmlClient;

/**
 * @author Jawira Portugal <dev@tugal.be>
 * @copyright © 2021-2026 Jawira Portugal
 */
class Format
{
  public const EPS = 'eps';

  /**
   * @deprecated latex format is not supported anymore by PlantUML server
   */
  public const LATEX = 'latex';
  public const PNG = 'png';
  public const SVG = 'svg';
  public const TXT = 'txt';
  public const ALL = [self::EPS,
    self::PNG,
    self::SVG,
    self::TXT,
    self::LATEX, ];
}
