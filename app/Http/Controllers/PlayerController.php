<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerResource;
use App\Repositories\PlayerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * PlayerController constructor.
     *
     * @param PlayerRepository $playerRepository
     */
    public function __construct(protected PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * Get all players.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 20);
        $name = $request->query('name');

        $players = $this->playerRepository->all($perPage, $name);

        return response()->json(PlayerResource::collection($players)->response()->getData(true));
    }

    /**
     * Show the details of a player by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $player = $this->playerRepository->find($id);
        return response()->json(new PlayerResource($player));
    }

    /**
     * Create a new player.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $player = $this->playerRepository->create($request->all());
        return response()->json(new PlayerResource($player), 201);
    }

    /**
     * Update an existing player by ID.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $player = $this->playerRepository->find($id);
        $updatedPlayer = $this->playerRepository->update($player, $request->all());
        return response()->json(new PlayerResource($updatedPlayer));
    }

    /**
     * Delete a player by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $player = $this->playerRepository->find($id);
        $this->playerRepository->delete($player);
        return response()->json(null, 204);
    }
}
