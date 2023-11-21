<?php

namespace App\DTO\Replies;

class CreateReplayDTO
{
  public function __construct(
    public string $supportId,
    public string $content,
  ){}
}
