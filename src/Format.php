<?php

namespace Jawira\PlantUmlClient;

class Format
{
  public const EPS   = 'eps';
  /**
   * @deprecated Latex format is not supported anymore by PlantUML server.
   */
  public const LATEX = 'latex';
  public const PNG   = 'png';
  public const SVG   = 'svg';
  public const TXT   = 'txt';
  public const ALL   = [self::EPS,
                        self::PNG,
                        self::SVG,
                        self::TXT,
                        self::LATEX,];
}
