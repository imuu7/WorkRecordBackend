<?php namespace Tests\Repositories;

use App\Models\Clockin;
use App\Repositories\ClockinRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClockinRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClockinRepository
     */
    protected $clockinRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clockinRepo = \App::make(ClockinRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_clockin()
    {
        $clockin = factory(Clockin::class)->make()->toArray();

        $createdClockin = $this->clockinRepo->create($clockin);

        $createdClockin = $createdClockin->toArray();
        $this->assertArrayHasKey('id', $createdClockin);
        $this->assertNotNull($createdClockin['id'], 'Created Clockin must have id specified');
        $this->assertNotNull(Clockin::find($createdClockin['id']), 'Clockin with given id must be in DB');
        $this->assertModelData($clockin, $createdClockin);
    }

    /**
     * @test read
     */
    public function test_read_clockin()
    {
        $clockin = factory(Clockin::class)->create();

        $dbClockin = $this->clockinRepo->find($clockin->id);

        $dbClockin = $dbClockin->toArray();
        $this->assertModelData($clockin->toArray(), $dbClockin);
    }

    /**
     * @test update
     */
    public function test_update_clockin()
    {
        $clockin = factory(Clockin::class)->create();
        $fakeClockin = factory(Clockin::class)->make()->toArray();

        $updatedClockin = $this->clockinRepo->update($fakeClockin, $clockin->id);

        $this->assertModelData($fakeClockin, $updatedClockin->toArray());
        $dbClockin = $this->clockinRepo->find($clockin->id);
        $this->assertModelData($fakeClockin, $dbClockin->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_clockin()
    {
        $clockin = factory(Clockin::class)->create();

        $resp = $this->clockinRepo->delete($clockin->id);

        $this->assertTrue($resp);
        $this->assertNull(Clockin::find($clockin->id), 'Clockin should not exist in DB');
    }
}
