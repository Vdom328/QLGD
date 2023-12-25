<?php

namespace App\Traits;

trait EnumToLabel
{

  public static function getName($value): string
  {
    return self::tryFrom($value)->name;
  }

  public static function getLabel($value): string
  {
    return self::tryFrom($value)->label();
  }

  public static function fromLabel(string $label): ?string
  {
      foreach (self::cases() as $status) {
          if( $label == $status->label() ){
              return $status->value;
          }
      }
      return null;
  }
}