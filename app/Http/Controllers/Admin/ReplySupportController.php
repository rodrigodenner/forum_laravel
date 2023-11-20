<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SupportService;
use App\Http\Controllers\Controller;

class ReplySupportController extends Controller
{
    //Injetando o service no controller
    public function __construct(protected SupportService $service) {}

    public function index(string $id)
    {
      //verifica se existe o suporte pelo id, se não existir retorna null
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin.supports.replies.replies',compact('support'));
    }
}
