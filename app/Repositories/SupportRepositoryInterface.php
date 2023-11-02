<?php

namespace App\Repositories;

use stdClass;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;

// Interface para ditar as regras de como o Service e a logica 
//  com o banco de dados deve se comportar
//  Apos a criação, vá ate Providers/Appservice/ 
//  Injete em Register ( Aonde injetar a interface, irá deppender da logica
// criada dentro de uma classe concetra, nesse caso a classe concreta é SupportEloquente )

//  $this->app->bind(SupportRepositoryInterface::class,SupportEloquentORM::class);
//  Isso faz que a classe que ta recebendo a interface não precise implementar (depender) da interface
// Interface para ditar as regras de como o Service e a logica com o banco de dados deve se comportar
interface SupportRepositoryInterface
{
  //Metodo que retorna a paginação,sendo a sua logica salva dentro de outra interface 
  //Passando por parametro, qual pagina que esta mostrando o resultado/Total itens por pagina/ se tiver filtro/ que retorna uma outra interface que fala tudo que precisa para paginar
  public function paginate(int $page =1,int $totalItemPage = 15,string $filter = null): PaginationInterface;

  // Obtém todos os registros de suporte com a opção de filtrar por assunto, do banco de dados
  public function getAll(string $filter = null): array;

  // Encontra um registro de suporte pelo ID.  do banco de dado
  public function findOne(string $id): stdClass | null;

  // Cria um novo registro de suporte com base nos dados fornecidos no DTO no banco de dado
  public function new(CreateSupportDTO $dto): stdClass;

  // Atualiza um registro de suporte com base nos dados fornecidos no DTO no banco de dados
  public function update(UpdateSupportDTO $dto): stdClass | null;

  // Exclui um registro de suporte pelo ID no banco de dados
  public function delete(string $id): void;
}