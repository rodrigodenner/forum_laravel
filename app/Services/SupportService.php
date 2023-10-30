<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
  public function __construct(protected SupportRepositoryInterface $repository){}

  // Obtém todos os registros de suporte com a opção de filtrar por assunto.
  public function getAll(string $filter = null): array 
  {
    return $this->repository->getAll($filter);
  }

  // Encontra um registro de suporte pelo ID.
  public function findOne(string $id): stdClass | null 
  {
    return $this->repository->findOne($id);
  }

  // Cria um novo registro de suporte com base nos dados do DTO.
  public function new(CreateSupportDTO $dto): stdClass 
  {
    return $this->repository->new($dto);
  }

  // Atualiza um registro de suporte com base nos dados do DTO.
  public function update(UpdateSupportDTO $dto): stdClass | null 
  {
    return $this->repository->update($dto);
  }

  // Exclui um registro de suporte pelo ID.
  public function delete(string $id): void 
  {
    $this->repository->delete($id);
  }
}