<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Replies\CreateReplayDTO;
use App\Http\Requests\StoreReplySupportRequest;
use App\Services\ReplySupportService;
use Illuminate\Http\Request;
use App\Services\SupportService;
use App\Http\Controllers\Controller;

class ReplySupportController extends Controller
{
  //Injetando o service no controller
  public function __construct(
    protected SupportService $supportService,
    protected ReplySupportService $replyService
  ) {}

  public function index(string $id)
  {
    //verifica se existe o suporte pelo id, se não existir retorna null
    if (!$support = $this->supportService->findOne($id)) {
      return back();
    }
    $replies = $this->replyService->getAllBySupportId($id);

    return view('admin.supports.replies.replies',compact('support','replies'));
  }

  //cadastro de duvida
  public function store(StoreReplySupportRequest $request)
  {
    $this->replyService->createNew(CreateReplayDTO::makeFromRequest($request));

    return redirect()->route('replies.index', $request->support_id)->with('message','Cadastrada com sucesso!');

  }
  //deletar resposta
  public function destroy(string $supportId, string $id)
  {
   $this->replyService->delete($id);

    return redirect()
      ->route('replies.index', $supportId)
      ->with('message', 'Deletado com sucesso!');
  }

}
