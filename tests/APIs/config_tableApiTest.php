<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\config_table;

class config_tableApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_config_table()
    {
        $configTable = factory(config_table::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/config_tables', $configTable
        );

        $this->assertApiResponse($configTable);
    }

    /**
     * @test
     */
    public function test_read_config_table()
    {
        $configTable = factory(config_table::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/config_tables/'.$configTable->id
        );

        $this->assertApiResponse($configTable->toArray());
    }

    /**
     * @test
     */
    public function test_update_config_table()
    {
        $configTable = factory(config_table::class)->create();
        $editedconfig_table = factory(config_table::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/config_tables/'.$configTable->id,
            $editedconfig_table
        );

        $this->assertApiResponse($editedconfig_table);
    }

    /**
     * @test
     */
    public function test_delete_config_table()
    {
        $configTable = factory(config_table::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/config_tables/'.$configTable->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/config_tables/'.$configTable->id
        );

        $this->response->assertStatus(404);
    }
}
