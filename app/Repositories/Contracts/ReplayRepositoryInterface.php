<?php

namespace App\Repositories\Contracts;

use App\DTO\Replies\CreateReplayDTO;
use stdClass;

interface ReplayRepositoryInterface
{
  public function getAllBySupportId(string $supportId):array;

  public function createNew(CreateReplayDTO $dto):stdClass;
}
