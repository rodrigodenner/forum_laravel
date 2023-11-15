<?php

namespace App\Http\Controllers\Admin;


use App\Models\Support;
use Illuminate\Http\Request;
use App\DTO\Supports\CreateSupportDTO;
use App\Services\SupportService;
use App\Http\Controllers\Controller;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Requests\StoreUpdateSupport;

class SupportController extends Controller
{
    //Injetando o service no controller
    public function __construct(protected SupportService $service) {}

    // Chama o metodo paginate() no service , resposavel por listar todos os supoertes paginados , tranzendo tudo do banco .
    public function index(Request $request)
    {

      //Retorna todos os dados vindo pela requisição do banco ou os dados do filtro se ouver com as informações passadas por parametro criada da PaginateInterface
      $supports = $this->service->paginate(

        page: $request->get('page',1),//A pagina , se não existir passa 1 como padrão

        totalItemPage:$request->get('item_page',5),//Total de itens por pagina

        filter:$request->filter//se tem filtro
      );
      //passando o filtro para a view independente da pagina
      $filters = ['filter'=>$request->get('filter','')];

      return view('admin.supports.index', compact('supports','filters')); //Suporte está retornando um array para view
    }

    // Recebe a requisição de criação e encaminha para a view de criação.
    public function create()
    {
        return view('admin.supports.create');
    }

    //  Importa a responsabilidade de criar um novo suporte do CreateSupportDTO
    //  Passando por parametro em store (as regras e validações da criação)
    //  e Passando por parametro em new(o metodo DTO responsavel por cria com a validação)
    public function store(StoreUpdateSupport $request, Support $support)
    {
        $this->service->new(CreateSupportDTO::makeFromRequest($request));

        return redirect()->route('supports.index');
    }

    // Chama o metodo findOne no service , resposavel por encontrar um item pelo ID.
    public function show(string $id)
    {
      //verifica se existe o suporte pelo id, se não existir retorna null
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin.supports.show', compact('support'));//Suporte está retornando um array para view
    }

    // // Chama o metodo findOne no service , resposavel por encontrar um item pelo ID.
    // Se encontrar manda esses dados para a view responsavel para fazer a edição
    public function edit(string $id)
    {

      //verifica se existe o suporte pelo id, se não existir retorna null
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin.supports.edit', compact('support'));//Suporte está retornando um array para view
    }

    // Chama o metodo update no service , resposavel por atualizar o item.
    //se encontrar passa por parametro os Itens de request criados no UPdateDTO
    public function update(StoreUpdateSupport $request, string | int $id, Support $support)
    {

      //Faz a atualização dos dados informados, armazenados no DTo
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request,$id));

        if (!$support) {
            return back();
        }

        return redirect()->route('supports.index');
    }

    // Chama o metodo Delete no service , resposavel por remover.
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
