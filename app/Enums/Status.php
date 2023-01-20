<?php

namespace App\Enums;

enum Status: string
{
  case pending = 'pending';
  case registered = 'registered';
  case verified = 'verified';
}
