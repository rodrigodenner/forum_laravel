<?php

namespace App\Models;

use App\Enums\SupportStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Support extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'subject',
    'body',
    'status'
  ];

  //pegando o retorno de status vindo do DTO, E mandando para o banco o Nome do Status
  public function status(): Attribute
  {
    return Attribute::make(
      set: fn(SupportStatus $status) => $status->name,
    );
  }

  //criando o relacionamento entre as tabelas
  public function replies():HasMany
  {
    return $this->hasMany(ReplySupport::class);
  }

  public function user():BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
