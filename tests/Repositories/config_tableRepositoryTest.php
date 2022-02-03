<?php namespace Tests\Repositories;

use App\Models\config_table;
use App\Repositories\config_tableRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class config_tableRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var config_tableRepository
     */
    protected $configTableRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->configTableRepo = \App::make(config_tableRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_config_table()
    {
        $configTable = factory(config_table::class)->make()->toArray();

        $createdconfig_table = $this->configTableRepo->create($configTable);

        $createdconfig_table = $createdconfig_table->toArray();
        $this->assertArrayHasKey('id', $createdconfig_table);
        $this->assertNotNull($createdconfig_table['id'], 'Created config_table must have id specified');
        $this->assertNotNull(config_table::find($createdconfig_table['id']), 'config_table with given id must be in DB');
        $this->assertModelData($configTable, $createdconfig_table);
    }

    /**
     * @test read
     */
    public function test_read_config_table()
    {
        $configTable = factory(config_table::class)->create();

        $dbconfig_table = $this->configTableRepo->find($configTable->id);

        $dbconfig_table = $dbconfig_table->toArray();
        $this->assertModelData($configTable->toArray(), $dbconfig_table);
    }

    /**
     * @test update
     */
    public function test_update_config_table()
    {
        $configTable = factory(config_table::class)->create();
        $fakeconfig_table = factory(config_table::class)->make()->toArray();

        $updatedconfig_table = $this->configTableRepo->update($fakeconfig_table, $configTable->id);

        $this->assertModelData($fakeconfig_table, $updatedconfig_table->toArray());
        $dbconfig_table = $this->configTableRepo->find($configTable->id);
        $this->assertModelData($fakeconfig_table, $dbconfig_table->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_config_table()
    {
        $configTable = factory(config_table::class)->create();

        $resp = $this->configTableRepo->delete($configTable->id);

        $this->assertTrue($resp);
        $this->assertNull(config_table::find($configTable->id), 'config_table should not exist in DB');
    }
}
