<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
  public function __construct(protected SupportService $service){}
  
  // Página inicial que lista todos os registros de suporte.
  public function index(Request $request)
  {
    $supports = $this->service->getAll($request->filter);

    return view('admin.supports.index', compact('supports'));
  }

  // Página para criar um novo registro de suporte.
  public function create()
  {
    return view('admin.supports.create');
  }

  // Armazena um novo registro de suporte com base nos dados do formulário.
  public function store(StoreUpdateSupport $request, Support $support)
  {
    $this->service->new(CreateSupportDTO::makeFromRequest($request));

    return redirect()->route('supports.index');
  }
  
  // Exibe os detalhes de um registro de suporte.
  public function show(string $id)
  {
    if (!$support = $this->service->findOne($id)) {
      return back();
    }

    return view('admin.supports.show', compact('support'));
  }

  // Página de edição de um registro de suporte.
  public function edit(string $id)
  {
    if (!$support = $this->service->findOne($id)) {
      return back();
    }

    return view('admin.supports.edit', compact('support'));
  }

  // Atualiza um registro de suporte com base nos dados do formulário.
  public function update(StoreUpdateSupport $request, string | int $id, Support $support)
  {
    $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request));
    
    if (!$support) return back();

    return redirect()->route('supports.index');
  }

  // Exclui um registro de suporte pelo ID.
  public function destroy(string $id)
  {
    $this->service->delete($id);
    
    return redirect()->route('supports.index');
  }
}