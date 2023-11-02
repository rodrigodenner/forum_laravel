<?php

namespace App\Repositories;

use stdClass;
use App\Models\Support;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\PaginationInterface;

// Implementando as regras de comportamento da Interface  com o banco de dados
// O retorno de cada logica sera importado para o COntroller 

class SupportEloquentORM implements SupportRepositoryInterface
{
  // Injetando o banc de dados que irá trabalhar
  public function __construct(protected Support $model){}

  //Metodo resposavel por criar a logica de paginação
  public function paginate(int $page =1,int $totalItemPage = 15,string $filter = null): PaginationInterface{
    
     $result = $this->model->where(function($query) use ($filter){

      if($filter){
        $query->where( 'subject', $filter);
        
        $query->orWhere( 'body', 'like', "%{$filter}%"); 
      }
    })->paginate($totalItemPage,['*'],'page',$page); 
    dd($result->toArray());
  }
  
  // Metodo responsavel por filtra todos os dados do banco e retornar ele lá dentro do suporte.
  public function getAll(string $filter = null): array
  {
      // Cria a consulta ao banco de dados, e verifica se algum filtro foi passado
      return $this->model->where(function($query) use ($filter){
          // Verifica se um filtro foi especificado.
          if($filter){
            // Se o filtro está presente na consulta , aplica condições à consulta.
            $query->where( 'subject', $filter); // Filtra pelo campo 'subject' igual ao filtro e retorna o dado para o controller mostrar na view.
            
            $query->orWhere( 'body', 'like', "%{$filter}%"); // Se for filtrado pelo body, retorna dado para o constroller,mostrar na view .
          }
        })->get()->toArray(); // Executa a consulta, obtém os resultados e converte em um array.
        
  }
    
  
    // Procura o dado pelo o ID, e retorna para o controlle mostrar na veiw e retorna um stdClass,
    //  caso não ache nada, retorne um NUll.
  public function findOne(string $id): stdClass | null
  {
    $support = $this->model->find($id);
    
    if(!$support){
     return null; 
    };
    // Com o retorno da consulta ao banco , pega o retorno e transforma em um Array
    return (object) $support->toArray();
  }
  
    // Cria um novo registro Cria um no registro no banco de dados  e retorne um StdClass.
  public function new(CreateSupportDTO $dto): stdClass
  {
    //Cria um suporte no banco de dados convertendo os dados de retorno do CreateDTO para array
    $support = $this->model->create((array) $dto);
    
    //Apos criar um novo suporte pegue seu retorno e transforme em Array
    return (object) $support->toArray();
  }
  
    // Atualiza um registro de suporte com base nos parametros criados no DTo, e retorna um StdClass.
    //Caso não consiga atualizar retorne Null
  public function update(UpdateSupportDTO $dto): stdClass | null
  {
    if(!$support = $this->model->find($dto->id)){
      return null;
    }
    //PEga os dados para fazer a atualização no banco vindos do UpdateDTO, atualiza convertendo para array
    $support->update((array)$dto); 

    //Apos criar um novo suporte pegue seu retorno da atualização e transforme em Array para mostrar na view
    return (object) $support->toArray();
  }
    // Exclui um registro de suporte pelo ID e não retorne nada.
  public function delete(string $id): void
  {
    $this->model->findOrFail($id)->delete();
  }
  
}