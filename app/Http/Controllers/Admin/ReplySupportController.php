<?php

namespace App\Http\Controllers\Admin;

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
        dd($replies);
        return view('admin.supports.replies.replies',compact('support','replies'));
    }
}
