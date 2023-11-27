<?php

namespace App\Services;


use stdClass;
use App\DTO\Replies\CreateReplayDTO;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\ReplayRepositoryInterface;

class ReplySupportService
{
  public function __construct(protected ReplayRepositoryInterface $repository) {
  }

  public function getAllBySupportId(string $supportId): array
  {
   return $this->repository->getAllBySupportId($supportId);
  }

  public function createNew(CreateReplayDTO $dto): stdClass
  {
    return $this->repository->createNew($dto);
  }

  public function delete(string $id): bool
  {
    return $this->repository->delete($id);
  }

}
