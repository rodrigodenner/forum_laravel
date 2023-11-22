<?php

namespace App\Repositories\Eloquent;

use App\DTO\Replies\CreateReplayDTO;
use App\Models\ReplySupport as Model;
use App\Repositories\Contracts\ReplayRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ReplySupportRepository implements ReplayRepositoryInterface
{

  public function __construct(
    protected Model $model,
  ) {
  }

  public function getAllBySupportId(string $supportId): array
  {
    $replies = $this->model->where('support_id',$supportId)->get();

    return $replies->toArray();
  }

  public function createNew(CreateReplayDTO $dto): stdClass
  {
    $replay = $this->model->create([
      'content' => $dto->content,
      'support_id' => $dto->supportId,
      'user_id' => Auth::user()->id,
    ]);

    return (object) $replay->toArray();
  }
}
