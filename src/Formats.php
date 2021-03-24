<?php

namespace Jawira\PlantUmlClient;

class Formats
{
  public const EPS   = 'eps';
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
