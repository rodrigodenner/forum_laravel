<?php

namespace App\Repositories;

use stdClass;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;

interface SupportRepositoryInterface
{
  // Obtém todos os registros de suporte com a opção de filtrar por assunto.
  public function getAll(string $filter = null): array;

  // Encontra um registro de suporte pelo ID.
  public function findOne(string $id): stdClass | null;

  // Cria um novo registro de suporte com base nos dados fornecidos no DTO.
  public function new(CreateSupportDTO $dto): stdClass;

  // Atualiza um registro de suporte com base nos dados fornecidos no DTO.
  public function update(UpdateSupportDTO $dto): stdClass | null;

  // Exclui um registro de suporte pelo ID.
  public function delete(string $id): void;
}