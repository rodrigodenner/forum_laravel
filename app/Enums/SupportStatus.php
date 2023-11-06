<?php

namespace App\Enums;

use ValueError;

enum SupportStatus: string
{
  case A = 'Open';
  case P = 'Pendent';
  case C = 'Closed';

  public static function fromValue(string $name):string
  {
    foreach (self::cases() as $status) {
      if($name === $status->name){
        return $status->value;
      }
    }
    throw new ValueError("$status não é valido");
    
  }

}