<?php

namespace App\Repositories\Contracts;

//Interface criada para encapsular a lógica de formatação e exibição de dados, Ela ajudam a manter as views mais organizadas, permitindo a formatação personalizada dos dados paginados antes de serem exibidos."


interface PaginationInterface {


  public function items():array;// Ira retornar os itens
  public function totalItems():int;//Irá retornar o total de itens na pagina
  public function isFirstPage():bool;//Ira informar se está na primeira pagina
  public function isLastPage():bool;//Ira informar se está na ultima pagina
  public function currentPage():int;//Diz em qual pagina está
  public function getNumberNextPage():int;//Diz qual é a proxima pagina
  public function getNumberPreviousPage():int;//Diz qual é a pagina anterior

}
