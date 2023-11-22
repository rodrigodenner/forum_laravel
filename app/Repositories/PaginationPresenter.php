<?php

namespace App\Repositories;

use App\Repositories\Contracts\PaginationInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class PaginationPresenter implements PaginationInterface
{
  private array $items;
  /**
   * Importando a classe nativa que tras todos os dados necessarios para paginação
   */
  public function __construct(protected LengthAwarePaginator $paginator)
  {
    //converter o retorno de Items, item por item para stdClass
    //Atribuindo a $items todos items retornados como stdClass
    $this->items = $this->resolveItems($this->paginator->items());
  }
  /**
   * @return stdClass[]
   */
  public function items():array//retornar um array de stdClass
  {
    //recebendo todos os itens convertidos para stdClass de ResolveItems
    return $this->items;
  }
  //Metodo para retornar o total de items , caso contratio retorne 0
  public function totalItems():int
  {
    return $this->paginator->total() ?? 0 ;
  }
  //Metodo que informa se está na primeira pagina ou não
  public function isFirstPage():bool
  {
    return $this->paginator->onFirstPage();
  }
  //Metodo que verifica se está na ultima pagina
  public function isLastPage():bool
  {
    //retornando uma verificação se a pagina que está é igual  ultima pagina
    return $this->paginator->currentPage() === $this->paginator->lastPage();
  }
  //Metodo que informa qual a pagina atual que você se encontra, caso contratio retorne 1
  public function currentPage():int
  {
    return $this->paginator->currentPage() ?? 1;
  }
  //metodo que verifica qual é a proxima pagina
  public function getNumberNextPage():int
  {
    return $this->paginator->currentPage() + 1;
  }
  //metodo que verifica qual é a pagina anterior
  public function getNumberPreviousPage():int
  {
    return $this->paginator->currentPage() - 1;
  }

  //Convertando todos os dados de items em stdClass
  private function resolveItems(array $items):array //retornar um array de stdClass
  {
    $response = [];
    //convertendo cada item para stdClass
    foreach ($items as $item ) {
      $stdClassObject = new stdClass;
      foreach ($item->toArray() as $key => $value) {
        $stdClassObject->{$key} = $value;
      }
      array_push($response,$stdClassObject);
    }
    return $response;
  }

}
