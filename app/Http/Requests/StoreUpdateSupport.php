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
          'subject' => [
              'required',            // O campo 'subject' é obrigatório.
              'min:3',              // O campo 'subject' deve ter pelo menos 3 caracteres.
              'max:255',            // O campo 'subject' deve ter no máximo 255 caracteres.
              'unique:supports'     // O valor do campo 'subject' deve ser único na tabela 'supports'.
          ],
          'body' => [
              'required',            // O campo 'body' é obrigatório.
              'min: 5',             // O campo 'body' deve ter pelo menos 15 caracteres.
              'max:1000',           // O campo 'body' deve ter no máximo 1000 caracteres.
          ],
      ];
    
      // Se o método da solicitação for 'PUT' (atualização), atualize as regras para 'subject'.
      if ($this->method() === 'PUT') {
          $rules['subject'] = [
              'required',
              'min:3',
              'max:255',
              // Além das regras anteriores, o valor do campo 'subject' deve ser único,
              // exceto para o registro atual (ignore o ID deste registro).
              // Quando tentar editar o assunto e o assunto for o mesmo pode liberar 
              Rule::unique('supports')->ignore($this->id),
          ];
      }
      
      // Retorna as regras de validação.
      return $rules;
  }
}