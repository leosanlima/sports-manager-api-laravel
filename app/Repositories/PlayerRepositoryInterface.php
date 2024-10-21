<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Contracts\Pagination\Paginator;

interface PlayerRepositoryInterface
{
    /**
     * Get all players.
     *
     * @return Paginator|static[]
     */
    public function all(): Paginator;

    /**
     * Find a player by ID.
     *
     * @param int $id
     * @return Player
     */
    public function find(int $id): Player;

    /**
     * Create a new player.
     *
     * @param array $data
     * @return Player
     */
    public function create(array $data): Player;

    /**
     * Update an existing player.
     *
     * @param Player $player
     * @param array $data
     * @return Player
     */
    public function update(Player $player, array $data): Player;

    /**
     * Delete a player.
     *
     * @param Player $player
     * @return bool|null
     */
    public function delete(Player $player): ?bool;
}