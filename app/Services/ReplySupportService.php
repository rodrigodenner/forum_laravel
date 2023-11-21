<?php

namespace App\Services;

use App\DTO\Replies\CreateReplayDTO;
use stdClass;

class ReplySupportService
{
  //Retorna todas as resposta de um suporte
    public function getAllBySupportId(string $supportId):array
    {
      return [];
    }

    //cria uma nova resposta ao support com os parametros vindos do DTO
    public function createNew(CreateReplayDTO $dto):stdClass
    {
      return throw new \Exception('not implement');
    }
}
