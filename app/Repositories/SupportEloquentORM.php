<?php

namespace App\Repositories;

use App\Enums\SupportStatus;
use stdClass;
use App\Models\Support;
use Illuminate\Support\Facades\Gate;
use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;


// Implementando as regras de comportamento da Interface  com o banco de dados
// O retorno de cada logica sera importado para o COntroller

class SupportEloquentORM implements SupportRepositoryInterface
{
  // Injetando o banc de dados que irá trabalhar
  public function __construct(protected Support $model){}


  public function paginate(int $page = 1, int $totalItemPage = 15, string $filter = null): PaginationInterface{
    // Esta função "paginate" recebe três parâmetros: $page, $totalItemPage e $filter.
    // $page é o número da página atual (1 por padrão).
    // $totalItemPage é o número máximo de itens exibidos por página (15 por padrão).
    // $filter é um filtro de pesquisa opcional.

    $result = $this->model->with(['replies'=>function($query){
      $query->limit(4); //trazendo 4 interações
      $query->latest();
    }])->where(function($query) use ($filter){
        // Aqui começamos a construir uma consulta no modelo (assumindo que $this->model seja um modelo Eloquent).

        if($filter){
            // Verificamos se o filtro não está vazio.

            $query->where('subject', $filter);
            // Se houver um filtro, adicionamos uma cláusula "WHERE" para corresponder à coluna 'subject' com o valor do filtro.

            $query->orWhere('body', 'like', "%{$filter}%");
            // Também adicionamos uma cláusula "OR" para corresponder à coluna 'body' que contém o filtro parcialmente.
        }
    })->paginate($totalItemPage, ['*'], 'page', $page);
    // Em seguida, usamos o método "paginate" no modelo, que efetua a consulta e retorna uma lista paginada.
    
    return new PaginationPresenter($result);
    // Finalmente, envolvemos o resultado paginado em uma instância de "PaginationPresenter" e a retornamos.
}



public function getAll(string $filter = null): array
{
    // Esta função "getAll" recebe um parâmetro opcional chamado $filter, que é usado para filtrar os resultados.

    return $this->model->with('user')->where(function($query) use ($filter){
        // Aqui começamos a construir uma consulta no modelo (assumindo que $this->model seja um modelo Eloquent).

        if($filter){
            // Verificamos se o filtro não está vazio.

            $query->where('subject', $filter);
            // Se houver um filtro, adicionamos uma cláusula "WHERE" para corresponder à coluna 'subject' com o valor do filtro.

            $query->orWhere('body', 'like', "%{$filter}%");
            // Também adicionamos uma cláusula "OR" para corresponder à coluna 'body' que contém o filtro parcialmente.
        }
    })->get()->toArray();
    // Em seguida, usamos o método "get" no modelo para obter os resultados que correspondem ao filtro, e depois convertemos esses resultados em um array.

    // O resultado final é um array que contém os registros do banco de dados após a aplicação do filtro (se especificado).
}



    // Procura o dado pelo o ID, e retorna para o controlle mostrar na veiw e retorna um stdClass,
    //  caso não ache nada, retorne um NUll.
  public function findOne(string $id): stdClass | null
  {
    $support = $this->model->with('user')->find($id);

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

    //verificando se o usuario tem a permissao
    if(Gate::denies('owner',$support->user->id)){
      abort(403,'Not Authorized');
    }

    //PEga os dados para fazer a atualização no banco vindos do UpdateDTO, atualiza convertendo para array
    $support->update((array)$dto);

    //Apos criar um novo suporte pegue seu retorno da atualização e transforme em Array para mostrar na view
    return (object) $support->toArray();
  }
    // Exclui um registro de suporte pelo ID e não retorne nada.
  public function delete(string $id): void
  {
    $support =  $this->model->findOrFail($id);

    //verificando se o usuario tem a permissao
    if(Gate::denies('owner',$support->user->id)){
      abort(403,'Not Authorized');
    }

    $support->delete();
  }

  public function updateStatus(string $id, SupportStatus $status): void
  {
    $this->model->where('id',$id)->update([
      'status' => $status->name
    ]);
  }
}
