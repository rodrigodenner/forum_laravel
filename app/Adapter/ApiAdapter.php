<?php

namespace App\Adapter;

use App\Http\Resources\DefaultResource;
use App\Repositories\PaginationInterface;

class ApiAdapter
{
  public static function toJson(PaginationInterface $data)
  {
    return DefaultResource::collection($data->items())->additional([
      'meta'=>[
        'totalItems'=> $data->totalItems(),
        'isFirstPage'=> $data->isFirstPage(),
        'isLastPage'=> $data->isLastPage(),
        'currentPage'=> $data->currentPage(),
        'getNumberNextPage'=> $data->getNumberNextPage(),
        'getNumberPreviousPage'=> $data->getNumberPreviousPage(),
      ]
    ]);
  }
}
