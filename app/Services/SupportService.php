<?php

namespace App\Services;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use stdClass;

class SupportService
{
    //Injetando o Repositorio (banco de dados ) dentro do servise
    public function __construct(protected SupportRepositoryInterface $repository) {}

    //Responsavel por trazer todos os itens do banco de dados Paginados, com todos os parametro estipulados pela a interface PaginationInterface
    public function paginate(int $page =1,int $totalItemPage = 15,string $filter = null):PaginationInterface//retorna a interface de paginação
    {
      //retorna do repositorio(banco) qual a pagina/total de itens por pagina/ se tem filtro
      return $this->repository->paginate(page:$page,totalItemPage:$totalItemPage,filter:$filter);
    }

    // Responsavel por fazer o elo do repositorios para o nossos controllers/ retorna os dados em array
    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    // Responsavel por encontrar um elemento pelo id no repositorio  / retorna os dados em stdCLass ou Null
    public function findOne(string $id): stdClass | null
    {
        return $this->repository->findOne($id);
    }

    // Responsavel por Cria um novo registro de suporte com base nos dados do DTO./ retorna os dados em StdClass
    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    // Responsavel por Atualiza um registro de suporte com base nos dados do DTO/ retorna os dados em StdCLass ou null
    public function update(UpdateSupportDTO $dto): stdClass | null
    {
        return $this->repository->update($dto);
    }

    // Responsavel por Exclui um registro de suporte no repositorio pelo ID / retorna nada
    public function delete(string $id): void
    {
      $this->repository->delete($id);
    }
}
