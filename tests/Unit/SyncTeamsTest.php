<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use PHPUnit\Framework\TestCase;

class SyncTeamsTest extends TestCase
{
    use RefreshDatabase; // Limpa o banco após cada teste

    /** @test */
    public function it_syncs_teams_from_the_api()
    {
        // Simular a resposta da API BallDontLie
        $mockResponse = [
            'data' => [
                [
                    'id' => 1,
                    'conference' => 'East',
                    'division' => 'Atlantic',
                    'city' => 'Boston',
                    'name' => 'Celtics',
                    'full_name' => 'Boston Celtics',
                    'abbreviation' => 'BOS'
                ],
                [
                    'id' => 2,
                    'conference' => 'West',
                    'division' => 'Pacific',
                    'city' => 'Los Angeles',
                    'name' => 'Lakers',
                    'full_name' => 'Los Angeles Lakers',
                    'abbreviation' => 'LAL'
                ],
            ],
            'meta' => [
                'next_cursor' => null
            ]
        ];

        // Criar um mock da facade BallDontLie para retornar o mockResponse
        $mock = Mockery::mock('alias:App\Services\BallDontLieService');
        $mock->shouldReceive('teams')
             ->once()
             ->andReturn($mockResponse);

        // Executar a sincronização
        $this->artisan('sync:sports-data');

        // Verificar se os dados dos times foram salvos corretamente
        $this->assertDatabaseHas('teams', [
            'id' => 1,
            'conference' => 'East',
            'division' => 'Atlantic',
            'city' => 'Boston',
            'name' => 'Celtics',
            'full_name' => 'Boston Celtics',
            'abbreviation' => 'BOS'
        ]);

        $this->assertDatabaseHas('teams', [
            'id' => 2,
            'conference' => 'West',
            'division' => 'Pacific',
            'city' => 'Los Angeles',
            'name' => 'Lakers',
            'full_name' => 'Los Angeles Lakers',
            'abbreviation' => 'LAL'
        ]);
    }
}
