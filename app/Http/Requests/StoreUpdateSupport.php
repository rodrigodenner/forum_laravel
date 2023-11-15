<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
      // Neste caso, qualquer usuário está autorizado a fazer essa solicitação.
      return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
      // Define as regras de validação para os campos 'subject' e 'body'.
      $rules = [
        'subject' => 'required|min:3|max:255|unique:supports',
        'body' => [
            'required',
            'min:3',
            'max:100000',
        ],
    ];

      // Se o método da solicitação for 'PUT' (atualização), atualize as regras para 'subject'.
      if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
        $rules['subject'] = [
            'required', // 'nullable',
            'min:3',
            'max:255',
            // "unique:supports,subject,{$this->id},id",
            Rule::unique('supports')->ignore($this->support ?? $this->id),
          ];
      }

      // Retorna as regras de validação.
      return $rules;
  }
}
