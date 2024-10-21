<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Repositories\TeamRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * TeamController constructor.
     *
     * @param TeamRepository $teamRepository
     */
    public function __construct(protected TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Get all team.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 20);
        $search = $request->query('search');

        $teams = $this->teamRepository->all($perPage, $search);

        return response()->json(TeamResource::collection($teams)->response()->getData(true));
    }

    /**
     * Create a new team.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $team = $this->teamRepository->create($request->all());
        return response()->json(new TeamResource($team), 201);
    }

    /**
     * Show the details of a team by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $team = $this->teamRepository->find($id);
        return response()->json(new TeamResource($team));
    }

    /**
     * Update an existing team by ID.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $team = $this->teamRepository->find($id);
        $updatedTeam = $this->teamRepository->update($team, $request->all());
        return response()->json(new TeamResource($updatedTeam));
    }

    /**
     * Delete a team by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $team = $this->teamRepository->find($id);
        $this->teamRepository->delete($team);
        return response()->json(null, 204);
    }
}
