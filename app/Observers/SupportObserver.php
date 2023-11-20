<?php

namespace App\Observers;

use App\Models\Support;
use Illuminate\Support\Facades\Auth;

class SupportObserver
{
    /**
     * Este método é chamado quando um novo modelo Support está prestes a ser criado.
     * Aqui, estamos atribuindo o ID do usuário autenticado ao campo user_id do modelo Support.
     *
     * 
     */
    public function creating(Support $support): void
    {
        // Atribuir o ID do usuário autenticado ao campo user_id do modelo Support.
        $support->user_id = Auth::user()->id;
    }


}
