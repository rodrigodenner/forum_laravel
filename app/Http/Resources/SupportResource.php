<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      //padronizando como deve retornar a api
        return [
          'id'=> $this->id,
          'subject' => $this->subject,
          'body'=> $this->body,
          
        ];
    }
}
