<?php

namespace App\Http\Controllers\Api;

use App\Adapter\ApiAdapter;
use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupportController extends Controller
{
    public function __construct(protected SupportService $service) {}
    /**
     *Passando os items para a Api e informando os dados da paginação.
     */
    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalItemPage: $request->get('per_page', 5),
            filter: $request->filter,
        );

        return ApiAdapter::toJson($supports);

    }

    /**
     * Criando um novo suporte.
     */
    public function store(StoreUpdateSupport $request)
    {
        $support = $this->service->new(CreateSupportDTO::makeFromRequest($request));

        return new SupportResource($support);
    }

    /**
     * Mostrando o supporte selecionado.
     */
    public function show(string $id)
    {
        if (!$support = $this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Atualizando um support.
     */
    public function update(StoreUpdateSupport $request, string $id)
    {
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request, $id));

        if (!$support) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);

    }

    /**
     * Removendo um support.
     */
    public function destroy(string $id)
    {
        if (!$this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);

    }
}
