<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Repositories\GameRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * GameController constructor.
     *
     * @param GameRepository $gameRepository
     */
    public function __construct(protected GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * Get all Games.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 20);

        $games = $this->gameRepository->all($perPage);

        return response()->json(GameResource::collection($games)->response()->getData(true));
    }

    /**
     * Show the details of a game by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $game = $this->gameRepository->find($id);
        return response()->json(new GameResource($game));
    }

    /**
     * Create a new game.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $game = $this->gameRepository->create($request->all());
        return response()->json(new GameResource($game), 201);
    }

    /**
     * Update an existing game by ID.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $game = $this->gameRepository->find($id);
        $updatedGame = $this->gameRepository->update($game, $request->all());
        return response()->json(new GameResource($updatedGame));
    }

    /**
     * Delete a game by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $game = $this->gameRepository->find($id);
        $this->gameRepository->delete($game);
        return response()->json(null, 204);
    }
}
