<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Contracts\Pagination\Paginator;

class PlayerRepository implements PlayerRepositoryInterface
{
    /**
     * Get all players.
     * 
     * @param int $perPage
     * @return Paginator
     */
    public function all(int $perPage = 20, ?string $name = null): Paginator
    {
        $query = Player::withTeam();

        if ($name) {
            $query->where('first_name', 'like', '%' . $name . '%')
                ->orWhere('last_name', 'like', '%' . $name . '%');
        }

        return $query->simplePaginate($perPage);
    }

    /**
     * Find a player by ID.
     *
     * @param int $id
     * @return Player
     */
    public function find(int $id): Player
    {
        return Player::findOrFail($id);
    }

    /**
     * Create a new player.
     *
     * @param array $data
     * @return Player
     */
    public function create(array $data): Player
    {
        return Player::create($data);
    }

    /**
     * Update an existing player.
     *
     * @param Player $player
     * @param array $data
     * @return Player
     */
    public function update(Player $player, array $data): Player
    {
        $player->update($data);
        return $player;
    }

    /**
     * Delete a player.
     *
     * @param Player $player
     * @return bool|null
     */
    public function delete(Player $player): ?bool
    {
        return $player->delete();
    }
}
