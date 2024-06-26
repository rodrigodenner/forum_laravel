<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupport;

class CreateSupportDTO
{
  
  // O construtor recebe os parametros que devem ser criados
  public function __construct(
    public string $subject,
    public SupportStatus $status,
    public string $body
  ){}
  
  //Metodo responsavel pela criação do suporte usando os parametros que vem do construtoror
  //Ele passa por parametro a Validação da criação
  //Retornando o que esta sendo criado, passando o status por padrao "A"
  public static function makeFromRequest(StoreUpdateSupport $request): self
  {
    
    return new self(
      $request->subject,
      SupportStatus::A,
      $request->body);
  }
}