<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupport;

// O construtor recebe os parametros que devem ser criados
class UpdateSupportDTO
{
    public function __construct(
        public string $id,
        public string $subject,
        public SupportStatus $status,
        public string $body
    ) {}

    //Metodo responsavel pelo Update do suporte usando os parametros que vem do construtoror
    //Ele passa por parametro a Validação do Update
    //Retornando o que esta sendo atualizado, passando o status por padrao "A"
    public static function makeFromRequest(StoreUpdateSupport $request, string $id): self
    {
        return new self(
          $id ?? $request->id,
          $request->subject,
          SupportStatus::A,
          $request->body);
    }
}
