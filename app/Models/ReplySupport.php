<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReplySupport extends Model
{
  use HasFactory, HasUuids;

  protected $table = 'replies_support';
  protected $fillable = [
    'user_id',
    'support_id',
    'content'
  ];

  //criando o relacionamento entre as tabelas
  public function user():BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function supports():BelongsTo
  {
    return $this->belongsTo(Support::class);
  }
}
