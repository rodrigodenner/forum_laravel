<?php

namespace App\Repositories;

use stdClass;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Models\Support;

class SupportEloquentORM implements SupportRepositoryInterface
{
  
  public function __construct(protected Support $model){}
  
    // Obtém todos os registros de suporte com a opção de filtrar por assunto.
    public function getAll(string $filter = null): array
    {
        // Cria uma consulta no modelo Support.
        return $this->model->where(function($query) use ($filter){
            // Verifica se um filtro foi especificado.
            if($filter){
              // Se o filtro está presente, aplica condições à consulta.
              $query->where( 'subject', $filter); // Filtra pelo campo 'subject' igual ao filtro.
              $query->orWhere( 'body', 'like', "%{$filter}%"); // Ou filtra pelo campo 'body' que contém o filtro.
            }
          })->get()->toArray(); // Executa a consulta, obtém os resultados e converte em um array.
    }
    
  
    // Encontra um registro de suporte pelo ID.
  public function findOne(string $id): stdClass | null
  {
    $support = $this->model->find($id);
    
    if(!$support){
     return null; 
    };
    
    return (object) $support->toArray();
  }
  
    // Cria um novo registro de suporte com base nos dados do DTO.
  public function new(CreateSupportDTO $dto): stdClass
  {
    $support = $this->model->create((array) $dto);
    
    return (object) $support->toArray();
  }
  
    // Atualiza um registro de suporte com base nos dados do DTO.
  public function update(UpdateSupportDTO $dto): stdClass | null
  {
    if(!$support = $this->model->find($dto->id)){
      return null;
    }
    $support->update((array)$dto);

    return (object) $support->toArray();
  }
    // Exclui um registro de suporte pelo ID.
  public function delete(string $id): void
  {
    $this->model->findOrFail($id)->delete();
  }
  
}